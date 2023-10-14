<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Presence;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PresenceController extends Controller
{
    public function index()
    {
        $presences = Presence::all();

        $data = [
            'presences' => $presences,
            'title' => 'Absensi'
        ];

        return view('presence.index', $data);
    }

    public function report()
    {
        $presences = Presence::all();
        $students = Student::all();
        $grades = Grade::all();
        $classrooms = Classroom::all();

        $data = [
            'presences' => $presences,
            'students' => $students,
            'grades' => $grades,
            'classrooms' => $classrooms,
            'title' => 'Absensi'
        ];

        return view('presence.report', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Absensi'
        ];

        return view('presence.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = Student::where('customer_id', $request->customer_id)->first();

        if ($student) {
            $presence = new Presence;
            $presence->customer_id = $request->customer_id;
            $presence->date_and_time = now();
            $presence->save();

            return redirect()->back()->with('success', 'Absensi berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Customer ID tidak ditemukan.');
        }
    }

    public function loadPresenceTable(Request $request)
    {
        $students = Student::all();
        $grades = Grade::all();
        $classrooms = Classroom::all();

        $data = [
            'students' => $students,
            'grades' => $grades,
            'classrooms' => $classrooms,
            'title' => 'Absensi'
        ];

        $classroomId = $request->input('classroomId');
        $studentId = $request->input('studentId');

        $query = Presence::query();

        if ($classroomId) {
            // Ambil grade_id dari kolom 'grade' dalam tabel classroom
            $classroom = Classroom::find($classroomId);

            if ($classroom) {
                $gradeId = $classroom->grade_id;
                $query->where('grade_id', $gradeId);
            }
        }

        if ($studentId) {
            $query->where('student_id', $studentId);
        }

        $presences = $query->get();

        return view('presence.report', ['presences' => $presences], $data);
    }
}
