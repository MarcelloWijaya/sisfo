<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function status()
    {
        return $this->belongsTo(TeacherStatus::class);
    }
}
