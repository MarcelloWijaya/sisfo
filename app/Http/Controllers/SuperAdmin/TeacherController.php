<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Branch;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('branch')->latest()->get();

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $branches = Branch::where('status', 'active')->get();

        return view('teachers.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'teacher_number' => 'required|unique:teachers,teacher_number',
            'name' => 'required',
        ]);

        Teacher::create($request->all());

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $branches = Branch::where('status', 'active')->get();

        return view('teachers.edit', compact('teacher', 'branches'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'teacher_number' => 'required|unique:teachers,teacher_number,' . $teacher->id,
            'name' => 'required',
        ]);

        $teacher->update($request->all());

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
