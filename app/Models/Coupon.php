<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public function status()
    {
        return $this->belongsTo(CouponStatus::class);
    }

    public function coupon_bundle()
    {
        return $this->belongsTo(CouponBundle::class);
    }
}
