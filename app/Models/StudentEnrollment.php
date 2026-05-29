<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentEnrollment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'branch_id', 'program_name', 'billing_cycle', 'fee_amount', 'start_date', 'end_date', 'next_invoice_date', 'status', 'notes'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'next_invoice_date' => 'date',
        'fee_amount' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'enrollment_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function getBillingCycleLabelAttribute(): string
    {
        return match ($this->billing_cycle) {
            'monthly' => '1 Bulan',
            '3-month' => '3 Bulan',
            '6-month' => '6 Bulan',
            '12-month' => '12 Bulan',
            default => $this->billing_cycle,
        };
    }

    public function getNextInvoiceDateMonthsAttribute(): int
    {
        return match ($this->billing_cycle) {
            'monthly' => 1,
            '3-month' => 3,
            '6-month' => 6,
            '12-month' => 12,
            default => 1,
        };
    }
}
