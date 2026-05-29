<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'user_id', 'student_number', 'name', 'gender', 'address', 'place_of_birth', 'date_of_birth', 'religion', 'phone', 'school_name', 'grade_level', 'parent_name', 'parent_phone', 'parent_email', 'registration_date', 'join_date', 'book_level', 'status'];

    protected $casts = [
        'date_of_birth' => 'date',
        'registration_date' => 'date',
        'join_date' => 'date',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
