<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Role;
use App\Models\RoleModule;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of modules
     */
    public function index()
    {
        $modules = Module::all();
        return view('module.index', compact('modules'));
    }

    /**
     * Show form to create new module
     */
    public function create()
    {
        return view('module.create');
    }

    /**
     * Store a new module
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:modules,name',
        ]);

        Module::create([
            'name' => $request->name,
            'created_by' => auth()->user()->name,
        ]);

        return redirect()->route('module.index')->with('success', 'Module created successfully.');
    }

    /**
     * Delete a module
     */
    public function destroy($id)
    {
        $module = Module::findOrFail($id);

        // Delete related role_modules first
        RoleModule::where('module_id', $id)->delete();

        $module->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Show role-module assignment page for specific role
     */
    public function roleModule($role_id)
    {
        $role = Role::findOrFail($role_id);
        $modules = Module::all();
        $assignedModules = RoleModule::where('role_id', $role_id)->pluck('module_id')->toArray();

        return view('module.role-module', compact('role', 'modules', 'assignedModules'));
    }

    /**
     * Sync modules for a role
     */
    public function syncRoleModule(Request $request, $role_id)
    {
        // Delete all existing modules for this role
        RoleModule::where('role_id', $role_id)->delete();

        // Insert new modules
        if ($request->has('modules')) {
            foreach ($request->modules as $module_id) {
                RoleModule::create([
                    'role_id' => $role_id,
                    'module_id' => $module_id,
                    'created_by' => auth()->user()->name,
                ]);
            }
        }

        return redirect()->route('role.index')->with('success', 'Role modules updated successfully.');
    }
}
