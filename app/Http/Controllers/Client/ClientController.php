<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Session;





class ClientController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = \App\Models\Category::all();

        return view('client.landingpage', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('client.product.show', [
            'product' => $product,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query || strlen($query) < 1) {
            return redirect()->route('landingpage');
        }

        $products = Product::where('name', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->with('category')
            ->paginate(12);

        return view('client.product.search', [
            'products' => $products,
            'query' => $query
        ]);
    }

    public function category($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $products = $category->products()->paginate(12);

        return view('client.product.category', [
            'category' => $category,
            'products' => $products
        ]);
    }
}
