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

    public function manage_classrooms()
    {
        return $this->hasMany(ManageClassroom::class);
    }
}
