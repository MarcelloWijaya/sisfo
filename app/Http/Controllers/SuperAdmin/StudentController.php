<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Branch;
use App\Models\Student;
use App\Models\User;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('branch')->latest()->paginate(15);
        $branches = Branch::where('status', 'active')->get();

        return view('students.index', compact('students', 'branches'));
    }

    public function create()
    {
        $branches = Branch::where('status', 'active')->get();

        return view('students.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
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
            'branch_id' => $request->branch_id,
            'email_verified_at' => now(),
        ]);
        $user->assignRole('student');

        // Create student record
        Student::create([
            'branch_id' => $request->branch_id,
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
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('students.index')->with('success', __('all.student_created'));
    }

    public function show(Student $student)
    {
        $student->load('branch', 'user');

        $totalPresent = StudentAttendance::where('student_id', $student->id)->where('status', 'present')->count();
        $totalAbsent = StudentAttendance::where('student_id', $student->id)->where('status', 'absent')->count();
        $totalLate = StudentAttendance::where('student_id', $student->id)->where('status', 'late')->count();

        return view('students.show', compact('student', 'totalPresent', 'totalAbsent', 'totalLate'));
    }

    public function edit(Student $student)
    {
        $branches = Branch::where('status', 'active')->get();

        return view('students.edit', compact('student', 'branches'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
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
                    'branch_id' => $request->branch_id,
                ]);
            }
        }

        return redirect()->route('students.index')->with('success', __('all.student_updated'));
    }

    public function destroy(Student $student)
    {
        // Delete user account
        if ($student->user_id) {
            User::where('id', $student->user_id)->delete();
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', __('all.student_deleted'));
    }
}
