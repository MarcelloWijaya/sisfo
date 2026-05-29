<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function show(Coupon $coupon)
    {
        $coupon->load(['invoice', 'payment', 'student', 'branch']);
        return view('coupons.show', compact('coupon'));
    }

    public function print(Coupon $coupon)
    {
        $coupon->load(['invoice', 'payment', 'student', 'branch']);
        return view('coupons.print', compact('coupon'));
    }
}
