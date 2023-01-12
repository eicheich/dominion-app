<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;





class ClientController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('client.landingpage', [
            'products' => $products
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        $cart = session()->get('cart');
        return view('client.product.show', [
            'product' => $product,
            'cart' => $cart
        ]);
    }
}