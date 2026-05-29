<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $branchId = $user->hasRole('super_admin') || $user->hasRole('director') ? $request->get('branch_id') : $user->branch_id;

        $query = StudentAttendance::with(['student', 'schedule', 'branch', 'recorder']);

        if ($branchId) {
            $query->where('branch_id', $branchId);
        }

        if ($request->filled('date')) {
            $query->where('attendance_date', $request->date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        if ($request->filled('classroom_id')) {
            $query->where('classroom_id', $request->classroom_id);
        }

        $attendances = $query->orderBy('attendance_date', 'desc')->paginate(20);

        $branches = Branch::where('status', 'active')->get();
        $students = Student::when($branchId, fn($q) => $q->where('branch_id', $branchId))->where('status', 'active')->get();
        $classrooms = Classroom::when($branchId, fn($q) => $q->where('branch_id', $branchId))->where('status', 'active')->get();

        return view('attendance.student.index', compact('attendances', 'branches', 'students', 'classrooms', 'branchId'));
    }

    public function create()
    {
        $user = Auth::user();
        $branchId = $user->hasRole('super_admin') || $user->hasRole('director') ? null : $user->branch_id;

        $branches = Branch::where('status', 'active')->get();
        $classrooms = Classroom::with(['branch', 'teacher'])
            ->when($branchId, fn($q) => $q->where('branch_id', $branchId))
            ->where('status', 'active')
            ->get();

        $students = Student::when($branchId, fn($q) => $q->where('branch_id', $branchId))->where('status', 'active')->get();

        $statuses = StudentAttendance::getStatuses();

        return view('attendance.student.create', compact('branches', 'classrooms', 'students', 'statuses', 'branchId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'student_id' => 'required|exists:students,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'attendance_date' => 'required|date',
            'status' => 'required|in:present,absent,late,excused',
            'check_in_time' => 'nullable|date_format:H:i',
            'check_out_time' => 'nullable|date_format:H:i|after:check_in_time',
            'notes' => 'nullable|string',
        ]);

        // Cek double attendance
        $exists = StudentAttendance::where('student_id', $request->student_id)->where('classroom_id', $request->classroom_id)->where('attendance_date', $request->attendance_date)->exists();

        if ($exists) {
            return back()
                ->withErrors(['student_id' => __('all.attendance_already_recorded')])
                ->withInput();
        }

        StudentAttendance::create([...$request->all(), 'recorded_by' => Auth::id()]);

        return redirect()->route('attendance.student.index')->with('success', __('all.attendance_recorded'));
    }

    public function show(StudentAttendance $studentAttendance)
    {
        $studentAttendance->load(['student', 'schedule', 'branch', 'recorder']);
        return view('attendance.student.show', compact('studentAttendance'));
    }

    public function edit(StudentAttendance $studentAttendance)
    {
        $user = Auth::user();
        $branchId = $user->hasRole('super_admin') ? null : $user->branch_id;

        $branches = Branch::where('status', 'active')->get();
        $classrooms = Classroom::with(['branch', 'teacher'])
            ->when($branchId, fn($q) => $q->where('branch_id', $branchId))
            ->where('status', 'active')
            ->get();

        $students = Student::when($branchId, fn($q) => $q->where('branch_id', $branchId))->where('status', 'active')->get();

        $statuses = StudentAttendance::getStatuses();

        return view('attendance.student.edit', compact('studentAttendance', 'branches', 'classrooms', 'students', 'statuses'));
    }

    public function update(Request $request, StudentAttendance $studentAttendance)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'student_id' => 'required|exists:students,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'attendance_date' => 'required|date',
            'status' => 'required|in:present,absent,late,excused',
            'check_in_time' => 'nullable|date_format:H:i',
            'check_out_time' => 'nullable|date_format:H:i|after:check_in_time',
            'notes' => 'nullable|string',
        ]);

        $studentAttendance->update($request->all());

        return redirect()->route('attendance.student.index')->with('success', __('all.attendance_updated'));
    }

    public function destroy(StudentAttendance $studentAttendance)
    {
        $studentAttendance->delete();
        return redirect()->route('attendance.student.index')->with('success', __('all.attendance_deleted'));
    }

    // Bulk attendance for a schedule
    public function bulkCreate(Request $request)
    {
        $scheduleId = $request->get('classroom_id');
        $date = $request->get('attendance_date', date('Y-m-d'));

        $schedule = Classroom::with('branch')->findOrFail($scheduleId);
        $students = Student::where('branch_id', $schedule->branch_id)->where('status', 'active')->orderBy('name')->get();

        $statuses = StudentAttendance::getStatuses();

        return view('attendance.student.bulk', compact('schedule', 'students', 'date', 'statuses'));
    }

    public function bulkStore(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'attendance_date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*.student_id' => 'required|exists:students,id',
            'attendances.*.status' => 'required|in:present,absent,late,excused',
        ]);

        $schedule = Classroom::find($request->classroom_id);
        $recordedBy = Auth::id();
        $attendanceDate = $request->attendance_date;

        foreach ($request->attendances as $attendance) {
            StudentAttendance::updateOrCreate(
                [
                    'student_id' => $attendance['student_id'],
                    'classroom_id' => $request->classroom_id,
                    'attendance_date' => $attendanceDate,
                ],
                [
                    'branch_id' => $schedule->branch_id,
                    'status' => $attendance['status'],
                    'notes' => $attendance['notes'] ?? null,
                    'recorded_by' => $recordedBy,
                ],
            );
        }

        return redirect()->route('attendance.student.index')->with('success', __('all.bulk_attendance_recorded'));
    }

    // Get students by schedule (AJAX)
    public function getStudentsByClassroom(Request $request)
    {
        $schedule = Classroom::findOrFail($request->classroom_id);
        $students = Student::where('branch_id', $schedule->branch_id)
            ->where('status', 'active')
            ->orderBy('name')
            ->get(['id', 'name', 'nis']);

        return response()->json($students);
    }
}
