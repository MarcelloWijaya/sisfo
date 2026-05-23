<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'user_id', 'teacher_number', 'name', 'nickname', 'gender', 'address', 'place_of_birth', 'date_of_birth', 'phone', 'email', 'last_education', 'join_date', 'salary', 'status'];

    protected $casts = [
        'date_of_birth' => 'date',
        'join_date' => 'date',
        'salary' => 'decimal:2',
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
