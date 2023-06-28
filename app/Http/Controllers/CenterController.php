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
    public function indexCenter()
    {
        $centers = Center::all();

        $data = [
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('center.index', $data);
    }

    public function detailCenter()
    {
        $centers = Center::all();

        $data = [
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('center.detail', $data);
    }

    public function createCenter()
    {
        $data = [
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('center.create', $data);
    }

    public function storeCenter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'center_name' => 'required',
            'owner' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $center = new Center();
        $center->center_name = $request->input('center_name');
        $center->owner = $request->input('owner');
        $center->address = $request->input('address');
        $center->phone_number = $request->input('phone_number');
        $center->save();

        return redirect()->route('center.index')->with('success', 'Center created successfully.');
    }

    public function editCenter($id)
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

    public function updateCenter(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'center_name' => 'required',
            'owner' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email_center' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $center = Center::find($id);

        if (!$center) {
            return redirect()->route('center.index')->withErrors('Center not found.');
        }

        $center->center_name = $request->input('center_name');
        $center->owner = $request->input('owner');
        $center->address = $request->input('address');
        $center->phone_number = $request->input('phone_number');
        $center->email_center = $request->input('email_center');
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
                'Email' => $center->email_center,
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
