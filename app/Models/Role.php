<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['name', 'created_by', 'updated_by'];

    /**
     * RELATIONSHIPS
     */

    // Relasi ke User
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    // Relasi ke RoleMenuPermissions
    public function menuPermissions()
    {
        return $this->hasMany(RoleMenuPermission::class, 'role_id');
    }

    /**
     * HELPER METHODS
     */

    public function isSuperAdmin()
    {
        return $this->name === 'super_admin';
    }

    public function isAdmin()
    {
        return $this->name === 'admin';
    }

    public function isDirector()
    {
        return $this->name === 'director';
    }

    public function isTeacher()
    {
        return $this->name === 'teacher';
    }
}
