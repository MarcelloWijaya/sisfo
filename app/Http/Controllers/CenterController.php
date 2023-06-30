<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Exports\CentersExport;
use App\Imports\CentersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CenterController extends Controller
{
    public function index()
    {
        $centers = Center::all();

        $data = [
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('center.index', $data);
    }

    public function detail()
    {
        $centers = Center::all();

        $data = [
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('center.detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('center.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'owner' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $center = new Center();
        $center->name = $request->input('name');
        $center->owner = $request->input('owner');
        $center->address = $request->input('address');
        $center->phone_number = $request->input('phone_number');
        $center->email = $request->input('email');
        $center->save();

        return redirect()->route('center.index')->with('success', 'Center created successfully.');
    }

    public function edit($id)
    {
        $center = Center::find($id);

        if (!$center) {
            return redirect()->route('center.index')->withErrors('Center not found.');
        }

        $data = [
            'center' => $center,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('center.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'owner' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $center = Center::find($id);

        if (!$center) {
            return redirect()->route('center.index')->withErrors('Center not found.');
        }

        $center->name = $request->input('name');
        $center->owner = $request->input('owner');
        $center->address = $request->input('address');
        $center->phone_number = $request->input('phone_number');
        $center->email = $request->input('email');
        $center->save();

        return redirect()->route('center.index')->with('success', 'Center updated successfully.');
    }

    public function destroy($id)
    {
        $center = Center::find($id);

        if (!$center) {
            return redirect()->route('center.index')->withErrors('Center not found.');
        }

        $center->delete();

        return redirect()->route('center.index')->with('delete', 'Center deleted successfully.');
    }

    public function exportCenter()
    {
        $centers = Center::all();

        $data = [];
        foreach ($centers as $center) {
            $data[] = [
                'Center Name' => $center->name,
                'Owner' => $center->owner,
                'Address' => $center->address,
                'Phone Number' => $center->phone_number,
                'Email' => $center->email,
            ];
        }

        return Excel::download(new CentersExport($data), 'centers.xlsx');
    }

    public function importCenter(Request $request)
    {
        $request->validate([
            'import_file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('import_file');

        Excel::import(new CentersImport, $file);

        return redirect()->route('center.index')->with('success', 'Data imported successfully.');
    }
}
