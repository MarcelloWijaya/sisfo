<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function status()
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    public function payment_type()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
