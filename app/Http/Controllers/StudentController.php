<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        $data = [
            'students' => $students,
            'title' => 'Absensi'
        ];

        return view('student.index', $data);
    }

    public function detail(int $student_id)
    {
        $student = Student::find($student_id);

        $data = [
            'student' => $student,
            'title' => 'Absensi'
        ];

        return view('student.detail', ['student_id' => $student->id], $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Absensi'
        ];

        return view('student.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_id' => 'required',
            'customer_id' => 'required',
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = new Student;
        $student->card_id = $request->card_id;
        $student->customer_id = $request->customer_id;
        $student->name = $request->name;
        $student->phone_number = $request->phone_number;
        $student->email = $request->email;
        $student->save();

        return redirect()->route('student.index')->with('success', 'Student created successfully.');
    }

    public function edit($id)
    {
        $student = Student::find($id);

        $data = [
            'student' => $student,
            'title' => 'Absensi'
        ];

        return view('student.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'card_id' => 'required',
            'customer_id' => 'required',
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = Student::find($id);
        $student->card_id = $request->card_id;
        $student->customer_id = $request->customer_id;
        $student->name = $request->name;
        $student->phone_number = $request->phone_number;
        $student->email = $request->email;

        $student->save();

        return redirect()->route('student.index')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        $student->payments()->delete();

        $student->delete();

        return redirect()->route('student.index')->with('delete', 'Student deleted successfully.');
    }
}
