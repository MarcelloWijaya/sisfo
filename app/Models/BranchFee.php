<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchFee extends Model
{
    use HasFactory;

    protected $table = 'branch_fees';

    protected $fillable = ['branch_id', 'academic_year', 'payment_type', 'registration_fee', 'equipment_fee', 'course_fee', 'notes', 'is_active', 'created_by', 'updated_by'];

    protected $casts = [
        'is_active' => 'boolean',
        'registration_fee' => 'decimal:2',
        'equipment_fee' => 'decimal:2',
        'course_fee' => 'decimal:2',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
