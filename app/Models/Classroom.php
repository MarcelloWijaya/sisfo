<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function status()
    {
        return $this->belongsTo(ClassroomStatus::class);
    }

    public function manageClassrooms()
    {
        return $this->hasMany(ManageClassroom::class);
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
