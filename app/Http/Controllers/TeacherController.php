<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        $data = [
            'teachers' => $teachers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('teacher.index', $data);
    }

    public function create()
    {
        $centers = Center::all();

        $data = [
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('teacher.create', $data);
    }

    public function store(Request $request)
    {
        $teacher = new Teacher;
        $teacher->center_id = $request->center_id;
        $teacher->teacher_name = $request->teacher_name;
        $teacher->nickname = $request->nickname;
        $teacher->gender = $request->gender;
        $teacher->address = $request->address;
        $teacher->place_of_birth = $request->place_of_birth;
        $teacher->date_of_birth = $request->date_of_birth;
        $teacher->religion = $request->religion;
        $teacher->phone_number = $request->phone_number;
        $teacher->last_education = $request->last_education;
        $teacher->teacher_email = $request->teacher_email;
        $teacher->training_date = $request->training_date;
        $teacher->save();

        return redirect()->route('teacher.index')->with('success', 'Teacher created successfully.');
    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);
        $centers = Center::all();

        $data = [
            'teacher' => $teacher,
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('teacher.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        $teacher->center_id = $request->center_id;
        $teacher->teacher_name = $request->teacher_name;
        $teacher->nickname = $request->nickname;
        $teacher->gender = $request->gender;
        $teacher->address = $request->address;
        $teacher->place_of_birth = $request->place_of_birth;
        $teacher->date_of_birth = $request->date_of_birth;
        $teacher->religion = $request->religion;
        $teacher->phone_number = $request->phone_number;
        $teacher->last_education = $request->last_education;
        $teacher->teacher_email = $request->teacher_email;
        $teacher->training_date = $request->training_date;
        $teacher->save();

        return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();

        return redirect()->route('teacher.index')->with('delete', 'Teacher deleted successfully.');
    }
}
