<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();

        $data = [
            'payments' => $payments,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('payment.index', $data);
    }

    public function create()
    {
        $centers = Center::all();

        $data = [
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('payment.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'date' => 'required',
            'month' => 'required',
            'year' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $payment = new Payment;
        $payment->center_id = $request->center_id;
        $payment->date = $request->date;
        $payment->status = $request->status;
        $payment->save();

        return redirect()->route('payment.index')->with('success', 'Payment created successfully.');
    }

    public function edit($id)
    {
        $payment = Payment::find($id);
        $centers = Center::all();

        $data = [
            'payment' => $payment,
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('payment.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'date' => 'required',
            'month' => 'required',
            'year' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $payment = Payment::find($id);
        $payment->center_id = $request->center_id;
        $payment->date = $request->date;
        $payment->status = $request->status;
        $payment->save();

        return redirect()->route('payment.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();

        return redirect()->route('payment.index')->with('delete', 'Payment deleted successfully.');
    }
}
