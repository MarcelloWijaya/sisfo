<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User; // Pastikan User model sudah ada jika belum di-import
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Menampilkan semua data role
    public function index()
    {
        // Mendapatkan semua data role dari database
        $roles = Role::all();

        // Mengembalikan tampilan dengan data role
        return view('role.index', compact('roles'));
    }

    // Menampilkan form untuk mengelola role pada akun
    public function manage($role_id)
    {
        // Mendapatkan role berdasarkan ID
        $role = Role::findOrFail($role_id);

        // Mendapatkan semua user yang memiliki role ini
        $users = User::where('role_id', $role_id)->get();

        // Mengembalikan tampilan manage dengan data role dan users
        return view('role.manage', [
            'role' => $role,
            'users' => $users,
            'title' => 'Manage Role: ' . $role->name, // Set title dinamis
        ]);
    }

    // Mengubah role pengguna (misalnya untuk mengelola role akun)
    public function updateUserRole(Request $request, $user_id)
    {
        // Validasi inputan
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        // Mendapatkan user berdasarkan ID
        $user = User::findOrFail($user_id);

        // Menetapkan role baru untuk user
        $user->role_id = $request->role_id;
        $user->save();

        // Redirect setelah berhasil mengupdate role
        return redirect()->route('role.manage', $user->role_id)->with('success', 'Role pengguna berhasil diperbarui.');
    }
}
