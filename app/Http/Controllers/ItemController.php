<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

    public function list()
    {
        $items = Item::all();

        $data = [
            'items' => $items,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('item.list', $data);
    }

    public function price()
    {
        $items = Item::all();

        $data = [
            'items' => $items,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('item.price', $data);
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
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'required|image|max:15000|mimes:jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('image');
        $title = preg_replace('/\s+/', '-', strtolower($request->name));
        $imageName = $title . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs('public/images/', $file, $imageName);

        $item = new Item;
        $item->center_id = ($request->center_id === '') ? null : $request->center_id;
        $item->name = $request->name;
        $item->quantity = $request->quantity;
        $item->price = $request->price;
        $item->image = $imageName;
        $item->save();

        return redirect()->route('item.index')->with('success', 'Item created successfully.');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        $centers = Center::all();

        $data = [
            'item' => $item,
            'centers' => $centers,
            'title' => 'Anaku Educare Management Information System (MIS)'
        ];

        return view('item.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => 'required',
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'required|image|max:15000|mimes:jpeg,jpg,png',
        ]);

        if (Auth::user()->center_id == null) {
            $validator->addRules(['status_id' => 'required']);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = Item::find($id);

        $file = $request->file('image');
        $title = preg_replace('/\s+/', '-', strtolower($request->name));
        $imageName = $title . '.' . $file->getClientOriginalExtension();
        Storage::delete('public/images/' . $item->image);
        Storage::putFileAs('public/images/', $file, $imageName);

        $item->center_id = ($request->center_id === '') ? null : $request->center_id;
        $item->name = $request->name;
        $item->quantity = $request->quantity;
        $item->price = $request->price;
        $item->image = $imageName;
        $item->save();

        return redirect()->route('item.index')->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $item = Item::find($id);

        Storage::delete('public/images/' . $item->image);
        $item->delete();

        return redirect()->route('item.index')->with('delete', 'Item deleted successfully.');
    }
}
