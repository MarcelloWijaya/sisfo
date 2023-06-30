<?php

namespace App\Http\Controllers;

use App\Models\ManageClassroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManageClassroomController extends Controller
{
    public function index()
    {
        $manage_classrooms = ManageClassroom::all();
        $grouped_classrooms = collect($manage_classrooms)->groupBy(function ($item) {
            return $item['center_id'] . '_' . $item['classroom_id'];
        });
        $students = Student::all();

        $data = [
            'manage_classrooms' => $manage_classrooms,
            'grouped_classrooms' => $grouped_classrooms,
            'students' => $students,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('classroom.manage', $data);
    }

    public function addMurid(Request $request)
    {
        dd($request);

        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'center_id' => 'required',
            'classroom_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $center_id = $request->input('center_id');
        $classroom_id = $request->input('classroom_id');
        $student_id = $request->input('student_id');

        $manageClassroom = new ManageClassroom();
        $manageClassroom->center_id = $center_id;
        $manageClassroom->classroom_id = $classroom_id;
        $manageClassroom->student_id = $student_id;
        $manageClassroom->save();

        return redirect()->route('classroom.manage')->with('success', 'Manage Classroom created successfully.');
    }

    public function removeMurid(int $manageClassroom_id)
    {
        $manage_classroom = ManageClassroom::findOrFail($manageClassroom_id);
        $manage_classroom->delete();

        return redirect()->route('classroom.manage')->with('delete', 'Murid berhasil dihapus dari kelas.');
    }

    public function teaching()
    {
        $manage_classrooms = ManageClassroom::all();
        $grouped_classrooms = collect($manage_classrooms)->groupBy(function ($item) {
            return $item['center_id'] . '_' . $item['classroom_id'];
        });
        $students = Student::all();


        $data = [
            'manage_classrooms' => $manage_classrooms,
            'grouped_classrooms' => $grouped_classrooms,
            'students' => $students,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('classroom.teaching', $data);
    }
}
