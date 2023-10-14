<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function classrooms()
    {
        return $this->belongsTo(Classroom::class);
    }
}
