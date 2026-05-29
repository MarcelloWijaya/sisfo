<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'day', 'start_time', 'end_time', 'room', 'level', 'teacher_id', 'activity', 'quota', 'status'];

    protected $casts = [
        'start_time' => 'string',
        'end_time' => 'string',
        'quota' => 'integer',
        'status' => 'string',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Accessor untuk format waktu
    public function getTimeRangeAttribute()
    {
        return date('H:i', strtotime($this->start_time)) . ' - ' . date('H:i', strtotime($this->end_time));
    }

    // Daftar hari
    public static function getDays()
    {
        return [
            'Monday' => 'Monday',
            'Tuesday' => 'Tuesday',
            'Wednesday' => 'Wednesday',
            'Thursday' => 'Thursday',
            'Friday' => 'Friday',
            'Saturday' => 'Saturday',
            'Sunday' => 'Sunday',
        ];
    }

    // Daftar level
    public static function getLevels()
    {
        return [
            'Beginner' => 'Beginner',
            'Intermediate' => 'Intermediate',
            'Advanced' => 'Advanced',
        ];
    }
}
