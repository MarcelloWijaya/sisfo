<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['coupon_code', 'invoice_id', 'payment_id', 'student_id', 'branch_id', 'student_name', 'program_name', 'amount_paid', 'payment_date', 'billing_period', 'is_used', 'issued_at'];

    protected $casts = [
        'payment_date' => 'date',
        'issued_at' => 'datetime',
        'amount_paid' => 'decimal:2',
        'is_used' => 'boolean',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Generate coupon code: CPN-BRN01-230526143022
    public static function generateCode(Branch $branch): string
    {
        $branchCode = strtoupper(str_replace([' ', '-'], '', $branch->code ?? 'BRN'));
        $timestamp = now()->format('dmyHis');
        return "CPN-{$branchCode}-{$timestamp}";
    }
}
