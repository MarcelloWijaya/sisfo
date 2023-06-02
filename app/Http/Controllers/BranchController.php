<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function indexCenter()
    {
        $centers = Branch::all();

        $data = [
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('branch.index', $data);
    }

    public function detailCenter()
    {
        $centers = Branch::all();

        $data = [
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('branch.detail', $data);
    }

    public function createCenter()
    {
        $data = [
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('branch.create', $data);
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

        $center = new Branch();
        $center->center_name = $request->input('center_name');
        $center->owner = $request->input('owner');
        $center->address = $request->input('address');
        $center->phone_number = $request->input('phone_number');
        $center->save();

        return redirect()->route('branch.index')->with('success', 'Center created successfully.');
    }

    public function editCenter($id)
    {
        $center = Branch::find($id);

        if (!$center) {
            return redirect()->route('branch.index')->withErrors('Center not found.');
        }

        $data = [
            'center' => $center,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('branch.edit', $data);
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

        $center = Branch::find($id);

        if (!$center) {
            return redirect()->route('branch.index')->withErrors('Center not found.');
        }

        $center->center_name = $request->input('center_name');
        $center->owner = $request->input('owner');
        $center->address = $request->input('address');
        $center->phone_number = $request->input('phone_number');
        $center->email_center = $request->input('email_center');
        $center->save();

        return redirect()->route('branch.index')->with('success', 'Center updated successfully.');
    }

    public function deleteCenter($id)
    {
        $center = Branch::find($id);

        if (!$center) {
            return redirect()->route('branch.index')->withErrors('Center not found.');
        }

        $center->delete();

        return redirect()->route('branch.index')->with('success', 'Center deleted successfully.');
    }
}
