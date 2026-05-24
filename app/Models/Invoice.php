<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_number', 'branch_id', 'student_id', 'enrollment_id', 'program_name', 'amount', 'billing_period_start', 'billing_period_end', 'due_date', 'status', 'notes', 'reminded_7d', 'reminded_due', 'reminded_overdue'];

    protected $casts = [
        'billing_period_start' => 'date',
        'billing_period_end' => 'date',
        'due_date' => 'date',
        'amount' => 'decimal:2',
        'reminded_7d' => 'boolean',
        'reminded_due' => 'boolean',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function enrollment()
    {
        return $this->belongsTo(StudentEnrollment::class, 'enrollment_id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function coupon()
    {
        return $this->hasOne(Coupon::class);
    }

    public function scopeUnpaid($query)
    {
        return $query->where('status', 'unpaid');
    }
    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue');
    }
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'unpaid' => 'bg-yellow-100 text-yellow-800',
            'pending' => 'bg-blue-100 text-blue-800',
            'paid' => 'bg-green-100 text-green-800',
            'overdue' => 'bg-red-100 text-red-800',
            'cancelled' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'unpaid' => 'Belum Bayar',
            'pending' => 'Menunggu Konfirmasi',
            'paid' => 'Lunas',
            'overdue' => 'Terlambat',
            'cancelled' => 'Dibatalkan',
            default => $this->status,
        };
    }

    // Generate invoice number: INV-BRN01-230526143022
    public static function generateNumber(Branch $branch): string
    {
        $branchCode = strtoupper(str_replace([' ', '-'], '', $branch->code ?? 'BRN'));
        $timestamp = now()->format('dmy His');
        $timestamp = str_replace(' ', '', $timestamp); // ddmmyyHHmmss
        return "INV-{$branchCode}-{$timestamp}";
    }
}
