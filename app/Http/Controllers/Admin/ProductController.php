<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function products()
    {
        // get all products
        $products = Product::all();

        return view('admin.products', [
            'products' => $products
        ]);
    }
    public function create()
    {
        // get all categories
        $categories = Category::all();

        return view('admin.create', [
            'categories' => $categories
        ]);
    }

    public function store (Request $request)
    {
        // validate lalu dapatkan image dan insert ke database
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required|image',
            'category_id' => 'required'
        ]);

        // dapatkan image
        $image = $request->file('image');
        // simpan image dengan hash
        $image = $image->hashName();
        // simpan image ke folder public/images
        $request->file('image')->storeAs('images/products', $image);



        // insert ke database
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $image,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('products')->with('success', 'Product created successfully');
    }

    public function edit ($id)
    {
        // dapatkan product berdasarkan id
        $product = Product::findOrFail($id);
        // dapatkan semua categories
        $categories = Category::all();

        return view('admin.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update (Request $request, $id)
    {
        // dapatkan product berdasarkan id
        $product = Product::findOrFail($id);

        // validate lalu dapatkan image dan update ke database
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'image',
            'category_id' => 'required'
        ]);

        // dapatkan image
        $image = $request->file('image');
        // jika image tidak kosong
        if ($image) {
            // simpan image dengan hash
            $image = $image->hashName();
            // simpan image ke folder public/images
            $request->file('image')->storeAs('images/products', $image);
        } else {
            // jika image kosong, maka gunakan image lama
            $image = $product->image;
        }

        // update ke database
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $image,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('products')->with('success', 'Product updated successfully');
    }

    public function destroy ($id)
    {
        // dapatkan product berdasarkan id
        $product = Product:: findOrFail($id);
        $product->delete();
        return redirect()->route('products')->with('success', 'Product deleted successfully');
    }
}