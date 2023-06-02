<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\BranchPayment;

class BranchPaymentController extends Controller
{
    public function index()
    {
        $payments = BranchPayment::all();

        $data = [
            'payments' => $payments,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('branchPayment.index', $data);
    }

    public function create()
    {
        $centers = Branch::all();

        $data = [
            'centers' => $centers,
            'title' => 'Create Branch Payment - Anaku Educare Management Information System (MIS)'
        ];

        return view('branchPayment.create', $data);
    }

    public function store(Request $request)
    {
        $payment = new BranchPayment;
        $payment->branch_id = $request->branch_id;
        $payment->registration_fee = $request->registration_fee;
        $payment->equipment_fee = $request->equipment_fee;
        $payment->course_fee = $request->course_fee;
        $payment->save();

        return redirect()->route('payment.index')->with('success', 'Payment created successfully.');
    }

    public function edit($id)
    {
        $payment = BranchPayment::find($id);
        $centers = Branch::all();

        $data = [
            'payment' => $payment,
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('branchPayment.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $payment = BranchPayment::find($id);
        $payment->branch_id = $request->branch_id;
        $payment->registration_fee = $request->registration_fee;
        $payment->equipment_fee = $request->equipment_fee;
        $payment->course_fee = $request->course_fee;
        $payment->save();

        return redirect()->route('branchPayment.index')->with('message', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $payment = BranchPayment::find($id);
        $payment->delete();

        return redirect()->route('branchPayment.index')->with('message', 'Payment deleted successfully.');
    }
}
