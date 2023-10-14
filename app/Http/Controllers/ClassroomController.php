<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ManageClassroom;
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
            'title' => 'Absensi'
        ];

        return view('classroom.index', $data);
    }

    public function detail()
    {
        $classrooms = Classroom::all();

        $data = [
            'classrooms' => $classrooms,
            'title' => 'Absensi'
        ];

        return view('classroom.detail', $data);
    }

    public function create()
    {
        $teachers = Teacher::all();

        $data = [
            'teachers' => $teachers,
            'title' => 'Absensi'
        ];

        return view('classroom.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $classroom = new Classroom();
        $classroom->name = $request->input('name');
        $classroom->save();

        $requestData = [
            'classroom_id' => $classroom->id,
        ];

        $request = new Request($requestData);

        $ManageClassroomController = new ManageClassroomController();
        $ManageClassroomController->store($request, $classroom->id);

        return redirect()->route('classroom.index')->with('success', 'Classroom created successfully.');
    }

    public function edit($classroom_id)
    {
        $classroom = Classroom::find($classroom_id);
        $teachers = Teacher::all();

        if (!$classroom) {
            return redirect()->route('classroom.index')->withErrors('Classroom not found.');
        }

        $data = [
            'teachers' => $teachers,
            'classroom' => $classroom,
            'title' => 'Absensi'
        ];

        return view('classroom.edit', $data);
    }

    public function update(Request $request, $classroom_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $classroom = Classroom::find($classroom_id);

        if (!$classroom) {
            return redirect()->route('classroom.index')->withErrors('Classroom not found.');
        }

        $classroom->name = $request->input('name');
        $classroom->save();

        $requestData = [
            'classroom_id' => $classroom->id,
        ];

        $request = new Request($requestData);

        $ManageClassroomController = new ManageClassroomController();
        $ManageClassroomController->store($request, $classroom->id);

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
