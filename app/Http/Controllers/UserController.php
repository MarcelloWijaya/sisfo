<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index()
    {
        $users = User::with('role', 'branch')->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show form to create new user
     */
    public function create()
    {
        $roles = Role::all();
        $branches = Branch::where('is_active', 1)->get();
        return view('user.create', compact('roles', 'branches'));
    }

    /**
     * Store a new user
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'branch_id' => 'nullable|exists:branches,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'branch_id' => $request->branch_id,
            'is_active' => 1,
            'created_by' => auth()->user()->name,
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    /**
     * Show user detail
     */
    public function show($id)
    {
        $user = User::with('role', 'branch')->findOrFail($id);
        return view('user.detail', compact('user'));
    }

    /**
     * Show form to edit user
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $branches = Branch::where('is_active', 1)->get();
        return view('user.edit', compact('user', 'roles', 'branches'));
    }

    /**
     * Update user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
            'branch_id' => 'nullable|exists:branches,id',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'branch_id' => $request->branch_id,
            'is_active' => $request->is_active ?? 1,
            'updated_by' => auth()->user()->name,
        ]);

        // Update password if provided
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    /**
     * Delete user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting yourself
        if ($user->id == auth()->user()->id) {
            return response()->json(['success' => false, 'message' => 'Cannot delete your own account.']);
        }

        $user->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Activate/Deactivate user
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Prevent changing your own status
        if ($user->id == auth()->user()->id) {
            return back()->with('error', 'Cannot change your own status.');
        }

        $user->is_active = !$user->is_active;
        $user->updated_by = auth()->user()->name;
        $user->save();

        $status = $user->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "User {$status} successfully.");
    }
}
