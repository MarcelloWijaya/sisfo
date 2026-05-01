<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch; // Ganti Center dengan Branch
use App\Models\Payment;
use App\Models\Invoice; // Tambahkan model Invoice
use App\Models\Student;
use App\Models\Classes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        return $this->indexPayment();
    }

    /**
     * Display student list for payment selection
     */
    public function indexStudent()
    {
        $students = Student::with('branch')->get();

        $data = [
            'students' => $students,
            'title' => 'Payment - Student Selection',
        ];

        return view('payment.student.index', $data);
    }

    /**
     * Display all payments
     */
    public function indexPayment()
    {
        $payments = Payment::with(['invoice.student', 'invoice.branch'])->get();

        $data = [
            'payments' => $payments,
            'title' => 'Payment Management',
        ];

        return view('payment.index', $data);
    }

    /**
     * Display payment details for a student
     */
    public function detail($student_id)
    {
        $payments = Payment::whereHas('invoice', function ($query) use ($student_id) {
            $query->where('student_id', $student_id);
        })
            ->with('invoice')
            ->get();

        $student = Student::findOrFail($student_id);

        $data = [
            'payments' => $payments,
            'student' => $student,
            'title' => 'Payment Details',
        ];

        return view('payment.detail', $data);
    }

    /**
     * Show form to create payment
     */
    public function create()
    {
        $branches = Branch::where('is_active', 1)->get();
        $students = Student::where('is_active', 1)->get();

        $data = [
            'branches' => $branches,
            'students' => $students,
            'title' => 'Create New Payment',
        ];

        return view('payment.create', $data);
    }

    /**
     * Store payment from student selection
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'branch_id' => 'required|exists:branches,id',
            'total_amount' => 'required|numeric|min:0',
            'due_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create invoice first
        $invoice = new Invoice();
        $invoice->student_id = $request->student_id;
        $invoice->branch_id = $request->branch_id;
        $invoice->total_amount = $request->total_amount;
        $invoice->status = 'pending';
        $invoice->due_date = $request->due_date ?? Carbon::now()->addDays(30);
        $invoice->created_by = auth()->user()->name ?? 'system';
        $invoice->save();

        return redirect()
            ->route('payment.show', ['student_id' => $request->student_id])
            ->with('success', 'Invoice created successfully. Please add payment details.');
    }

    /**
     * Show payment form for specific student
     */
    public function paymentDetail($student_id)
    {
        $student = Student::with('branch', 'classes')->findOrFail($student_id);

        // Get invoices for this student
        $invoices = Invoice::where('student_id', $student_id)->with('payments')->orderBy('created_at', 'desc')->get();

        // Get latest payment
        $latestPayment = Payment::whereHas('invoice', function ($query) use ($student_id) {
            $query->where('student_id', $student_id);
        })
            ->latest()
            ->first();

        $currentMonth = Carbon::now()->format('F Y');

        // Calculate total paid and remaining
        $totalPaid = Payment::whereHas('invoice', function ($query) use ($student_id) {
            $query->where('student_id', $student_id);
        })->sum('amount');

        $totalInvoiced = Invoice::where('student_id', $student_id)->sum('total_amount');
        $remainingAmount = $totalInvoiced - $totalPaid;

        $data = [
            'student' => $student,
            'invoices' => $invoices,
            'latestPayment' => $latestPayment,
            'displayMonth' => $currentMonth,
            'total_paid' => $totalPaid,
            'total_invoiced' => $totalInvoiced,
            'remaining_amount' => $remainingAmount,
            'title' => 'Payment Details - ' . $student->name,
        ];

        return view('payment.student.detail', $data);
    }

    /**
     * Process payment update
     */
    public function update(Request $request, $invoice_id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1000',
            'payment_method' => 'required|string|max:50',
            'payment_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $invoice = Invoice::findOrFail($invoice_id);

        // Create payment record
        $payment = new Payment();
        $payment->invoice_id = $invoice->id;
        $payment->amount = $request->amount;
        $payment->payment_date = $request->payment_date;
        $payment->method = $request->payment_method;
        $payment->created_by = auth()->user()->name ?? 'system';
        $payment->save();

        // Update invoice status if fully paid
        $totalPaid = Payment::where('invoice_id', $invoice->id)->sum('amount');

        if ($totalPaid >= $invoice->total_amount) {
            $invoice->status = 'paid';
            $invoice->updated_by = auth()->user()->name ?? 'system';
            $invoice->save();
        } elseif ($totalPaid > 0) {
            $invoice->status = 'partial';
            $invoice->save();
        }

        return redirect()
            ->route('payment.detail', ['student_id' => $invoice->student_id])
            ->with('success', 'Payment recorded successfully.');
    }

    /**
     * Delete payment
     */
    public function destroy($payment_id)
    {
        $payment = Payment::findOrFail($payment_id);
        $invoice_id = $payment->invoice_id;
        $payment->delete();

        // Update invoice status after deletion
        $invoice = Invoice::find($invoice_id);
        if ($invoice) {
            $totalPaid = Payment::where('invoice_id', $invoice_id)->sum('amount');

            if ($totalPaid >= $invoice->total_amount) {
                $invoice->status = 'paid';
            } elseif ($totalPaid > 0) {
                $invoice->status = 'partial';
            } else {
                $invoice->status = 'pending';
            }
            $invoice->save();
        }

        return redirect()->back()->with('success', 'Payment deleted successfully.');
    }

    /**
     * Display invoices list
     */
    public function indexInvoice()
    {
        $invoices = Invoice::with(['student', 'branch', 'payments'])->get();

        $data = [
            'invoices' => $invoices,
            'title' => 'Invoice Management',
        ];

        return view('payment.invoice', $data);
    }

    /**
     * Display single invoice
     */
    public function showInvoice($invoice_id)
    {
        $invoice = Invoice::with(['student', 'branch', 'payments'])->findOrFail($invoice_id);

        $totalPaid = $invoice->payments->sum('amount');
        $remainingAmount = $invoice->total_amount - $totalPaid;

        return view('payment.invoice-detail', [
            'invoice' => $invoice,
            'total_paid' => $totalPaid,
            'remaining_amount' => $remainingAmount,
            'title' => 'Invoice #' . $invoice->id,
        ]);
    }

    /**
     * Process payment from invoice page
     */
    public function processPayment(Request $request, $invoice_id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1000',
            'payment_method' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $invoice = Invoice::findOrFail($invoice_id);

        $payment = new Payment();
        $payment->invoice_id = $invoice->id;
        $payment->amount = $request->amount;
        $payment->payment_date = Carbon::now();
        $payment->method = $request->payment_method;
        $payment->created_by = auth()->user()->name ?? 'system';
        $payment->save();

        // Update invoice status
        $totalPaid = Payment::where('invoice_id', $invoice->id)->sum('amount');

        if ($totalPaid >= $invoice->total_amount) {
            $invoice->status = 'paid';
        } else {
            $invoice->status = 'partial';
        }
        $invoice->save();

        return redirect()->route('payment.invoice.show', $invoice_id)->with('success', 'Payment processed successfully.');
    }

    /**
     * Generate invoice PDF
     */
    public function generateInvoicePDF($invoice_id)
    {
        $invoice = Invoice::with(['student', 'branch', 'payments'])->findOrFail($invoice_id);

        // You can use DomPDF or other package here
        // For now, return view for printing
        return view('payment.invoice-pdf', [
            'invoice' => $invoice,
            'title' => 'Invoice PDF',
        ]);
    }

    /**
     * Get payment history for a student (AJAX)
     */
    public function getPaymentHistory($student_id)
    {
        $payments = Payment::whereHas('invoice', function ($query) use ($student_id) {
            $query->where('student_id', $student_id);
        })
            ->with('invoice')
            ->orderBy('payment_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'payments' => $payments,
        ]);
    }
}
