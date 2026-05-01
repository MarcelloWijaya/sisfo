<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = ['invoice_id', 'amount', 'payment_date', 'method', 'created_by', 'updated_by'];

    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function student()
    {
        return $this->hasOneThrough(Student::class, Invoice::class, 'id', 'id', 'invoice_id', 'student_id');
    }
}
