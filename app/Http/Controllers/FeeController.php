<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Center;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::all();
        return view('fee.index', compact('fees'))->with('title', 'Data Biaya');
    }

    public function create()
    {
        $centers = Center::all();
        return view('fee.create', compact('centers'))->with('title', 'Tambah Biaya');
    }

    public function store(Request $request)
    {
        $request->validate([
            'center_id' => 'required|exists:centers,id',
            'academic_year' => 'required|string|max:9',
            'payment_type' => 'required|in:3 Bulan,6 Bulan,12 Bulan',
            'registration_fee' => 'required|string',
            'equipment_fee' => 'required|string',
            'course_fee' => 'required|string',
            'note' => 'nullable|string|max:255',
        ]);

        $fee = new Fee();
        $fee->center_id = $request->center_id;
        $fee->academic_year = $request->academic_year;
        $fee->payment_type = $request->payment_type;
        $fee->registration_fee = $this->sanitizeRupiah($request->registration_fee);
        $fee->equipment_fee = $this->sanitizeRupiah($request->equipment_fee);
        $fee->course_fee = $this->sanitizeRupiah($request->course_fee);
        $fee->note = $request->note;
        $fee->save();

        return redirect()->route('fee.index')->with('success', 'Data biaya berhasil ditambahkan.');
    }

    public function edit($fee_id)
    {
        $centers = Center::all();
        $fee = Fee::findOrFail($fee_id);

        return view('fee.edit', [
            'fee' => $fee,
            'centers' => $centers,
            'title' => 'Edit Data Cabang',
        ]);
    }

    public function update(Request $request, $fee_id)
    {
        $request->validate([
            'center_id' => 'required|exists:centers,id',
            'academic_year' => 'required|string|max:9',
            'payment_type' => 'required|in:3 Bulan,6 Bulan,12 Bulan',
            'registration_fee' => 'required|string',
            'equipment_fee' => 'required|string',
            'course_fee' => 'required|string',
            'note' => 'nullable|string|max:255',
        ]);

        $fee = Fee::findOrFail($fee_id);
        $fee->center_id = $request->center_id;
        $fee->academic_year = $request->academic_year;
        $fee->payment_type = $request->payment_type;
        $fee->registration_fee = $this->sanitizeRupiah($request->registration_fee);
        $fee->equipment_fee = $this->sanitizeRupiah($request->equipment_fee);
        $fee->course_fee = $this->sanitizeRupiah($request->course_fee);
        $fee->note = $request->note;
        $fee->save();

        return redirect()->route('fee.index')->with('success', 'Data biaya berhasil diperbarui.');
    }

    public function destroy($fee_id)
    {
        $fee = Fee::findOrFail($fee_id);
        $fee->delete();

        return redirect()->route('fee.index')->with('success', 'Data biaya berhasil dihapus');
    }

    private function sanitizeRupiah($value)
    {
        return (int) str_replace(['Rp.', ',', '.', ' '], '', $value);
    }
}
