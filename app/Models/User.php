<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'web';

    protected $fillable = ['branch_id', 'name', 'email', 'password', 'phone', 'photo', 'language', 'is_active', 'last_login_at'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function children()
    {
        return $this->belongsToMany(Student::class, 'parent_students', 'parent_id', 'student_id');
    }

    // HAPUS ATAU COMMENT ACCESSOR INI
    // public function getBranchIdAttribute($value)
    // {
    //     if ($this->hasRole('super_admin') || $this->hasRole('director')) {
    //         return null;
    //     }
    //
    //     return $value;
    // }
}
