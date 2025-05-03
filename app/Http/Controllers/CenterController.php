<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use Illuminate\Support\Facades\Validator;

class CenterController extends Controller
{
    /**
     * Menampilkan daftar semua center
     */
    public function index()
    {
        $centers = Center::all();

        return view('center.index', [
            'centers' => $centers,
            'title' => 'Manajemen Cabang',
        ]);
    }

    /**
     * Menampilkan form untuk membuat center baru
     */
    public function create()
    {
        return view('center.create', [
            'title' => 'Tambah Cabang Baru',
        ]);
    }

    /**
     * Menyimpan center baru ke database
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:centers,email',
            'address' => 'required|string',
            'phone_number' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $center = new Center();
        $center->name = $request->name;
        $center->email = $request->email;
        $center->address = $request->address;
        $center->phone_number = $request->phone_number;
        $center->save();

        return redirect()->route('center.index')->with('success', 'Center created successfully.');
    }

    /**
     * Menampilkan detail center
     */
    public function detail($center_id)
    {
        $center = Center::findOrFail($center_id);

        return view('center.detail', [
            'center' => $center,
            'title' => 'Detail Cabang',
        ]);
    }

    /**
     * Menampilkan form untuk mengedit center
     */
    public function edit($center_id)
    {
        $center = Center::findOrFail($center_id);

        return view('center.edit', [
            'center' => $center,
            'title' => 'Edit Data Cabang',
        ]);
    }

    /**
     * Mengupdate data center di database
     */
    public function update(Request $request, $center_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:centers,email,' . $center_id,
            'address' => 'nullable|string',
            'phone_number' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $center = Center::findOrFail($center_id);
        $center->name = $request->name;
        $center->email = $request->email;
        $center->address = $request->address;
        $center->phone_number = $request->phone_number;
        $center->save();

        return redirect()->route('center.index')->with('success', 'Data cabang berhasil diperbarui');
    }

    /**
     * Menghapus center dari database
     */
    public function destroy($center_id)
    {
        $center = Center::findOrFail($center_id);
        $center->delete();

        return redirect()->route('center.index')->with('success', 'Cabang berhasil dihapus');
    }
}
