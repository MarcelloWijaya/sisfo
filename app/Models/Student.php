<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function manageClassrooms()
    {
        return $this->hasMany(ManageClassroom::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Clasroom::class, Student_mapping::class, 'student_id', 'classroom_id');
    }
}
