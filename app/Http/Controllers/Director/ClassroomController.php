<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index(Request $request)
    {
        $query = Classroom::with(['teacher', 'branch']);

        if ($request->filled('search')) {
            $query->where('activity', 'like', "%{$request->search}%")->orWhere('room', 'like', "%{$request->search}%");
        }

        $classrooms = $query->paginate(15);

        // PAKAI VIEW YANG SUDAH ADA
        return view('classrooms.index', compact('classrooms'));
    }

    public function manage(Request $request)
    {
        $teachers = Teacher::where('status', 'active')->get();

        $query = Classroom::with(['teacher', 'branch']);

        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        $schedules = $query->orderBy('day')->orderBy('start_time')->get();

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $schedulesByDay = [];

        foreach ($days as $day) {
            $schedulesByDay[$day] = $schedules->filter(fn($s) => $s->day == $day);
        }

        // PAKAI VIEW YANG SUDAH ADA ATAU BUAT KHUSUS DIRECTOR
        return view('director.classrooms.manage', compact('schedulesByDay', 'days', 'teachers'));
    }
}
