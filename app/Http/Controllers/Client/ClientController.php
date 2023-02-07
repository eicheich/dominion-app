<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
// use App\Models\Cart;

use Cart;
use App\Models\User;
use Illuminate\Support\Facades\Session;





class ClientController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $cart = Session::get('cart');

        return view('client.landingpage', [
            'products' => $products,
            'cart' => $cart,
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('client.product.show', [
            'product' => $product,
        ]);
    }
}
