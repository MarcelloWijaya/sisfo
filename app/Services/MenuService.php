<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\RoleMenuPermission;

class MenuService
{
    public function getUserMenus($roleId)
    {
        $menus = Menu::where('is_active', 1)
            ->whereHas('permissions', function ($query) use ($roleId) {
                $query->where('role_id', $roleId);
            })
            ->orWhereNull('parent_id')
            ->orderBy('parent_id')
            ->orderBy('order')
            ->get();

        return $menus;
    }

    public function hasPermission($roleId, $menuName, $permission)
    {
        return RoleMenuPermission::where('role_id', $roleId)
            ->whereHas('menu', function ($query) use ($menuName) {
                $query->where('name', $menuName);
            })
            ->whereHas('permission', function ($query) use ($permission) {
                $query->where('name', $permission);
            })
            ->exists();
    }
}
