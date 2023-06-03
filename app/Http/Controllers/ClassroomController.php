<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::all();

        $data = [
            'classrooms' => $classrooms,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('classroom.index', $data);
    }

    public function detail()
    {
        $classrooms = Classroom::all();

        $data = [
            'classrooms' => $classrooms,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('classroom.detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('classroom.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'teacher_id' => 'required',
            'student_id' => 'required',
            'class_name' => 'required',
            'class_code' => 'required|unique:classrooms',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $classroom = new Classroom();
        $classroom->center_id = $request->input('center_id');
        $classroom->teacher_id = $request->input('teacher_id');
        $classroom->student_id = $request->input('student_id');
        $classroom->class_name = $request->input('class_name');
        $classroom->class_code = $request->input('class_code');
        $classroom->save();

        return redirect()->route('classroom.index')->with('success', 'Classroom created successfully.');
    }

    public function edit($classroom_id)
    {
        $classroom = Classroom::find($classroom_id);

        if (!$classroom) {
            return redirect()->route('classroom.index')->withErrors('Classroom not found.');
        }

        $data = [
            'classroom' => $classroom,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('classroom.edit', $data);
    }

    public function update(Request $request, $classroom_id)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'teacher_id' => 'required',
            'student_id' => 'required',
            'class_name' => 'required',
            'class_code' => 'required|unique:classrooms,class_code,' . $classroom_id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $classroom = Classroom::find($classroom_id);

        if (!$classroom) {
            return redirect()->route('classroom.index')->withErrors('Classroom not found.');
        }

        $classroom->center_id = $request->input('center_id');
        $classroom->teacher_id = $request->input('teacher_id');
        $classroom->student_id = $request->input('student_id');
        $classroom->class_name = $request->input('class_name');
        $classroom->class_code = $request->input('class_code');
        $classroom->save();

        return redirect()->route('classroom.index')->with('success', 'Classroom updated successfully.');
    }

    public function destroy($classroom_id)
    {
        $classroom = Classroom::find($classroom_id);

        if (!$classroom) {
            return redirect()->route('classroom.index')->withErrors('Classroom not found.');
        }

        $classroom->delete();

        return redirect()->route('classroom.index')->with('delete', 'Classroom deleted successfully.');
    }
}
