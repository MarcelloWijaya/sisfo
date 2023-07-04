<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Item;
use App\Models\Transaction;
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
        $cart = Cart::where('user_id', session()->get('currUserSession')->id)->first();
        $items = Item::all();

        $data = [
            'cart' => $cart,
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
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'required|image|max:15000|mimes:jpeg,jpg,png',
        ]);

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

    public function addToCart(Request $request, int $item_id)
    {
        $cart = Cart::where('user_id', session()->get('currUserSession')->id)->first();

        $cart_item = CartItem::where('cart_id', $cart->id)->where('item_id', $item_id)->first();

        if ($cart_item) {
            return back()->with('delete', 'The Item is already in your cart.');
        }

        $item = Item::find($item_id);

        $cart_item = new CartItem();
        $cart_item->cart_id = $cart->id;
        $cart_item->item_id = $item->id;
        $cart_item->quantity = 1;
        $cart_item->total = $item->price;
        $cart_item->save();

        return redirect(route('item.list'))->with('success', 'Successfully add Item to cart.');
    }

    public function updateQuantity(Request $request, int $item_id)
    {
        if ($request->quantity < 1) {
            return back()->with('errorMessage', 'Invalid Product Quantity');
        }

        $cart = Cart::where('user_id', session()->get('currUserSession')->id)->first();

        $item = Item::find($item_id);

        $cart_item = CartItem::where('cart_id', $cart->id)->where('item_id', $item_id)->first();
        $cart_item->quantity = $request->quantity;
        $cart_item->total = $item->price * $request->quantity;
        $cart_item->save();

        return back()->with('success', 'Successfully update quantity Item');
    }

    public function removeFromCart(int $item_id)
    {

        $cart = Cart::where('user_id', session()->get('currUserSession')->id)->first();

        $cart_item = CartItem::where('cart_id', $cart->id)->where('item_id', $item_id)->first();
        $cart_item->delete();

        $item = Item::find($item_id);

        return back()->with('delete', 'Successfully remove Item from cart.');
    }

    public function checkout()
    {
        $cart = Cart::where('user_id', session()->get('currUserSession')->id)->first();

        foreach ($cart->cart_items as $cart_item) {
            $transaction = new Transaction();
            $transaction->check_out = date_create('now')->format('Y-m-d');
            $transaction->user_id = session()->get('currUserSession')->id;
            $transaction->item_id = $cart_item->item_id;
            $transaction->price = $cart_item->item->price;
            $transaction->quantity = $cart_item->quantity;
            $transaction->total = $cart_item->total;
            $transaction->save();

            $cart_item->delete();

            // Pindahkan pesan sukses ke dalam perulangan
            $successMessage = 'Successfully checked out cart at ' . $transaction->check_out . '.';
        }

        // Gunakan pesan sukses di akhir metode
        return back()->with('success', $successMessage);
    }
}
