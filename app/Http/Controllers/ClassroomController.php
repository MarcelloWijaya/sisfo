<?php

namespace App\Http\Controllers;

use App\Models\Classes; // Ganti Classroom dengan Classes
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassroomController extends Controller
{
    /**
     * Display a listing of classes
     */
    public function index()
    {
        $classrooms = Classes::with(['teacher', 'branch'])->get(); // Eager loading relasi

        $data = [
            'classrooms' => $classrooms,
            'title' => 'Manajemen Kelas',
        ];

        return view('classroom.index', $data);
    }

    /**
     * Display class details with students
     */
    public function detail($classroom_id)
    {
        $classroom = Classes::with(['teacher', 'branch', 'students'])->findOrFail($classroom_id);

        $data = [
            'classroom' => $classroom,
            'title' => 'Detail Kelas',
        ];

        return view('classroom.detail', $data);
    }

    /**
     * Show form to create new class
     */
    public function create()
    {
        $teachers = Teacher::where('is_active', 1)->get();
        $branches = Branch::where('is_active', 1)->get();

        $data = [
            'teachers' => $teachers,
            'branches' => $branches,
            'title' => 'Tambah Kelas Baru',
        ];

        return view('classroom.create', $data);
    }

    /**
     * Store a new class
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'teacher_id' => 'nullable|exists:teachers,id',
            'branch_id' => 'nullable|exists:branches,id',
            'class_status' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $classroom = new Classes();
        $classroom->name = $request->input('name');
        $classroom->teacher_id = $request->input('teacher_id');
        $classroom->branch_id = $request->input('branch_id');
        $classroom->class_status = $request->input('class_status', 'Active');
        $classroom->is_active = 1;
        $classroom->created_by = auth()->user()->name ?? 'system';
        $classroom->save();

        return redirect()->route('classroom.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Show form to edit class
     */
    public function edit($classroom_id)
    {
        $classroom = Classes::findOrFail($classroom_id);
        $teachers = Teacher::where('is_active', 1)->get();
        $branches = Branch::where('is_active', 1)->get();

        $data = [
            'teachers' => $teachers,
            'branches' => $branches,
            'classroom' => $classroom,
            'title' => 'Edit Kelas',
        ];

        return view('classroom.edit', $data);
    }

    /**
     * Update class data
     */
    public function update(Request $request, $classroom_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'teacher_id' => 'nullable|exists:teachers,id',
            'branch_id' => 'nullable|exists:branches,id',
            'class_status' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $classroom = Classes::findOrFail($classroom_id);
        $classroom->name = $request->input('name');
        $classroom->teacher_id = $request->input('teacher_id');
        $classroom->branch_id = $request->input('branch_id');
        $classroom->class_status = $request->input('class_status', 'Active');
        $classroom->updated_by = auth()->user()->name ?? 'system';
        $classroom->save();

        return redirect()->route('classroom.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Delete class (soft delete)
     */
    public function destroy($classroom_id)
    {
        $classroom = Classes::findOrFail($classroom_id);
        $classroom->delete();

        return redirect()->route('classroom.index')->with('success', 'Kelas berhasil dihapus.');
    }

    /**
     * Get class schedule
     */
    public function schedule($classroom_id)
    {
        $classroom = Classes::with(['schedules'])->findOrFail($classroom_id);

        return view('classroom.schedule', [
            'classroom' => $classroom,
            'title' => 'Jadwal Kelas',
        ]);
    }

    /**
     * Get students in class
     */
    public function getStudents($classroom_id)
    {
        $classroom = Classes::with('students')->findOrFail($classroom_id);

        return response()->json([
            'success' => true,
            'students' => $classroom->students,
        ]);
    }
}
