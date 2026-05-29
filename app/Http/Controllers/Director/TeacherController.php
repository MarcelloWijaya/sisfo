<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Branch;
use App\Models\TeacherAttendance;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $query = Teacher::with('branch')->where('branch_id', $branchId);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%")
                    ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $teachers = $query->orderBy('name')->paginate(15);
        $branches = Branch::where('status', 'active')->get();

        return view('teachers.index', compact('teachers', 'branches'));
    }

    public function create()
    {
        $branchId = Auth::user()->branch_id;
        $branches = Branch::where('status', 'active')->get();

        return view('teachers.create', compact('branches', 'branchId'));
    }

    public function store(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female',
            'phone' => 'nullable|string',
            'email' => 'nullable|email|unique:teachers',
            'address' => 'nullable|string',
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'last_education' => 'nullable|string',
            'qualification' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
        ]);

        // Create user account first
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email ?? strtolower(str_replace(' ', '.', $request->name)) . '@anaku.com',
            'password' => Hash::make('password123'),
            'branch_id' => $branchId,
        ]);
        $user->assignRole('teacher');

        // Create teacher record
        $teacher = Teacher::create([
            'branch_id' => $branchId,
            'user_id' => $user->id,
            'name' => $request->name,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'address' => $request->address,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'email' => $request->email,
            'last_education' => $request->last_education,
            'qualification' => $request->qualification,
            'status' => $request->status ?? 'active',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('director.teachers.index')->with('success', __('all.teacher_created'));
    }

    public function show(Teacher $teacher)
    {
        $branchId = Auth::user()->branch_id;

        if ($teacher->branch_id != $branchId) {
            abort(403);
        }

        $teacher->load('branch');

        $totalClasses = Classroom::where('teacher_id', $teacher->id)->count();
        $totalPresent = TeacherAttendance::where('teacher_id', $teacher->id)->where('status', 'present')->count();
        $totalAbsent = TeacherAttendance::where('teacher_id', $teacher->id)->where('status', 'absent')->count();
        $schedules = Classroom::where('teacher_id', $teacher->id)->orderBy('day')->orderBy('start_time')->get();

        return view('teachers.show', compact('teacher', 'totalClasses', 'totalPresent', 'totalAbsent', 'schedules'));
    }

    public function edit(Teacher $teacher)
    {
        $branchId = Auth::user()->branch_id;

        if ($teacher->branch_id != $branchId) {
            abort(403);
        }

        $branches = Branch::where('status', 'active')->get();

        return view('teachers.edit', compact('teacher', 'branches'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $branchId = Auth::user()->branch_id;

        if ($teacher->branch_id != $branchId) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female',
            'phone' => 'nullable|string',
            'email' => 'nullable|email|unique:teachers,email,' . $teacher->id,
            'address' => 'nullable|string',
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'last_education' => 'nullable|string',
            'qualification' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $teacher->update($request->all());

        // Update user account
        if ($teacher->user_id) {
            $user = User::find($teacher->user_id);
            if ($user) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }
        }

        return redirect()->route('director.teachers.show', $teacher)->with('success', __('all.teacher_updated'));
    }

    public function destroy(Teacher $teacher)
    {
        $branchId = Auth::user()->branch_id;

        if ($teacher->branch_id != $branchId) {
            abort(403);
        }

        // Delete user account
        if ($teacher->user_id) {
            User::where('id', $teacher->user_id)->delete();
        }

        $teacher->delete();

        return redirect()->route('director.teachers.index')->with('success', __('all.teacher_deleted'));
    }

    public function attendance(Teacher $teacher, Request $request)
    {
        $branchId = Auth::user()->branch_id;

        if ($teacher->branch_id != $branchId) {
            abort(403);
        }

        $month = $request->get('month', date('Y-m'));
        $attendances = TeacherAttendance::where('teacher_id', $teacher->id)
            ->where('attendance_date', 'like', "$month%")
            ->orderBy('attendance_date', 'desc')
            ->get();

        $summary = [
            'present' => $attendances->where('status', 'present')->count(),
            'absent' => $attendances->where('status', 'absent')->count(),
            'late' => $attendances->where('status', 'late')->count(),
            'sick' => $attendances->where('status', 'sick')->count(),
            'leave' => $attendances->where('status', 'leave')->count(),
        ];

        return view('director.teachers.attendance', compact('teacher', 'attendances', 'month', 'summary'));
    }

    public function schedule(Teacher $teacher)
    {
        $branchId = Auth::user()->branch_id;

        if ($teacher->branch_id != $branchId) {
            abort(403);
        }

        $schedules = Classroom::where('teacher_id', $teacher->id)->with('branch')->orderBy('day')->orderBy('start_time')->get();

        return view('director.teachers.schedule', compact('teacher', 'schedules'));
    }
}
