<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Item;
use App\Models\ItemStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        $data = [
            'items' => $items,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('item.index', $data);
    }

    public function create()
    {
        $centers = Center::all();

        $data = [
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('item.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'entry_date' => 'required',
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'status_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = new Item;
        $item->center_id = $request->center_id;
        $item->entry_date = $request->entry_date;
        $item->name = $request->name;
        $item->category = $request->category;
        $item->brand = $request->brand;
        $item->status_id = $request->status_id;
        $item->save();

        return redirect()->route('item.index')->with('success', 'Item created successfully.');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        $centers = Center::all();
        $itemStatuses = ItemStatus::all();

        $data = [
            'item' => $item,
            'centers' => $centers,
            'itemStatuses' => $itemStatuses,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('item.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'entry_date' => 'required',
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
        ]);

        if (Auth::user()->center_id == null) {
            $validator->addRules(['status_id' => 'required']);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = Item::find($id);
        $item->center_id = $request->center_id;
        $item->entry_date = $request->entry_date;
        $item->name = $request->name;
        $item->category = $request->category;
        $item->brand = $request->brand;
        if (Auth::user()->center_id == null) {
            $item->status_id = $request->status_id;
        }

        $item->save();

        return redirect()->route('item.index')->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();

        return redirect()->route('item.index')->with('delete', 'Item deleted successfully.');
    }
}
