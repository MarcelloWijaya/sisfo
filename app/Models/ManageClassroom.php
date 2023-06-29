<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageClassroom extends Model
{
    use HasFactory;

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
