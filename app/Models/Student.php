<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function status()
    {
        return $this->belongsTo(StudentStatus::class);
    }

    public function manageClassrooms()
    {
        return $this->hasMany(ManageClassroom::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Clasroom::class, Student_mapping::class, 'student_id', 'classroom_id');
    }
}
