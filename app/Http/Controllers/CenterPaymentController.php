<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;
use App\Models\CenterPayment;
use Illuminate\Support\Facades\Validator;

class CenterPaymentController extends Controller
{
    public function index()
    {
        $payments = CenterPayment::all();

        $data = [
            'payments' => $payments,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('centerPayment.index', $data);
    }

    public function create()
    {
        $centers = Center::all();

        $data = [
            'centers' => $centers,
            'title' => 'Create Center Payment - Anaku Educare Management Information System (MIS)'
        ];

        return view('centerPayment.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'registration_fee' => 'required',
            'equipment_fee' => 'required',
            'course_fee' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $payment = new CenterPayment;
        $payment->center_id = $request->center_id;
        $payment->registration_fee = $request->registration_fee;
        $payment->equipment_fee = $request->equipment_fee;
        $payment->course_fee = $request->course_fee;
        $payment->save();

        return redirect()->route('centerPayment.index')->with('success', 'Payment created successfully.');
    }

    public function edit($id)
    {
        $payment = CenterPayment::find($id);
        $centers = Center::all();

        $data = [
            'payment' => $payment,
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('centerPayment.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'registration_fee' => 'required',
            'equipment_fee' => 'required',
            'course_fee' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $payment = CenterPayment::find($id);
        $payment->center_id = $request->center_id;
        $payment->registration_fee = $request->registration_fee;
        $payment->equipment_fee = $request->equipment_fee;
        $payment->course_fee = $request->course_fee;
        $payment->save();

        return redirect()->route('centerPayment.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $payment = CenterPayment::find($id);

        $payment->delete();

        return redirect()->route('centerPayment.index')->with('delete', 'Payment deleted successfully.');
    }
}
