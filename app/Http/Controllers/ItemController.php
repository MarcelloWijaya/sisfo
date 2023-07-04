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

    public function addToCart(Request $request, int $product_id)
    {
        $cart = Cart::where('user_id', session()->get('currUserSession')->id)->first();

        $cart_product = Cart_product::where('cart_id', $cart->id)->where('product_id', $product_id)->first();

        if ($cart_product) {
            return back()->with('errorMessage', 'The product is already in your cart.');
        }

        $product = Product::find($product_id);

        $cart_product = new Cart_product();
        $cart_product->cart_id = $cart->id;
        $cart_product->product_id = $product->id;
        $cart_product->quantity = 1;
        $cart_product->total = $product->price;
        $cart_product->save();

        return redirect(route('cart.index'))->with('message', 'Successfully add ' . $product->name . ' to cart.');
    }

    public function updateQuantity(Request $request, int $product_id)
    {
        if ($request->quantity < 1) {
            return back()->with('errorMessage', 'Invalid Product Quantity');
        }

        $cart = Cart::where('user_id', session()->get('currUserSession')->id)->first();

        $product = Product::find($product_id);

        $cart_product = Cart_product::where('cart_id', $cart->id)->where('product_id', $product_id)->first();
        $cart_product->quantity = $request->quantity;
        $cart_product->total = $product->price * $request->quantity;
        $cart_product->save();

        return back()->with('message', 'Successfully update quantity ' . $product->name . '.');
    }

    public function removeFromCart(int $product_id)
    {

        $cart = Cart::where('user_id', session()->get('currUserSession')->id)->first();

        $cart_product = Cart_product::where('cart_id', $cart->id)->where('product_id', $product_id)->first();
        $cart_product->delete();

        $product = Product::find($product_id);

        return back()->with('message', 'Successfully remove ' . $product->name . ' from cart.');
    }

    public function checkout()
    {

        $cart = Cart::where('user_id', session()->get('currUserSession')->id)->first();

        foreach ($cart->cart_products as $cart_product) {
            $transaction = new Transaction();
            $transaction->check_out = date_create('now')->format('Y-m-d');
            $transaction->user_id = session()->get('currUserSession')->id;
            $transaction->product_id = $cart_product->product_id;
            $transaction->price = $cart_product->product->price;
            $transaction->quantity = $cart_product->quantity;
            $transaction->total = $cart_product->total;
            $transaction->save();

            $cart_product->delete();
        }

        return back()->with('message', 'Successfully checkout cart at ' . $transaction->check_out . '.');
    }
}
