<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Branch;
use App\Models\StudentAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $query = Student::with('branch')->where('branch_id', $branchId);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")->orWhere('nis', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $students = $query->orderBy('name')->paginate(15);
        $branches = Branch::where('status', 'active')->get();

        return view('students.index', compact('students', 'branches'));
    }

    public function create()
    {
        $branchId = Auth::user()->branch_id;
        $branches = Branch::where('status', 'active')->get();

        return view('students.create', compact('branches', 'branchId'));
    }

    public function store(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $request->validate([
            'nis' => 'required|unique:students',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'class' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'religion' => 'nullable|string',
            'school_name' => 'nullable|string',
            'parent_name' => 'nullable|string',
            'parent_phone' => 'nullable|string',
            'parent_email' => 'nullable|email',
            'registration_date' => 'nullable|date',
            'join_date' => 'nullable|date',
            'book_level' => 'nullable|string',
            'status' => 'nullable|in:active,inactive,graduated,suspended',
        ]);

        // Create user account for student
        $user = User::create([
            'name' => $request->name,
            'email' => $request->nis . '@student.com',
            'password' => Hash::make('password123'),
            'branch_id' => $branchId,
            'email_verified_at' => now(),
        ]);
        $user->assignRole('student');

        // Create student record
        Student::create([
            'branch_id' => $branchId,
            'user_id' => $user->id,
            'nis' => $request->nis,
            'name' => $request->name,
            'gender' => $request->gender,
            'class' => $request->class,
            'phone' => $request->phone,
            'address' => $request->address,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'religion' => $request->religion,
            'school_name' => $request->school_name,
            'parent_name' => $request->parent_name,
            'parent_phone' => $request->parent_phone,
            'parent_email' => $request->parent_email,
            'registration_date' => $request->registration_date,
            'join_date' => $request->join_date,
            'book_level' => $request->book_level,
            'status' => $request->status ?? 'active',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('director.students.index')->with('success', __('all.student_created'));
    }

    public function show(Student $student)
    {
        $branchId = Auth::user()->branch_id;

        if ($student->branch_id != $branchId) {
            abort(403);
        }

        $student->load('branch', 'user');

        $totalPresent = StudentAttendance::where('student_id', $student->id)->where('status', 'present')->count();
        $totalAbsent = StudentAttendance::where('student_id', $student->id)->where('status', 'absent')->count();
        $totalLate = StudentAttendance::where('student_id', $student->id)->where('status', 'late')->count();
        $recentAttendances = StudentAttendance::where('student_id', $student->id)->latest()->limit(10)->get();

        return view('students.show', compact('student', 'totalPresent', 'totalAbsent', 'totalLate', 'recentAttendances'));
    }

    public function edit(Student $student)
    {
        $branchId = Auth::user()->branch_id;

        if ($student->branch_id != $branchId) {
            abort(403);
        }

        $branches = Branch::where('status', 'active')->get();

        return view('students.edit', compact('student', 'branches'));
    }

    public function update(Request $request, Student $student)
    {
        $branchId = Auth::user()->branch_id;

        if ($student->branch_id != $branchId) {
            abort(403);
        }

        $request->validate([
            'nis' => 'required|unique:students,nis,' . $student->id,
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'class' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'religion' => 'nullable|string',
            'school_name' => 'nullable|string',
            'parent_name' => 'nullable|string',
            'parent_phone' => 'nullable|string',
            'parent_email' => 'nullable|email',
            'registration_date' => 'nullable|date',
            'join_date' => 'nullable|date',
            'book_level' => 'nullable|string',
            'status' => 'required|in:active,inactive,graduated,suspended',
        ]);

        $student->update($request->all());

        // Update user account
        if ($student->user_id) {
            $user = User::find($student->user_id);
            if ($user) {
                $user->update([
                    'name' => $request->name,
                    'branch_id' => $branchId,
                ]);
            }
        }

        return redirect()->route('director.students.show', $student)->with('success', __('all.student_updated'));
    }

    public function destroy(Student $student)
    {
        $branchId = Auth::user()->branch_id;

        if ($student->branch_id != $branchId) {
            abort(403);
        }

        // Delete user account
        if ($student->user_id) {
            User::where('id', $student->user_id)->delete();
        }

        $student->delete();

        return redirect()->route('director.students.index')->with('success', __('all.student_deleted'));
    }

    public function attendance(Student $student, Request $request)
    {
        $branchId = Auth::user()->branch_id;

        if ($student->branch_id != $branchId) {
            abort(403);
        }

        $month = $request->get('month', date('Y-m'));
        $attendances = StudentAttendance::where('student_id', $student->id)
            ->where('attendance_date', 'like', "$month%")
            ->orderBy('attendance_date', 'desc')
            ->get();

        $summary = [
            'present' => $attendances->where('status', 'present')->count(),
            'absent' => $attendances->where('status', 'absent')->count(),
            'late' => $attendances->where('status', 'late')->count(),
            'excused' => $attendances->where('status', 'excused')->count(),
        ];

        return view('director.students.attendance', compact('student', 'attendances', 'month', 'summary'));
    }

    public function attendanceIndex(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $query = StudentAttendance::with(['student', 'classroom'])->whereHas('student', function ($q) use ($branchId) {
            $q->where('branch_id', $branchId);
        });

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        if ($request->filled('month')) {
            $query->where('attendance_date', 'like', $request->month . '%');
        }

        $attendances = $query->orderBy('attendance_date', 'desc')->paginate(20);
        $students = Student::where('branch_id', $branchId)->where('status', 'active')->get();

        return view('director.students.attendance-index', compact('attendances', 'students'));
    }
}
