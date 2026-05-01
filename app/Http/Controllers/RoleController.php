<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Module;
use App\Models\RoleModule;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->get();
        $modules = Module::all();
        return view('role.index', compact('roles', 'modules'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'created_by' => auth()->user()->name,
        ]);

        return redirect()->route('role.index')->with('success', 'Role created successfully.');
    }

    public function update(Request $request, $role_id)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name,' . $role_id,
        ]);

        $role = Role::findOrFail($role_id);
        $role->update([
            'name' => $request->name,
            'updated_by' => auth()->user()->name,
        ]);

        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($role_id)
    {
        $role = Role::findOrFail($role_id);

        if ($role->name == 'super_admin') {
            return response()->json(['success' => false, 'message' => 'Cannot delete Super Admin role.']);
        }

        // Delete related role modules first
        RoleModule::where('role_id', $role_id)->delete();

        $role->delete();
        return response()->json(['success' => true]);
    }

    public function addModule(Request $request, $role_id)
    {
        try {
            // Log untuk debugging
            \Log::info('Add module called', ['role_id' => $role_id, 'data' => $request->all()]);

            // Validasi manual
            if (!$request->has('module_ids') && !$request->has('module_id')) {
                return response()->json(['success' => false, 'message' => 'No module selected'], 400);
            }

            // Ambil module_ids (bisa array atau single)
            $moduleIds = $request->has('module_ids') ? $request->module_ids : [$request->module_id];

            foreach ($moduleIds as $module_id) {
                // Check if already exists
                $exists = \App\Models\RoleModule::where('role_id', $role_id)->where('module_id', $module_id)->exists();

                if (!$exists) {
                    \App\Models\RoleModule::create([
                        'role_id' => $role_id,
                        'module_id' => $module_id,
                        'created_by' => auth()->user()->name,
                    ]);
                }
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Add module error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function removeModule(Request $request, $role_id)
    {
        $request->validate([
            'module_id' => 'required',
        ]);

        \App\Models\RoleModule::where('role_id', $role_id)->where('module_id', $request->module_id)->delete();

        return response()->json(['success' => true]);
    }
}
