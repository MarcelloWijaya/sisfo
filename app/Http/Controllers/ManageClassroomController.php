<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ManageClassroom;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManageClassroomController extends Controller
{
    public function index()
    {
        $manage_classrooms = ManageClassroom::all();
        $grouped_classrooms = $manage_classrooms->groupBy('classroom_id');
        $students = Student::all();

        $data = [
            'manage_classrooms' => $manage_classrooms,
            'grouped_classrooms' => $grouped_classrooms,
            'students' => $students,
            'title' => 'Absensi'
        ];

        return view('classroom.manage', $data);
    }

    public function store(Request $request, int $classroom_id)
    {
        $validator = Validator::make($request->all(), [
            'classroom_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $manage_classroom = new ManageClassroom();
        $manage_classroom->classroom_id = $classroom_id;
        $manage_classroom->save();

        return redirect()->route('classroom.manage')->with('success', 'Manage Classroom created successfully.');
    }

    public function addMurid(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'classroom_id' => 'required',
            'student_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $classroom_id = $request->input('classroom_id');
        $student_id = $request->input('student_id');

        $manageClassroom = new ManageClassroom();
        $manageClassroom->classroom_id = $classroom_id;
        $manageClassroom->student_id = $student_id;
        $manageClassroom->save();

        return redirect()->route('classroom.manage')->with('success', 'Manage Classroom created successfully.');
    }

    public function removeMurid(int $manageClassroom_id)
    {
        $manage_classroom = ManageClassroom::find($manageClassroom_id);

        if ($manage_classroom) {
            $student_id = $manage_classroom->student_id;
            $manage_classroom->delete();
            return redirect()->route('classroom.manage')->with('delete', 'Murid berhasil dihapus dari kelas.');
        } else {
            return redirect()->route('classroom.manage')->with('delete', 'Data tidak ditemukan.');
        }
    }

    public function teaching(Request $request)
    {
        $manage_classrooms = ManageClassroom::all();
        $teachers = Teacher::all();
        $students = Student::all();

        $grouped_classrooms = $manage_classrooms->groupBy('classroom_id');
        $selected_teacher_id = $request->input('teacher_id');

        $teacher = $selected_teacher_id ? Teacher::find($selected_teacher_id) : null;
        $teacher_name = $teacher ? $teacher->name : '';

        $count = 0;
        $total_students = 0;

        if ($teacher) {
            foreach ($teacher->classrooms as $classroom) {
                foreach ($classroom->manageClassrooms as $manageClassroom) {
                    if ($manageClassroom->student_id) {
                        $count++;
                    }
                }
            }
            $total_students = $count;
        }

        $data = [
            'manage_classrooms' => $manage_classrooms,
            'grouped_classrooms' => $grouped_classrooms,
            'teachers' => $teachers,
            'students' => $students,
            'selected_teacher_id' => $selected_teacher_id,
            'total_students' => $total_students,
            'teacher_name' => $teacher_name,
            'title' => 'Absensi',
        ];

        return view('classroom.teaching', $data);
    }
}
