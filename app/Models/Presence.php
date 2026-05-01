<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presence extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'presences';

    protected $fillable = ['student_id', 'class_id', 'teacher_id', 'date', 'status', 'check_in_time', 'check_out_time', 'latitude', 'longitude', 'notes', 'photo_url', 'is_active', 'created_by', 'updated_by'];

    protected $casts = [
        'date' => 'date',
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_active' => 'boolean',
    ];

    // Status constants
    const STATUS_PRESENT = 'present';
    const STATUS_ABSENT = 'absent';
    const STATUS_LATE = 'late';
    const STATUS_EXCUSED = 'excused';
    const STATUS_SICK = 'sick';

    // Status options for dropdown
    public static $statuses = [
        self::STATUS_PRESENT => 'Present / Hadir',
        self::STATUS_ABSENT => 'Absent / Tidak Hadir',
        self::STATUS_LATE => 'Late / Terlambat',
        self::STATUS_EXCUSED => 'Excused / Izin',
        self::STATUS_SICK => 'Sick / Sakit',
    ];

    // Relasi ke Student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Relasi ke Class
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    // Relasi ke Teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    // Helper methods
    public function isPresent()
    {
        return $this->status === self::STATUS_PRESENT;
    }

    public function isAbsent()
    {
        return $this->status === self::STATUS_ABSENT;
    }

    public function isLate()
    {
        return $this->status === self::STATUS_LATE;
    }

    public function isExcused()
    {
        return $this->status === self::STATUS_EXCUSED;
    }

    public function isSick()
    {
        return $this->status === self::STATUS_SICK;
    }

    // Get status badge HTML
    public function getStatusBadgeAttribute()
    {
        $badges = [
            self::STATUS_PRESENT => '<span class="badge badge-success">Present</span>',
            self::STATUS_ABSENT => '<span class="badge badge-danger">Absent</span>',
            self::STATUS_LATE => '<span class="badge badge-warning">Late</span>',
            self::STATUS_EXCUSED => '<span class="badge badge-info">Excused</span>',
            self::STATUS_SICK => '<span class="badge badge-secondary">Sick</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge badge-secondary">Unknown</span>';
    }

    // Scope queries
    public function scopeToday($query)
    {
        return $query->whereDate('date', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('date', now()->month)->whereYear('date', now()->year);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    public function scopeByClass($query, $classId)
    {
        return $query->where('class_id', $classId);
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereDate('date', $date);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    // Accessor for check in time formatted
    public function getCheckInTimeFormattedAttribute()
    {
        return $this->check_in_time ? date('H:i', strtotime($this->check_in_time)) : '-';
    }

    public function getCheckOutTimeFormattedAttribute()
    {
        return $this->check_out_time ? date('H:i', strtotime($this->check_out_time)) : '-';
    }
}
