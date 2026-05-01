<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'students';

    protected $fillable = ['student_code', 'registration_number', 'name', 'gender', 'birth_place', 'birth_date', 'religion', 'address', 'phone', 'school_name', 'father_name', 'mother_name', 'parent_email', 'parent_phone', 'entry_level', 'join_date', 'student_status', 'photo_url', 'branch_id', 'is_active', 'created_by', 'updated_by'];

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
        return $this->belongsToMany(Classes::class, 'class_enrollments', 'student_id', 'class_id')->withPivot('join_date', 'is_active')->withTimestamps();
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'student_id');
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Invoice::class, 'student_id', 'invoice_id');
    }

    public function presences()
    {
        return $this->hasMany(Presence::class, 'student_id');
    }
}
