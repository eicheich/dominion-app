<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['product', 'product.category'])
            ->where('user_id', Auth::id())
            ->get();

        return view('client.product.cart', compact('carts'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'size' => 'required|string'
        ], [
            'product_id.required' => 'Product is required.',
            'product_id.exists' => 'Selected product does not exist.',
            'quantity.required' => 'Quantity is required.',
            'quantity.numeric' => 'Quantity must be a number.',
            'quantity.min' => 'Quantity must be at least 1.',
            'size.required' => 'Size selection is required.'
        ]);

        // Check if product exists and has sufficient stock
        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Insufficient stock available. Only ' . $product->stock . ' items left.');
        }

        // Check if item already exists in cart
        $existingCart = Cart::where('product_id', $request->product_id)
            ->where('user_id', Auth::id())
            ->where('size', $request->size)
            ->first();

        if ($existingCart) {
            // Check if adding quantity exceeds stock
            $newQuantity = $existingCart->quantity + $request->quantity;

            if ($newQuantity > $product->stock) {
                return redirect()->back()->with('error', 'Cannot add more items. Total would exceed available stock (' . $product->stock . ' items).');
            }

            $existingCart->update([
                'quantity' => $newQuantity
            ]);

            return redirect()->back()->with('success', 'Cart updated successfully! Added ' . $request->quantity . ' more items.');
        } else {
            // Create new cart item
            Cart::create([
                'product_id' => $request->product_id,
                'user_id' => Auth::id(),
                'quantity' => $request->quantity,
                'size' => $request->size
            ]);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
    }

    public function update(Request $request, Cart $cart)
    {
        // Authorization check
        if ($cart->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Validation
        $request->validate([
            'quantity' => 'required|numeric|min:1|max:' . $cart->product->stock
        ], [
            'quantity.required' => 'Quantity is required.',
            'quantity.numeric' => 'Quantity must be a number.',
            'quantity.min' => 'Quantity must be at least 1.',
            'quantity.max' => 'Quantity cannot exceed available stock (' . $cart->product->stock . ' items).'
        ]);

        $cart->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->back()->with('success', 'Cart quantity updated successfully!');
    }

    public function destroy(Cart $cart)
    {
        // Authorization check
        if ($cart->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $productName = $cart->product->name;
        $cart->delete();

        return redirect()->back()->with('success', $productName . ' removed from cart successfully!');
    }

    public function clear()
    {
        $deletedCount = Cart::where('user_id', Auth::id())->count();
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->back()->with('success', 'Cart cleared successfully! Removed ' . $deletedCount . ' items.');
    }

    public function getCartCount()
    {
        $count = Cart::where('user_id', Auth::id())->sum('quantity');
        return response()->json(['count' => $count]);
    }

    public function getCartTotal()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();

        $subtotal = 0;
        $itemsCount = 0;

        foreach ($carts as $cart) {
            $subtotal += $cart->product->price * $cart->quantity;
            $itemsCount += $cart->quantity;
        }

        $tax = $subtotal * 0.1; // 10% tax
        $total = $subtotal + $tax;

        return response()->json([
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'items_count' => $itemsCount
        ]);
    }
}
