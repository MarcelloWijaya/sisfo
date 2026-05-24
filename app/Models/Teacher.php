<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'user_id', 'name', 'nickname', 'gender', 'address', 'place_of_birth', 'date_of_birth', 'phone', 'email', 'last_education', 'qualification', 'status', 'created_by', 'updated_by'];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function schedules()
    {
        return $this->hasMany(Classroom::class, 'teacher_id');
    }

    public function attendances()
    {
        return $this->hasMany(TeacherAttendance::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
