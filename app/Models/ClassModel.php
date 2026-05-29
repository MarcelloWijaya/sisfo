<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class_models';

    protected $fillable = ['branch_id', 'name', 'grade', 'status'];

    protected $casts = [
        'status' => 'string',
    ];

    // Relasi ke Branch
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Relasi ke Schedules
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'class_id');
    }

    // Relasi ke Students (jika ada)
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    // Scope untuk yang aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Accessor untuk nama lengkap dengan grade
    public function getFullNameAttribute()
    {
        return $this->grade ? "{$this->name} - Grade {$this->grade}" : $this->name;
    }
}
