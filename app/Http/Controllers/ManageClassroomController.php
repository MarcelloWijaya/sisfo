<?php

namespace App\Http\Controllers;

use App\Models\Center;
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
        $students = Student::all();

        $data = [
            'manage_classrooms' => $manage_classrooms,
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student_id = $request->input('student_id');

        $manageClassroom = new ManageClassroom();
        $manageClassroom->center_id = $manageClassroom->center_id;
        $manageClassroom->classroom_id = $manageClassroom->classroom_id;
        $manageClassroom->student_id = $student_id;
        $manageClassroom->save();

        return redirect()->route('classroom.manage')->with('success', 'Manage Classroom created successfully.');
    }

    public function destroy(int $manageClassroom_id)
    {
        $manage_classroom = ManageClassroom::findOrFail($manageClassroom_id);
        $manage_classroom->delete();

        return redirect()->route('classroom.manage')->with('delete', 'Murid berhasil dihapus dari kelas.');
    }
}
