<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ModuleHelper
{
    public static function hasModule($moduleName)
    {
        $user = Auth::user();
        if (!$user) {
            return false;
        }

        $roleId = $user->role_id;

        // Ambil semua module_id dari role_modules
        $userModuleIds = DB::table('role_modules')->where('role_id', $roleId)->pluck('module_id')->toArray();

        // Ambil nama module
        $userModules = DB::table('modules')->whereIn('id', $userModuleIds)->pluck('name')->toArray();

        return in_array($moduleName, $userModules);
    }
}
