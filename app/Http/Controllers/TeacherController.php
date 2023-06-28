<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Teacher;
use App\Models\TeacherStatus;
use Database\Seeders\TeacherStatusSeeder;
use Illuminate\Support\Facades\Validator;

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
        $teacherStatuses = TeacherStatus::all();

        $data = [
            'centers' => $centers,
            'teacherStatuses' => $teacherStatuses,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('teacher.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'teacher_name' => 'required',
            'nickname' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'religion' => 'required',
            'phone_number' => 'required',
            'last_education' => 'required',
            'teacher_email' => 'required',
            'training_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
        $teacherStatuses = TeacherStatus::all();

        $data = [
            'teacher' => $teacher,
            'centers' => $centers,
            'teacherStatuses' => $teacherStatuses,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('teacher.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'teacher_name' => 'required',
            'nickname' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'religion' => 'required',
            'phone_number' => 'required',
            'last_education' => 'required',
            'teacher_email' => 'required',
            'training_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
