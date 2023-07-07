<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\Student;
use Carbon\Carbon;
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

        $data = [
            'payments' => $payments,
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
            'student_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = Student::find($student_id);

        $payment = new Payment();
        $payment->student_id = $student->id;
        $payment->status_id = 2;
        $payment->save();

        return redirect()->route('payment.index')->with('success', 'Payment created successfully.');
    }

    public function paymentDetail(int $student_id)
    {
        $payments = Payment::where('student_id', $student_id)->get();
        $student = Student::find($student_id);
        $payment_types = PaymentType::all();

        $latestPayment = Payment::where('student_id', $student_id)
            ->whereNotNull('payment_date')
            ->orderBy('payment_date', 'desc')
            ->first();

        $currentMonth = Carbon::now()->format('m-Y');
        $displayMonth = $latestPayment && $latestPayment->payment_date >= $currentMonth
            ? Carbon::parse($latestPayment->payment_date)->addMonth()->format('m-Y')
            : $currentMonth;

        $data = [
            'payments' => $payments,
            'student' => $student,
            'payment_types' => $payment_types,
            'displayMonth' => $displayMonth,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('payment.student.detail', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'discount' => 'required',
            'coupon_number' => 'required',
            'payment_type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $payment = Payment::find($id);

        if ($payment->payment_date) {
            // Cek apakah sudah ada pembayaran untuk bulan sebelumnya
            $previousMonthPayment = Payment::where('student_id', $payment->student_id)
                ->where('payment_date', '<=', $payment->payment_date)
                ->orderBy('payment_date', 'desc')
                ->first();

            if ($previousMonthPayment) {
                // Jika sudah ada pembayaran untuk bulan sebelumnya, tambahkan 1 bulan ke payment_date
                $newPayment = new Payment();
                $newPayment->student_id = $payment->student_id;
                $newPayment->payment_date = Carbon::parse($previousMonthPayment->payment_date)->addMonth()->format('Y-m-d H:i:s');
                $newPayment->discount = $request->discount;
                $newPayment->coupon_number = $request->coupon_number;
                $newPayment->payment_type_id = $request->payment_type_id;
                $newPayment->status_id = 1;
                $newPayment->save();
            } else {
                // Jika belum ada pembayaran untuk bulan sebelumnya, perbarui data pembayaran yang ada
                $payment->discount = $request->discount;
                $payment->coupon_number = $request->coupon_number;
                $payment->payment_type_id = $request->payment_type_id;
                $payment->payment_date = now()->format('Y-m-d H:i:s');
                $payment->status_id = 1;
                $payment->save();
            }
        } else {
            // Jika belum ada data pembayaran, perbarui data pembayaran yang ada
            $payment->discount = $request->discount;
            $payment->coupon_number = $request->coupon_number;
            $payment->payment_type_id = $request->payment_type_id;
            $payment->payment_date = now()->format('Y-m-d H:i:s');
            $payment->status_id = 1;
            $payment->save();
        }

        return redirect()->route('payment.index')->with('success', 'Payment Success.');
    }

    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();

        return redirect()->route('payment.index')->with('delete', 'Payment deleted successfully.');
    }

    public function indexInvoice()
    {
        $payments = Payment::all();

        $data = [
            'payments' => $payments,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('payment.invoice', $data);
    }

    // public function createInvoice(Request $request)
    // {
    //     $invoice = Invoice::create([
    //         'invoice_number' => 'INV-' . uniqid(),
    //         'student_id' => $request->input('student_id'),
    //         'total' => $request->input('total_amount'),
    //     ]);

    //     // Mengaitkan invoice dengan pembayaran
    //     $payment = Payment::find($request->input('payment_id'));
    //     $payment->invoice_id = $invoice->id;
    //     $payment->save();

    //     return redirect()->back()->with('success', 'Invoice berhasil dibuat.');
    // }
}
