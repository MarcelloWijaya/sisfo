<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function course()
    {
        return $this->belongsToMany(Course::class);
    }

    public function manageClassrooms()
    {
        return $this->hasMany(ManageClassroom::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, Student_mapping::class, 'classroom_id', 'student_id');
    }
}
