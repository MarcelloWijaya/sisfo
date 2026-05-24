<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Branch;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('branch')->latest()->paginate(15);
        $branches = Branch::where('status', 'active')->get();

        return view('teachers.index', compact('teachers', 'branches'));
    }

    public function create()
    {
        $branches = Branch::where('status', 'active')->get();

        return view('teachers.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female',
            'phone' => 'nullable|string',
            'email' => 'nullable|email|unique:teachers',
            'address' => 'nullable|string',
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'last_education' => 'nullable|string',
            'qualification' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
        ]);

        // Create user account for login
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email ?? strtolower(str_replace(' ', '.', $request->name)) . '@anaku.com',
            'password' => Hash::make('password123'),
            'branch_id' => $request->branch_id,
        ]);
        $user->assignRole('teacher');

        // Create teacher record
        Teacher::create([
            'branch_id' => $request->branch_id,
            'user_id' => $user->id,
            'name' => $request->name,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'address' => $request->address,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'email' => $request->email,
            'last_education' => $request->last_education,
            'qualification' => $request->qualification,
            'status' => $request->status ?? 'active',
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('teachers.index')->with('success', __('all.teacher_created'));
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('branch', 'creator', 'updater');

        $totalClasses = $teacher->schedules()->count();
        $totalPresent = $teacher->attendances()->where('status', 'present')->count();
        $totalAbsent = $teacher->attendances()->where('status', 'absent')->count();
        $schedules = $teacher->schedules()->orderBy('day')->orderBy('start_time')->get();

        return view('teachers.show', compact('teacher', 'totalClasses', 'totalPresent', 'totalAbsent', 'schedules'));
    }

    public function edit(Teacher $teacher)
    {
        $branches = Branch::where('status', 'active')->get();

        return view('teachers.edit', compact('teacher', 'branches'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female',
            'phone' => 'nullable|string',
            'email' => 'nullable|email|unique:teachers,email,' . $teacher->id,
            'address' => 'nullable|string',
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'last_education' => 'nullable|string',
            'qualification' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $teacher->update($request->all());

        // Update user account
        if ($teacher->user_id) {
            $user = User::find($teacher->user_id);
            if ($user) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'branch_id' => $request->branch_id,
                ]);
            }
        }

        return redirect()->route('teachers.index')->with('success', __('all.teacher_updated'));
    }

    public function destroy(Teacher $teacher)
    {
        // Delete user account
        if ($teacher->user_id) {
            User::where('id', $teacher->user_id)->delete();
        }

        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', __('all.teacher_deleted'));
    }
}
