<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        $data = [
            'teachers' => $teachers,
            'title' => 'Absensi',
        ];

        return view('teacher.index', $data);
    }

    public function detail(int $teacher_id)
    {
        $teacher = Teacher::find($teacher_id);

        $data = [
            'teacher' => $teacher,
            'teacher_id' => $teacher_id,
            'title' => 'Absensi',
        ];

        return view('teacher.detail', $data);
    }

    public function create()
    {
        $centers = \App\Models\Center::all(); // Ambil semua data cabang

        $data = [
            'title' => 'Absensi',
            'centers' => $centers,
        ];

        return view('teacher.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teacher_name' => 'required',
            'nickname' => 'nullable',
            'gender' => 'nullable',
            'address' => 'nullable',
            'place_of_birth' => 'nullable',
            'date_of_birth' => 'nullable|date',
            'phone_number' => 'required',
            'last_education' => 'nullable',
            'teacher_email' => 'required|email',
            'center_id' => 'required|exists:centers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teacher = new Teacher();
        $teacher->center_id = $request->center_id;
        $teacher->teacher_name = $request->teacher_name;
        $teacher->nickname = $request->nickname;
        $teacher->gender = $request->gender;
        $teacher->address = $request->address;
        $teacher->place_of_birth = $request->place_of_birth;
        $teacher->date_of_birth = $request->date_of_birth;
        $teacher->phone_number = $request->phone_number;
        $teacher->last_education = $request->last_education;
        $teacher->teacher_email = $request->teacher_email;
        $teacher->save();

        return redirect()->route('teacher.index')->with('success', 'Teacher created successfully.');
    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);

        $data = [
            'teacher' => $teacher,
            'title' => 'Absensi',
        ];

        return view('teacher.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'teacher_name' => 'required',
            'nickname' => 'nullable',
            'gender' => 'nullable',
            'address' => 'nullable',
            'place_of_birth' => 'nullable',
            'date_of_birth' => 'nullable|date',
            'phone_number' => 'required',
            'last_education' => 'nullable',
            'teacher_email' => 'required|email',
            'center_id' => 'required|exists:centers,id',
        ]);

        if (Auth::user()->center_id == null) {
            $validator->addRules(['status_id' => 'required']);
        }

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
        $teacher->phone_number = $request->phone_number;
        $teacher->last_education = $request->last_education;
        $teacher->teacher_email = $request->teacher_email;
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
