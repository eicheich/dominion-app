<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

use function Termwind\render;

class CartController extends Controller
{

    public function index()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        return view('client.product.cart', compact('carts'));
    }

    public function store(Product $product)
    {
        // $cart = product id
        $cart = Cart::where('product_id', request()->product_id)->where('user_id', auth()->user()->id)->first();
        // validate
        $this->validate(request(), [
            'quantity' => 'required|numeric',
            'size' => 'required'
        ]);

        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + request()->quantity
            ]);
            Session::flash('success', 'Cart updated successfully');
            return redirect()->back();
        } else {
            Cart::create([
                // request product_id
                'product_id' => request()->product_id,
                'user_id' => auth()->user()->id,
                'quantity' => request()->quantity,
                'size' => request()->size
            ]);
            Session::flash('success', 'Cart added successfully');
            return redirect()->back();
        }
    }

    public function update(Cart $cart)
    {
        $cart->update([
            'quantity' => request()->quantity
        ]);
        Session::flash('success', 'Cart updated successfully');
        return redirect()->back();
    }

}