<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $category = Category::all();
        $cart = Session::get('cart');

        return view('client.landingpage', [
            'category' => $category,
            'products' => $products,
            'cart' => $cart,
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('client.product.show', [
            'product' => $product,
            'category' => $category,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $category = Category::all();
        $products = Product::where('name', 'like', "%" . $search . "%")->get();
        return view('client.landingpage', [
            'products' => $products,
            'search' => $search,
            'category' => $category,
        ]);
    }

    public function category($id)
    {
        $category = Category::all();
        $products = Product::where('category_id', $id)->get();
        return view('client.landingpage', [
            'products' => $products,
            'category' => $category,
        ]);
    }
}
