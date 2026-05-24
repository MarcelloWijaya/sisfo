<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'branch_id', 'student_id', 'amount_paid', 'payment_date', 'payment_method', 'bank_name', 'reference_number', 'confirmed_by', 'confirmed_at', 'notes'];

    protected $casts = [
        'payment_date' => 'date',
        'confirmed_at' => 'datetime',
        'amount_paid' => 'decimal:2',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function confirmedBy()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }
    public function coupon()
    {
        return $this->hasOne(Coupon::class);
    }

    public function getMethodLabelAttribute(): string
    {
        return match ($this->payment_method) {
            'cash' => 'Tunai',
            'bank_transfer' => 'Transfer Bank',
            default => $this->payment_method,
        };
    }
}
