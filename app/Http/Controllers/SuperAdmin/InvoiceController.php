<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentEnrollment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    // ── List Invoices ───────────────────────────────────────────
    public function index(Request $request)
    {
        $user = Auth::user();
        $branchId = $user->hasRole('super_admin') || $user->hasRole('director') ? $request->get('branch_id') : $user->branch_id;

        $query = Invoice::with(['student', 'branch', 'payment'])
            ->when($branchId, fn($q) => $q->where('branch_id', $branchId))
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->when($request->filled('search'), fn($q) => $q->whereHas('student', fn($sq) => $sq->where('full_name', 'like', '%' . $request->search . '%'))->orWhere('invoice_number', 'like', '%' . $request->search . '%'))
            ->when($request->filled('month'), fn($q) => $q->whereMonth('due_date', Carbon::parse($request->month)->month)->whereYear('due_date', Carbon::parse($request->month)->year));

        $invoices = $query->latest()->paginate(20);

        $branches = Branch::where('status', 'active')->get();

        // Summary counts
        $summary = Invoice::when($branchId, fn($q) => $q->where('branch_id', $branchId))->selectRaw('status, COUNT(*) as count, SUM(amount) as total')->groupBy('status')->get()->keyBy('status');

        return view('invoices.index', compact('invoices', 'branches', 'summary', 'branchId'));
    }

    // ── Create Invoice Manually ─────────────────────────────────
    public function create()
    {
        $user = Auth::user();
        $branchId = $user->hasRole('super_admin') ? null : $user->branch_id;

        $branches = Branch::where('status', 'active')->get();
        $students = Student::when($branchId, fn($q) => $q->where('branch_id', $branchId))->where('status', 'active')->get();

        return view('invoices.create', compact('branches', 'students', 'branchId'));
    }

    // ── Store Invoice Manually ──────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'student_id' => 'required|exists:students,id',
            'enrollment_id' => 'required|exists:student_enrollments,id',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'billing_period_start' => 'required|date',
            'billing_period_end' => 'required|date|after_or_equal:billing_period_start',
            'notes' => 'nullable|string',
        ]);

        $branch = Branch::findOrFail($request->branch_id);
        $enrollment = StudentEnrollment::findOrFail($request->enrollment_id);

        Invoice::create([
            'invoice_number' => Invoice::generateNumber($branch),
            'branch_id' => $request->branch_id,
            'student_id' => $request->student_id,
            'enrollment_id' => $request->enrollment_id,
            'program_name' => $enrollment->program_name,
            'amount' => $request->amount,
            'billing_period_start' => $request->billing_period_start,
            'billing_period_end' => $request->billing_period_end,
            'due_date' => $request->due_date,
            'status' => 'unpaid',
            'notes' => $request->notes,
        ]);

        return redirect()->route('invoices.index')->with('success', 'Invoice berhasil dibuat.');
    }

    // ── Show Invoice Detail ─────────────────────────────────────
    public function show(Invoice $invoice)
    {
        $invoice->load(['student', 'branch', 'enrollment', 'payment.confirmedBy', 'coupon']);
        return view('invoices.show', compact('invoice'));
    }

    // ── Generate Invoice for Enrollment (AJAX) ──────────────────
    public function generateForEnrollment(Request $request)
    {
        $request->validate(['enrollment_id' => 'required|exists:student_enrollments,id']);

        $enrollment = StudentEnrollment::with(['student', 'branch'])->findOrFail($request->enrollment_id);
        $branch = $enrollment->branch;
        $months = $enrollment->next_invoice_date_months;

        $periodStart = $enrollment->next_invoice_date;
        $periodEnd = $periodStart->copy()->addMonths($months)->subDay();
        $dueDate = $periodStart->copy()->addDays(7); // due 7 hari setelah periode mulai

        $invoice = Invoice::create([
            'invoice_number' => Invoice::generateNumber($branch),
            'branch_id' => $enrollment->branch_id,
            'student_id' => $enrollment->student_id,
            'enrollment_id' => $enrollment->id,
            'program_name' => $enrollment->program_name,
            'amount' => $enrollment->fee_amount,
            'billing_period_start' => $periodStart,
            'billing_period_end' => $periodEnd,
            'due_date' => $dueDate,
            'status' => 'unpaid',
        ]);

        // Update next invoice date on enrollment
        $enrollment->update([
            'next_invoice_date' => $periodEnd->copy()->addDay(),
        ]);

        return redirect()
            ->route('invoices.show', $invoice)
            ->with('success', 'Invoice berhasil digenerate: ' . $invoice->invoice_number);
    }

    // ── Confirm Payment ─────────────────────────────────────────
    public function confirmPayment(Request $request, Invoice $invoice)
    {
        $request->validate([
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:cash,bank_transfer',
            'bank_name' => 'required_if:payment_method,bank_transfer',
            'reference_number' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $invoice) {
            // Create payment record
            $payment = Payment::create([
                'invoice_id' => $invoice->id,
                'branch_id' => $invoice->branch_id,
                'student_id' => $invoice->student_id,
                'amount_paid' => $request->amount_paid,
                'payment_date' => $request->payment_date,
                'payment_method' => $request->payment_method,
                'bank_name' => $request->bank_name,
                'reference_number' => $request->reference_number,
                'confirmed_by' => Auth::id(),
                'confirmed_at' => now(),
                'notes' => $request->notes,
            ]);

            // Update invoice status to paid
            $invoice->update(['status' => 'paid']);

            // Auto-generate coupon as payment receipt
            $branch = $invoice->branch;
            Coupon::create([
                'coupon_code' => Coupon::generateCode($branch),
                'invoice_id' => $invoice->id,
                'payment_id' => $payment->id,
                'student_id' => $invoice->student_id,
                'branch_id' => $invoice->branch_id,
                'student_name' => $invoice->student->full_name,
                'program_name' => $invoice->program_name,
                'amount_paid' => $payment->amount_paid,
                'payment_date' => $payment->payment_date,
                'billing_period' => $invoice->billing_period_start->format('d M Y') . ' - ' . $invoice->billing_period_end->format('d M Y'),
                'is_used' => true,
                'issued_at' => now(),
            ]);
        });

        return redirect()->route('invoices.show', $invoice)->with('success', 'Pembayaran dikonfirmasi. Kupon bukti bayar otomatis diterbitkan.');
    }

    // ── Get Enrollments by Student (AJAX) ───────────────────────
    public function getEnrollmentsByStudent(Request $request)
    {
        $enrollments = StudentEnrollment::where('student_id', $request->student_id)
            ->where('status', 'active')
            ->get(['id', 'program_name', 'fee_amount', 'billing_cycle']);

        return response()->json($enrollments);
    }
}
