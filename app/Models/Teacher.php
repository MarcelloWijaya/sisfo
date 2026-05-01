<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'teachers';

    protected $fillable = ['teacher_code', 'name', 'nickname', 'gender', 'birth_place', 'birth_date', 'religion', 'address', 'phone', 'email', 'last_education', 'join_date', 'teacher_level', 'teacher_status', 'photo_url', 'branch_id', 'is_active', 'created_by', 'updated_by'];

    protected $casts = [
        'birth_date' => 'date',
        'join_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function classes()
    {
        return $this->hasMany(Classes::class, 'teacher_id');
    }
}
