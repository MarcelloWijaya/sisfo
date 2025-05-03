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
        $centers = Center::all(); // Untuk menampilkan data center
        return view('fee.create', compact('centers'))->with('title', 'Tambah Biaya');
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'center_id' => 'required|exists:centers,id',
            'academic_year' => 'required|string|max:9',
            'payment_type' => 'required|in:Monthly,Quarterly,Semester,Yearly',
            'registration_fee' => 'required|integer',
            'equipment_fee' => 'required|integer',
            'course_fee' => 'required|integer',
            'note' => 'nullable|string|max:255',
        ]);

        // Menyimpan fee baru dengan cara eksplisit
        $fee = new Fee();
        $fee->center_id = $request->center_id;
        $fee->academic_year = $request->academic_year;
        $fee->payment_type = $request->payment_type;
        $fee->registration_fee = $request->registration_fee;
        $fee->equipment_fee = $request->equipment_fee;
        $fee->course_fee = $request->course_fee;
        $fee->note = $request->note;
        $fee->save();

        return redirect()->route('fee.index')->with('success', 'Data fee berhasil ditambahkan.');
    }

    public function edit(Fee $fee)
    {
        $centers = Center::all();
        return view('fee.edit', compact('fee', 'centers'))->with('title', 'Edit Biaya');
    }

    public function update(Request $request, Fee $fee)
    {
        // Validasi request
        $request->validate([
            'center_id' => 'required|exists:centers,id',
            'academic_year' => 'required|string|max:9',
            'payment_type' => 'required|in:Monthly,Quarterly,Semester,Yearly',
            'registration_fee' => 'required|integer',
            'equipment_fee' => 'required|integer',
            'course_fee' => 'required|integer',
            'note' => 'nullable|string|max:255',
        ]);

        // Update fee dengan cara eksplisit
        $fee->center_id = $request->center_id;
        $fee->academic_year = $request->academic_year;
        $fee->payment_type = $request->payment_type;
        $fee->registration_fee = $request->registration_fee;
        $fee->equipment_fee = $request->equipment_fee;
        $fee->course_fee = $request->course_fee;
        $fee->note = $request->note;
        $fee->save();

        return redirect()->route('fee.index')->with('success', 'Data fee berhasil diperbarui.');
    }

    public function destroy(Fee $fee)
    {
        $fee->delete();
        return redirect()->route('fee.index')->with('success', 'Data fee berhasil dihapus.');
    }
}
