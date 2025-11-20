<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
// use App\Http\Controllers\Admin\Storage;
// use Storage;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(2);
        return view('admin.product.products', [
            'products' => $products
        ]);
    }
    public function create()
    {
        // get all categories
        $categories = Category::all();
        return view('admin.product.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
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

        $image = $request->file('image');
        $imageName = $image->hashName();
        $request->file('image')->storeAs('images/products', $imageName, 'public');



        // insert ke database
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imageName,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('admin.product.show', [
            'product' => $product
        ]);
    }

    public function edit($id)
    {
        // dapatkan product berdasarkan id
        $product = Product::findOrFail($id);
        // dapatkan semua categories
        $categories = Category::all();

        return view('admin.product.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'image',
            'category_id' => 'required'
        ]);

        $image = $request->file('image');
        if ($image) {
            $imageName = $image->hashName();
            $request->file('image')->storeAs('images/products', $imageName, 'public');
            Storage::disk('public')->delete('images/products/' . $product->image);
        } else {
            $imageName = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imageName,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        Storage::disk('public')->delete('images/products/' . $data->image);
        $data->delete();

        return redirect()->route('products.index')->with('success', 'Data berhasil dihapus.');
    }
}
