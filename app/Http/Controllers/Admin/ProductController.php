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
    public function products()
    {
        $products = Product::with('category')->paginate(2);
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

        $image = $request->file('image');
        $image = $image->hashName();
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
            $image = $image->hashName();
            $request->file('image')->storeAs('images/products', $image);
            Storage::disk('local')->delete($product->image);
        } else {
            $image = $product->image;
        }

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

    public function destroy($id)
{
  $data = Product::findOrFail($id);
  Storage::disk('local')->delete($data->image);
  $data->delete();

  return redirect()->route('products')->with('success', 'Data berhasil dihapus.');
}
}