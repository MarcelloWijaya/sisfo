<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $branchId = $user->hasRole('super_admin') || $user->hasRole('director') ? $request->get('branch_id') : $user->branch_id;

        $query = TeacherAttendance::with(['teacher', 'branch', 'recorder']);

        if ($branchId) {
            $query->where('branch_id', $branchId);
        }

        if ($request->filled('date')) {
            $query->where('attendance_date', $request->date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        $attendances = $query->orderBy('attendance_date', 'desc')->paginate(20);

        $branches = Branch::where('status', 'active')->get();
        $teachers = Teacher::when($branchId, fn($q) => $q->where('branch_id', $branchId))->where('status', 'active')->get();

        return view('attendance.teacher.index', compact('attendances', 'branches', 'teachers', 'branchId'));
    }

    public function create()
    {
        $user = Auth::user();
        $branchId = $user->hasRole('super_admin') || $user->hasRole('director') ? null : $user->branch_id;

        $branches = Branch::where('status', 'active')->get();
        $teachers = Teacher::when($branchId, fn($q) => $q->where('branch_id', $branchId))->where('status', 'active')->get();

        $statuses = TeacherAttendance::getStatuses();

        return view('attendance.teacher.create', compact('branches', 'teachers', 'statuses', 'branchId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'teacher_id' => 'required|exists:teachers,id',
            'attendance_date' => 'required|date',
            'status' => 'required|in:present,absent,late,excused,sick,leave',
            'check_in_time' => 'nullable|date_format:H:i',
            'check_out_time' => 'nullable|date_format:H:i|after:check_in_time',
            'notes' => 'nullable|string',
        ]);

        $exists = TeacherAttendance::where('teacher_id', $request->teacher_id)->where('attendance_date', $request->attendance_date)->exists();

        if ($exists) {
            return back()
                ->withErrors(['teacher_id' => __('all.attendance_already_recorded')])
                ->withInput();
        }

        TeacherAttendance::create([...$request->all(), 'recorded_by' => Auth::id()]);

        return redirect()->route('attendance.teacher.index')->with('success', __('all.attendance_recorded'));
    }

    public function show(TeacherAttendance $teacherAttendance)
    {
        $teacherAttendance->load(['teacher', 'branch', 'recorder']);
        return view('attendance.teacher.show', compact('teacherAttendance'));
    }

    public function edit(TeacherAttendance $teacherAttendance)
    {
        $user = Auth::user();
        $branchId = $user->hasRole('super_admin') ? null : $user->branch_id;

        $branches = Branch::where('status', 'active')->get();
        $teachers = Teacher::when($branchId, fn($q) => $q->where('branch_id', $branchId))->where('status', 'active')->get();

        $statuses = TeacherAttendance::getStatuses();

        return view('attendance.teacher.edit', compact('teacherAttendance', 'branches', 'teachers', 'statuses'));
    }

    public function update(Request $request, TeacherAttendance $teacherAttendance)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'teacher_id' => 'required|exists:teachers,id',
            'attendance_date' => 'required|date',
            'status' => 'required|in:present,absent,late,excused,sick,leave',
            'check_in_time' => 'nullable|date_format:H:i',
            'check_out_time' => 'nullable|date_format:H:i|after:check_in_time',
            'notes' => 'nullable|string',
        ]);

        $teacherAttendance->update($request->all());

        return redirect()->route('attendance.teacher.index')->with('success', __('all.attendance_updated'));
    }

    public function destroy(TeacherAttendance $teacherAttendance)
    {
        $teacherAttendance->delete();
        return redirect()->route('attendance.teacher.index')->with('success', __('all.attendance_deleted'));
    }

    // Bulk attendance for all teachers in a branch
    public function bulkCreate(Request $request)
    {
        $user = Auth::user();
        $branchId = $request->get('branch_id', $user->branch_id);
        $date = $request->get('attendance_date', date('Y-m-d'));

        $branch = Branch::findOrFail($branchId);
        $teachers = Teacher::where('branch_id', $branchId)->where('status', 'active')->orderBy('full_name')->get();

        $statuses = TeacherAttendance::getStatuses();

        return view('attendance.teacher.bulk', compact('branch', 'teachers', 'date', 'statuses'));
    }

    public function bulkStore(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'attendance_date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*.teacher_id' => 'required|exists:teachers,id',
            'attendances.*.status' => 'required|in:present,absent,late,excused,sick,leave',
        ]);

        $recordedBy = Auth::id();
        $attendanceDate = $request->attendance_date;
        $branchId = $request->branch_id;

        foreach ($request->attendances as $attendance) {
            TeacherAttendance::updateOrCreate(
                [
                    'teacher_id' => $attendance['teacher_id'],
                    'attendance_date' => $attendanceDate,
                ],
                [
                    'branch_id' => $branchId,
                    'status' => $attendance['status'],
                    'notes' => $attendance['notes'] ?? null,
                    'recorded_by' => $recordedBy,
                ],
            );
        }

        return redirect()->route('attendance.teacher.index')->with('success', __('all.bulk_attendance_recorded'));
    }
}
