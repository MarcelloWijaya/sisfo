<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function indexStudent()
    {
        $students = Student::all();

        $data = [
            'students' => $students,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('payment.student.index', $data);
    }

    public function paymentDetail(int $student_id)
    {
        $payments = Payment::where('student_id', $student_id)->get();
        $student = Student::find($student_id);

        $data = [
            'payments' => $payments,
            'student' => $student,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('payment.student.detail', $data);
    }

    public function indexPayment()
    {
        $payments = Payment::all();

        $data = [
            'payments' => $payments,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('payment.index', $data);
    }

    public function detail(int $student_id)
    {
        $payments = Payment::where('student_id', $student_id)->get();
        // $lastPaymentMonth = $student->payments()->latest('payment_date')->value('bulan');

        $data = [
            'payments' => $payments,
            // 'lastPaymentMonth' => $lastPaymentMonth,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('payment.detail', $data);
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


    public function store(Request $request, int $student_id)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'student_id' => 'required',
            'payment_date' => 'required',
            'discount' => 'required',
            'coupun_number' => 'required',
            'payment_type' => 'required|in:Cash,Debit,EDC,Kartu Kredit,Transfer',
            'status' => 'required|in:Paid,Unpaid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = Student::find($student_id);

        $payment = new Payment();
        $payment->center_id = $student->center_id;
        $payment->student_id = $student->id;
        $payment->payment_date = now()->format('Y-m-d H:i:s');
        $payment->discount = $request->discount;
        $payment->coupun_number = $request->coupun_number;
        $payment->payment_type = $request->payment_type;
        $payment->status = "Paid";
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
            'student_id' => 'required',
            'payment_date' => 'required',
            'discount' => 'required',
            'coupun_number' => 'required',
            'payment_type' => 'required|in:Cash,Debit,EDC,Kartu Kredit,Transfer',
            'status' => 'required|in:Paid,Unpaid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $payment = Payment::find($id);
        $payment->center_id = $request->center_id;
        $payment->student_id = $request->student_id;
        $payment->payment_date = $request->payment_date;
        $payment->discount = $request->discount;
        $payment->coupun_number = $request->coupun_number;
        $payment->payment_type = $request->payment_type;
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
