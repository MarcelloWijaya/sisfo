<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\CouponStatus;
use App\Models\Center;
use App\Models\CouponBundle;
use Illuminate\Support\Facades\Validator;


class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        $coupon_statuses = CouponStatus::all();

        $data = [
            'coupons' => $coupons,
            'coupon_statuses' => $coupon_statuses,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('coupon.index', $data);
    }

    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->coupon_bundle_id = $request->coupon_bundle_id;
        $coupon->status_id = 2; // Assuming status_id 2 represents the desired status
        $coupon->save();

        return redirect()->back()->with('success', 'Coupon created successfully.');
    }

    public function createCoupon()
    {
        $coupon_bundles = CouponBundle::all();

        $data = [
            'coupon_bundles' => $coupon_bundles,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('coupon.create', $data);
    }

    public function storeCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();
        if (!$user->center_id) {
            return redirect()->back()->with('delete', 'Invalid center.');
        }

        $center = Center::find($user->center_id);
        if (!$center) {
            return redirect()->back()->with('delete', 'Invalid center.');
        }

        $coupon_bundle = new CouponBundle();
        $coupon_bundle->center_id = $user->center_id;
        $coupon_bundle->quantity = $request->quantity;
        $coupon_bundle->order_date = now();
        $coupon_bundle->save();

        $coupon = new Coupon();
        $coupon->coupon_bundle_id = $coupon_bundle->id;
        $coupon->status_id = 2;
        $coupon->save();

        return redirect()->back()->with('success', 'Coupon order placed successfully.');
    }

    public function updateStatus(Request $request, $coupon_id)
    {
        $request->validate([
            'status_id' => 'required|exists:coupon_statuses,id',
        ]);

        $coupon = Coupon::findOrFail($coupon_id);
        $status_id = $request->input('status_id');

        if ($status_id == 1) {
            $quantity = $coupon->quantity;

            for ($i = 0; $i < $quantity; $i++) {
                $currentDate = now();
                $couponCode = 'ABT' . $currentDate->format('Ymd') . sprintf('%02d', $i + 1);
                $coupon->coupon_code = $couponCode;
                $coupon->save();
            }
        }

        $coupon->status_id = $status_id;
        $coupon->save();

        return redirect()->back()->with('success', 'Coupon status updated successfully');
    }
}
