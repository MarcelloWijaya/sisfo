<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // Tambahkan ini
        'branch_id', // Tambahkan ini (bukan center_id)
        'is_active', // Tambahkan ini
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * RELATIONSHIPS
     */

    // Relasi ke Role (PERBAIKI - pakai Role, BUKAN User_role)
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Relasi ke Branch (bukan Center, sesuai database Anda)
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    // Alias untuk center (jika ingin pakai nama center)
    public function center()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    /**
     * ROLE CHECK HELPER METHODS
     */

    // Cek apakah user memiliki role tertentu
    public function hasRole($roleName)
    {
        return $this->role && $this->role->name === $roleName;
    }

    // Cek apakah user Super Admin
    public function isSuperAdmin()
    {
        return $this->hasRole('super_admin');
    }

    // Cek apakah user Admin
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    // Cek apakah user Director
    public function isDirector()
    {
        return $this->hasRole('director');
    }

    // Cek apakah user Guru
    public function isTeacher()
    {
        return $this->hasRole('teacher');
    }

    // Cek apakah user Student (jika ada)
    public function isStudent()
    {
        return $this->hasRole('student');
    }

    // Cek apakah user aktif
    public function isActive()
    {
        return $this->is_active == 1;
    }

    /**
     * SCOPE QUERIES
     */

    // Scope untuk user aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    // Scope berdasarkan role
    public function scopeByRole($query, $roleName)
    {
        return $query->whereHas('role', function ($q) use ($roleName) {
            $q->where('name', $roleName);
        });
    }

    /**
     * ACCESSORS & MUTATORS
     */

    // Full name accessor
    public function getFullNameAttribute()
    {
        return $this->name;
    }

    // Role name accessor
    public function getRoleNameAttribute()
    {
        return $this->role ? $this->role->name : 'No Role';
    }
}
