<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;
use App\Models\CenterPayment;
use Illuminate\Support\Facades\Validator;

class CenterPaymentController extends Controller
{
    public function index()
    {
        $centerPayments = CenterPayment::all();

        $data = [
            'centerPayments' => $centerPayments,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('centerPayment.index', $data);
    }

    public function detail()
    {
        $centerPayments = CenterPayment::all();

        $data = [
            'centerPayments' => $centerPayments,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('centerPayment.detail', $data);
    }

    public function create()
    {
        $centers = Center::all();

        $data = [
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('centerPayment.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required|unique:center_centerPayments,center_id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $centerPayment = new CenterPayment;
        $centerPayment->center_id = $request->center_id;
        $centerPayment->registration_fee_old = $request->registration_fee_old;
        $centerPayment->equipment_fee_old = $request->equipment_fee_old;
        $centerPayment->course_fee_old = $request->course_fee_old;
        $centerPayment->registration_fee_new = $request->registration_fee_new;
        $centerPayment->equipment_fee_new = $request->equipment_fee_new;
        $centerPayment->course_fee_new = $request->course_fee_new;
        $centerPayment->save();

        return redirect()->route('centerPayment.index')->with('success', 'Payment created successfully.');
    }

    public function edit($id)
    {
        $centerPayment = CenterPayment::find($id);
        $centers = Center::all();

        $data = [
            'centerPayment' => $centerPayment,
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('centerPayment.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'registration_fee_old' => 'required',
            'equipment_fee_old' => 'required',
            'course_fee_old' => 'required',
            'registration_fee_new' => 'required',
            'equipment_fee_new' => 'required',
            'course_fee_new' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $centerPayment = CenterPayment::find($id);
        $centerPayment->center_id = $request->center_id;
        $centerPayment->registration_fee_old = $request->registration_fee_old;
        $centerPayment->equipment_fee_old = $request->equipment_fee_old;
        $centerPayment->course_fee_old = $request->course_fee_old;
        $centerPayment->registration_fee_new = $request->registration_fee_new;
        $centerPayment->equipment_fee_new = $request->equipment_fee_new;
        $centerPayment->course_fee_new = $request->course_fee_new;
        $centerPayment->save();

        return redirect()->route('centerPayment.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $centerPayment = CenterPayment::find($id);

        $centerPayment->delete();

        return redirect()->route('centerPayment.index')->with('delete', 'Payment deleted successfully.');
    }
}
