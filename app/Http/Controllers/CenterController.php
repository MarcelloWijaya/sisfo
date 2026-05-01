<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch; // Ganti Center dengan Branch
use Illuminate\Support\Facades\Validator;

class CenterController extends Controller
{
    /**
     * Menampilkan daftar semua branch/center
     */
    public function index()
    {
        $centers = Branch::all(); // Ganti Center::all() dengan Branch::all()

        return view('center.index', [
            'centers' => $centers,
            'title' => 'Manajemen Cabang',
        ]);
    }

    /**
     * Menampilkan form untuk membuat branch baru
     */
    public function create()
    {
        return view('center.create', [
            'title' => 'Tambah Cabang Baru',
        ]);
    }

    /**
     * Menyimpan branch baru ke database
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'owner_name' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100|unique:branches,email', // Ganti centers dengan branches
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $center = new Branch(); // Ganti Center dengan Branch
        $center->name = $request->name;
        $center->owner_name = $request->owner_name;
        $center->email = $request->email;
        $center->phone = $request->phone; // Ganti phone_number dengan phone
        $center->address = $request->address;
        $center->is_active = $request->is_active ?? 1;
        $center->created_by = auth()->user()->name ?? 'system';
        $center->save();

        return redirect()->route('center.index')->with('success', 'Cabang berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail branch
     */
    public function detail($center_id)
    {
        $center = Branch::findOrFail($center_id); // Ganti Center dengan Branch

        return view('center.detail', [
            'center' => $center,
            'title' => 'Detail Cabang',
        ]);
    }

    /**
     * Menampilkan form untuk mengedit branch
     */
    public function edit($center_id)
    {
        $center = Branch::findOrFail($center_id); // Ganti Center dengan Branch

        return view('center.edit', [
            'center' => $center,
            'title' => 'Edit Data Cabang',
        ]);
    }

    /**
     * Mengupdate data branch di database
     */
    public function update(Request $request, $center_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'owner_name' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100|unique:branches,email,' . $center_id, // Ganti centers dengan branches
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $center = Branch::findOrFail($center_id); // Ganti Center dengan Branch
        $center->name = $request->name;
        $center->owner_name = $request->owner_name;
        $center->email = $request->email;
        $center->phone = $request->phone; // Ganti phone_number dengan phone
        $center->address = $request->address;
        $center->is_active = $request->is_active ?? 1;
        $center->updated_by = auth()->user()->name ?? 'system';
        $center->save();

        return redirect()->route('center.index')->with('success', 'Data cabang berhasil diperbarui');
    }

    /**
     * Menghapus branch dari database (soft delete)
     */
    public function destroy($center_id)
    {
        $center = Branch::findOrFail($center_id); // Ganti Center dengan Branch
        $center->delete(); // Soft delete karena pakai SoftDeletes

        return redirect()->route('center.index')->with('success', 'Cabang berhasil dihapus');
    }
}
