<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = ['name', 'path', 'parent_id', 'icon', 'order', 'is_active', 'created_by', 'updated_by'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Parent menu relationship
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // Child menus relationship
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    // Role permissions relationship
    public function rolePermissions()
    {
        return $this->hasMany(RoleMenuPermission::class, 'menu_id');
    }

    // Check if menu has children
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    // Get all permissions for this menu by role
    public function getPermissionsByRole($roleId)
    {
        return $this->rolePermissions()->where('role_id', $roleId)->with('permission')->get();
    }
}
