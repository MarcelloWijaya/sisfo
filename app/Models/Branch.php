<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'address', 'phone', 'email', 'operational_hours', 'status'];

    protected $casts = [
        'operational_hours' => 'array',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    // TAMBAHKAN RELASI INI
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
