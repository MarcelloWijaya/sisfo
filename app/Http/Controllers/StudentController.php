<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        $data = [
            'students' => $students,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('student.index', $data);
    }

    public function detail(int $student_id)
    {
        $student = Student::find($student_id);

        $data = [
            'student' => $student,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('student.detail', ['student_id' => $student->id], $data);
    }

    public function create()
    {
        $centers = Center::all();

        $data = [
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('student.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'student_name' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'religion' => 'required',
            'phone_number' => 'required',
            'school_name' => 'required',
            'parent_name' => 'required',
            'entry_date' => 'required',
            'registration_date' => 'required',
            'level' => 'required',
            'book_start' => 'required',
            'parent_email' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = new Student;
        $student->center_id = $request->center_id;
        $student->student_name = $request->student_name;
        $student->gender = $request->gender;
        $student->address = $request->address;
        $student->place_of_birth = $request->place_of_birth;
        $student->date_of_birth = $request->date_of_birth;
        $student->religion = $request->religion;
        $student->phone_number = $request->phone_number;
        $student->school_name = $request->school_name;
        $student->parent_name = $request->parent_name;
        $student->entry_date = $request->entry_date;
        $student->registration_date = $request->registration_date;
        $student->level = $request->level;
        $student->book_start = $request->book_start;
        $student->parent_email = $request->parent_email;
        $student->status = $request->status;
        $student->save();

        return redirect()->route('student.index')->with('success', 'Student created successfully.');
    }

    public function edit($id)
    {
        $student = Student::find($id);
        $centers = Center::all();

        $data = [
            'student' => $student,
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('student.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'student_name' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'religion' => 'required',
            'phone_number' => 'required',
            'school_name' => 'required',
            'parent_name' => 'required',
            'entry_date' => 'required',
            'registration_date' => 'required',
            'level' => 'required',
            'book_start' => 'required',
            'parent_email' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = Student::find($id);
        $student->center_id = $request->center_id;;
        $student->student_name = $request->student_name;
        $student->gender = $request->gender;
        $student->address = $request->address;
        $student->place_of_birth = $request->place_of_birth;
        $student->date_of_birth = $request->date_of_birth;
        $student->religion = $request->religion;
        $student->phone_number = $request->phone_number;
        $student->school_name = $request->school_name;
        $student->parent_name = $request->parent_name;
        $student->entry_date = $request->entry_date;
        $student->registration_date = $request->registration_date;
        $student->level = $request->level;
        $student->book_start = $request->book_start;
        $student->parent_email = $request->parent_email;
        $student->status = $request->status;
        $student->save();

        return redirect()->route('student.index')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();

        return redirect()->route('student.index')->with('delete', 'Student deleted successfully.');
    }
}
