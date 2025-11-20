<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('transaction.checkout');
    }

    public function checkout(Request $request)
    {
        // Check if bulk checkout or single checkout
        if ($request->has('cart_ids')) {
            // Bulk checkout from cart
            $cartIds = $request->cart_ids;
            $quantities = $request->quantities;

            if (!is_array($cartIds)) {
                $cartIds = [$cartIds];
                $quantities = [$quantities];
            }

            $carts = Cart::whereIn('id', $cartIds)->get();

            if ($carts->count() !== count($cartIds)) {
                return redirect()->back()->with('error', 'Some cart items not found.');
            }

            foreach ($carts as $index => $cart) {
                $quantity = $quantities[$index] ?? $cart->quantity;

                Order::create([
                    'name' => auth()->user()->name,
                    'address' => auth()->user()->address,
                    'phone' => auth()->user()->phone,
                    'order_number' => 'ORD' . time() . '-' . $index,
                    'user_id' => auth()->user()->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $quantity,
                    'total' => $quantity * $cart->product->price,
                    'size' => $cart->size,
                    'status' => 'pending',
                ]);

                // Update product stock
                Product::where('id', $cart->product_id)->decrement('stock', $quantity);

                // Delete from cart
                $cart->delete();
            }

            return redirect()->route('history')->with('success', 'Checkout successful! Your orders have been created.');
        } else {
            // Single product checkout from product page
            $request->validate([
                'product_id' => 'required|integer|exists:products,id',
                'quantity' => 'required|integer|min:1',
                'size' => 'required|string',
                'price' => 'required|numeric',
            ]);

            Order::create([
                'name' => auth()->user()->name,
                'address' => auth()->user()->address,
                'phone' => auth()->user()->phone,
                'order_number' => 'ORD' . time(),
                'user_id' => auth()->user()->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'total' => $request->quantity * $request->price,
                'size' => $request->size,
                'status' => 'pending',
            ]);

            // Update product stock
            Product::where('id', $request->product_id)->decrement('stock', $request->quantity);

            // Delete from cart if exists
            if ($request->has('cart_id')) {
                Cart::where('id', $request->cart_id)->delete();
            }

            return redirect()->route('history')->with('success', 'Checkout successful!');
        }
    }
    public function history()
    {
        $orders = Order::where('cart_id', auth()->user()->id)->get();
        return view('client.transaction.history', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::find($id);
        return view('client.transaction.detail', compact('order'));
    }
}
