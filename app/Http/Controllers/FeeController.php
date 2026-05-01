<?php

namespace App\Http\Controllers;

use App\Models\BranchFee; // Ganti Fee dengan BranchFee
use App\Models\Branch; // Ganti Center dengan Branch
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeeController extends Controller
{
    /**
     * Display a listing of fees
     */
    public function index()
    {
        $fees = BranchFee::with('branch')->get(); // Eager loading relasi branch

        return view('fee.index', [
            'fees' => $fees,
            'title' => 'Data Biaya',
        ]);
    }

    /**
     * Show form to create new fee
     */
    public function create()
    {
        $branches = Branch::where('is_active', 1)->get(); // Ganti Center dengan Branch

        return view('fee.create', [
            'branches' => $branches,
            'title' => 'Tambah Biaya',
        ]);
    }

    /**
     * Store a new fee
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:branches,id', // Ganti center_id dengan branch_id
            'academic_year' => 'required|string|max:20',
            'payment_type' => 'required|integer', // payment_type adalah integer di database
            'registration_fee' => 'nullable|string',
            'equipment_fee' => 'nullable|string',
            'course_fee' => 'nullable|string',
            'notes' => 'nullable|string|max:255', // Ganti note dengan notes
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fee = new BranchFee(); // Ganti Fee dengan BranchFee
        $fee->branch_id = $request->branch_id; // Ganti center_id dengan branch_id
        $fee->academic_year = $request->academic_year;
        $fee->payment_type = $request->payment_type;
        $fee->registration_fee = $this->sanitizeRupiah($request->registration_fee);
        $fee->equipment_fee = $this->sanitizeRupiah($request->equipment_fee);
        $fee->course_fee = $this->sanitizeRupiah($request->course_fee);
        $fee->notes = $request->notes; // Ganti note dengan notes
        $fee->is_active = $request->is_active ?? 1;
        $fee->created_by = auth()->user()->name ?? 'system';
        $fee->save();

        return redirect()->route('fee.index')->with('success', 'Data biaya berhasil ditambahkan.');
    }

    /**
     * Show form to edit fee
     */
    public function edit($fee_id)
    {
        $branches = Branch::where('is_active', 1)->get(); // Ganti Center dengan Branch
        $fee = BranchFee::findOrFail($fee_id); // Ganti Fee dengan BranchFee

        return view('fee.edit', [
            'fee' => $fee,
            'branches' => $branches,
            'title' => 'Edit Data Biaya',
        ]);
    }

    /**
     * Update fee data
     */
    public function update(Request $request, $fee_id)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:branches,id', // Ganti center_id dengan branch_id
            'academic_year' => 'required|string|max:20',
            'payment_type' => 'required|integer',
            'registration_fee' => 'nullable|string',
            'equipment_fee' => 'nullable|string',
            'course_fee' => 'nullable|string',
            'notes' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fee = BranchFee::findOrFail($fee_id); // Ganti Fee dengan BranchFee
        $fee->branch_id = $request->branch_id;
        $fee->academic_year = $request->academic_year;
        $fee->payment_type = $request->payment_type;
        $fee->registration_fee = $this->sanitizeRupiah($request->registration_fee);
        $fee->equipment_fee = $this->sanitizeRupiah($request->equipment_fee);
        $fee->course_fee = $this->sanitizeRupiah($request->course_fee);
        $fee->notes = $request->notes;
        $fee->is_active = $request->is_active ?? 1;
        $fee->updated_by = auth()->user()->name ?? 'system';
        $fee->save();

        return redirect()->route('fee.index')->with('success', 'Data biaya berhasil diperbarui.');
    }

    /**
     * Delete fee
     */
    public function destroy($fee_id)
    {
        $fee = BranchFee::findOrFail($fee_id); // Ganti Fee dengan BranchFee
        $fee->delete();

        return redirect()->route('fee.index')->with('success', 'Data biaya berhasil dihapus');
    }

    /**
     * Sanitize rupiah format to integer
     * Example: "Rp 1.500.000" -> 1500000
     */
    private function sanitizeRupiah($value)
    {
        if (empty($value)) {
            return 0;
        }

        // Remove 'Rp', '.', ',', ' ', and other characters
        $cleaned = preg_replace('/[^0-9]/', '', $value);

        return (int) $cleaned;
    }

    /**
     * Format number to rupiah for display
     */
    private function formatRupiah($value)
    {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }
}
