<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Classroom;
use App\Models\ClassroomStatus;
use App\Models\Teacher;
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
        $centers = Center::all();
        $teachers = Teacher::all();
        $classroomStatuses = ClassroomStatus::all();

        $data = [
            'centers' => $centers,
            'teachers' => $teachers,
            'classroomStatuses' => $classroomStatuses,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('classroom.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'teacher_id' => 'required',
            'class_name' => 'required',
            'aktif' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $classroom = new Classroom();
        $classroom->center_id = $request->input('center_id');
        $classroom->day = $request->input('day');
        $classroom->start_time = $request->input('start_time');
        $classroom->end_time = $request->input('end_time');
        $classroom->teacher_id = $request->input('teacher_id');
        $classroom->class_name = $request->input('class_name');
        $classroom->aktif = $request->input('aktif');
        $classroom->save();

        return redirect()->route('classroom.index')->with('success', 'Classroom created successfully.');
    }


    public function edit($classroom_id)
    {
        $classroom = Classroom::find($classroom_id);
        $centers = Center::all();
        $teachers = Teacher::all();
        $classroomStatuses = ClassroomStatus::all();

        if (!$classroom) {
            return redirect()->route('classroom.index')->withErrors('Classroom not found.');
        }

        $data = [
            'centers' => $centers,
            'teachers' => $teachers,
            'classroom' => $classroom,
            'classroomStatuses' => $classroomStatuses,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('classroom.edit', $data);
    }

    public function update(Request $request, $classroom_id)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'teacher_id' => 'required',
            'class_name' => 'required',
            'aktif' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $classroom = Classroom::find($classroom_id);

        if (!$classroom) {
            return redirect()->route('classroom.index')->withErrors('Classroom not found.');
        }

        $classroom->day = $request->input('day');
        $classroom->center_id = $request->input('center_id');
        $classroom->start_time = $request->input('start_time');
        $classroom->end_time = $request->input('end_time');
        $classroom->teacher_id = $request->input('teacher_id');
        $classroom->class_name = $request->input('class_name');
        $classroom->aktif = $request->input('aktif');
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
