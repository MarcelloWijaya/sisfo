<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\User_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function indexHome()
    {
        // Mendapatkan center_id dari user yang sedang login
        $user = Auth::user();

        if ($user->is_admin) {
            // Cek apakah user adalah admin
            // Admin dapat melihat semua data
            $students = Student::all();
            $teachers = Teacher::all();
        } else {
            $centerId = $user->center_id; // Mendapatkan center_id untuk user yang bukan admin

            if ($centerId) {
                // Jika ada center_id, tampilkan data sesuai dengan center_id
                $students = Student::where('center_id', $centerId)->get();
                $teachers = Teacher::where('center_id', $centerId)->get();
            } else {
                // Jika tidak ada center_id, tampilkan data kosong atau sesuai kebijakan
                $students = [];
                $teachers = [];
            }
        }

        $totalStudents = count($students);
        $totalTeachers = count($teachers);

        $data = [
            'total_students' => $totalStudents,
            'total_teachers' => $totalTeachers,
        ];

        return view('admin.homepage', $data);
    }

    public function indexRole()
    {
        $users = User::all();
        $user_roles = User_role::all();

        $data = [
            'users' => $users,
            'user_roles' => $user_roles,
        ];

        return view('admin.role', $data);
    }

    public function createRole(Request $request)
    {
        $rules = [
            'User_role' => 'required|min:5|unique:user_roles,name',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $User_role = new User_role();
        $User_role->name = $request->User_role;
        $User_role->save();

        return back()->with('message', 'Successfully add new User_role.');
    }

    public function giveAccess(int $user_id)
    {
        $user = User::find($user_id);

        $user->is_active = 1;

        $user->save();

        return back()->with('message', 'Successfully give access for ' . $user->username . '.');
    }

    public function removeAccess(int $user_id)
    {
        $user = User::find($user_id);

        $user->is_active = 0;

        $user->save();

        return back()->with('message', 'Successfully remove access for ' . $user->username . '.');
    }

    public function editUser(int $user_id)
    {
        $user = User::find($user_id);

        $data = [
            'user' => $user,
        ];

        return view('admin.edit', $data);
    }

    public function updateUser(Request $request, int $user_id)
    {
        $user = User::find($user_id);
        $user->User_role_id = $request->User_role;
        $user->save();

        return back()->with('message', 'Successfully update User_role for ' . $user->username . '.');
    }

    public function deleteUser(int $user_id)
    {
        $user = User::find($user_id);

        $username = $user->username;

        $user->delete();

        return back()->with('message', 'Successfully delete for ' . $username . '.');
    }
}
