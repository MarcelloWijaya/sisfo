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
            'title' => 'Absensi'
        ];

        return view('teacher.index', $data);
    }

    public function detail(int $teacher_id)
    {
        $teacher = Teacher::find($teacher_id);

        $data = [
            'teacher' => $teacher,
            'teacher_id' => $teacher_id,
            'title' => 'Absensi'
        ];

        return view('teacher.detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Absensi'
        ];

        return view('teacher.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teacher = new Teacher;
        $teacher->name = $request->name;
        $teacher->phone_number = $request->phone_number;
        $teacher->email = $request->email;
        $teacher->save();

        return redirect()->route('teacher.index')->with('success', 'Teacher created successfully.');
    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);

        $data = [
            'teacher' => $teacher,
            'title' => 'Absensi'
        ];

        return view('teacher.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
        ]);

        if (Auth::user()->center_id == null) {
            $validator->addRules(['status_id' => 'required']);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teacher = Teacher::find($id);
        $teacher->name = $request->name;
        $teacher->phone_number = $request->phone_number;
        $teacher->email = $request->email;
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
