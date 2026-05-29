<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'teacher_id', 'attendance_date', 'status', 'check_in_time', 'check_out_time', 'notes', 'recorded_by'];

    protected $casts = [
        'attendance_date' => 'date',
        'check_in_time' => 'string',
        'check_out_time' => 'string',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function scopePresent($query)
    {
        return $query->where('status', 'present');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'present' => 'bg-green-100 text-green-800',
            'absent' => 'bg-red-100 text-red-800',
            'late' => 'bg-yellow-100 text-yellow-800',
            'excused' => 'bg-blue-100 text-blue-800',
            'sick' => 'bg-purple-100 text-purple-800',
            'leave' => 'bg-orange-100 text-orange-800',
        ];
        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public static function getStatuses()
    {
        return [
            'present' => 'Present',
            'absent' => 'Absent',
            'late' => 'Late',
            'excused' => 'Excused',
            'sick' => 'Sick Leave',
            'leave' => 'Annual Leave',
        ];
    }
}
