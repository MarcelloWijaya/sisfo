<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('branch')->latest()->get();

        return view('students.index', compact('students'));
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
            'student_number' => 'required|unique:students,student_number',
            'name' => 'required',
            'gender' => 'required',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
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
            'student_number' => 'required|unique:students,student_number,' . $student->id,
            'name' => 'required',
            'gender' => 'required',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
