<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ManageClassroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManageClassroomController extends Controller
{
    public function index()
    {
        $manage_classrooms = ManageClassroom::all();

        $data = [
            'manage_classrooms' => $manage_classrooms,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('classroom.manage', $data);
    }

    public function addMurid(Request $request, $classroomId)
    {
        $classroom = Classroom::findOrFail($classroomId);

        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $studentId = $request->input('student_id');
        $student = Student::findOrFail($studentId);

        $classroom->students()->attach($student);

        return redirect()->route('manage_classroom.index')->with('success', 'Murid berhasil ditambahkan ke kelas.');
    }

    public function activatedClass($classroomId)
    {
        $classroom = Classroom::findOrFail($classroomId);

        $classroom->aktif = !$classroom->aktif;
        $classroom->save();

        return redirect()->route('manage_classroom.index')->with('success', 'Status kelas berhasil diubah.');
    }
}
