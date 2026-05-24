<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $branchId = $user->hasRole('super_admin') || $user->hasRole('director') ? $request->get('branch_id') : $user->branch_id;

        $query = Classroom::with(['branch', 'teacher']);

        if ($branchId) {
            $query->where('branch_id', $branchId);
        }

        if ($request->filled('day')) {
            $query->where('day', $request->day);
        }

        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        $classrooms = $query->orderBy('day')->orderBy('start_time')->paginate(15);

        $branches = Branch::where('status', 'active')->get();
        $teachers = Teacher::when($branchId, fn($q) => $q->where('branch_id', $branchId))->where('status', 'active')->get();

        $days = Classroom::getDays();

        return view('classrooms.index', compact('classrooms', 'branches', 'teachers', 'days', 'branchId'));
    }

    public function create()
    {
        $user = Auth::user();
        $branchId = $user->hasRole('super_admin') || $user->hasRole('director') ? null : $user->branch_id;

        $branches = Branch::where('status', 'active')->get();
        $teachers = Teacher::when($branchId, fn($q) => $q->where('branch_id', $branchId))->where('status', 'active')->get();

        $days = Classroom::getDays();
        $levels = Classroom::getLevels();

        return view('classrooms.create', compact('branches', 'teachers', 'days', 'levels', 'branchId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'room' => 'required|string',
            'level' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id',
            'activity' => 'required|string',
            'quota' => 'nullable|integer|min:1',
        ]);

        // Cek konflik ruangan
        $conflict = Classroom::where('branch_id', $request->branch_id)
            ->where('day', $request->day)
            ->where('room', $request->room)
            ->where(function ($q) use ($request) {
                $q->whereBetween('start_time', [$request->start_time, $request->end_time])->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })
            ->exists();

        if ($conflict) {
            return back()
                ->withErrors(['room' => __('all.room_conflict')])
                ->withInput();
        }

        // Cek konflik guru
        $teacherConflict = Classroom::where('branch_id', $request->branch_id)
            ->where('day', $request->day)
            ->where('teacher_id', $request->teacher_id)
            ->where(function ($q) use ($request) {
                $q->whereBetween('start_time', [$request->start_time, $request->end_time])->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })
            ->exists();

        if ($teacherConflict) {
            return back()
                ->withErrors(['teacher_id' => __('all.teacher_conflict')])
                ->withInput();
        }

        Classroom::create($request->all());

        return redirect()->route('classrooms.index')->with('success', __('all.classroom_created'));
    }

    public function show(Classroom $classroom)
    {
        $classroom->load(['branch', 'teacher']);
        return view('classrooms.show', compact('classroom'));
    }

    public function edit(Classroom $classroom)
    {
        $user = Auth::user();
        $branchId = $user->hasRole('super_admin') || $user->hasRole('director') ? null : $user->branch_id;

        $branches = Branch::where('status', 'active')->get();
        $teachers = Teacher::when($branchId, fn($q) => $q->where('branch_id', $branchId))->where('status', 'active')->get();

        $days = Classroom::getDays();
        $levels = Classroom::getLevels();

        return view('classrooms.edit', compact('classroom', 'branches', 'teachers', 'days', 'levels'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'room' => 'required|string',
            'level' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id',
            'activity' => 'required|string',
            'quota' => 'nullable|integer|min:1',
        ]);

        // Cek konflik exclude current
        $conflict = Classroom::where('branch_id', $request->branch_id)
            ->where('day', $request->day)
            ->where('room', $request->room)
            ->where('id', '!=', $classroom->id)
            ->where(function ($q) use ($request) {
                $q->whereBetween('start_time', [$request->start_time, $request->end_time])->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })
            ->exists();

        if ($conflict) {
            return back()
                ->withErrors(['room' => __('all.room_conflict')])
                ->withInput();
        }

        $classroom->update($request->all());

        return redirect()->route('classrooms.index')->with('success', __('all.classroom_updated'));
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return redirect()->route('classrooms.index')->with('success', __('all.classroom_deleted'));
    }
}
