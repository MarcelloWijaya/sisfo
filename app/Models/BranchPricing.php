<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchPricing extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'academic_year', 'payment_type', 'registration_fee', 'equipment_fee', 'course_fee', 'description', 'created_by', 'updated_by'];

    protected $casts = [
        'registration_fee' => 'integer',
        'equipment_fee' => 'integer',
        'course_fee' => 'integer',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getTotalFeeAttribute()
    {
        return $this->registration_fee + $this->equipment_fee + $this->course_fee;
    }

    public function getFormattedRegistrationFeeAttribute()
    {
        return 'Rp ' . number_format($this->registration_fee, 0, ',', '.');
    }

    public function getFormattedEquipmentFeeAttribute()
    {
        return 'Rp ' . number_format($this->equipment_fee, 0, ',', '.');
    }

    public function getFormattedCourseFeeAttribute()
    {
        return 'Rp ' . number_format($this->course_fee, 0, ',', '.');
    }

    public function getFormattedTotalFeeAttribute()
    {
        return 'Rp ' . number_format($this->total_fee, 0, ',', '.');
    }

    public static function getPaymentTypes()
    {
        return [
            'monthly' => 'Monthly',
            'quarterly' => 'Quarterly',
            'semester' => 'Semester',
            'yearly' => 'Yearly',
        ];
    }
}
