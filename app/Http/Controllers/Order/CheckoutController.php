<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Cancellation;
use App\Helper\OrderHelper;
use App\Models\Transaction;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('transaction.checkout');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer',
            'size' => 'required|string',
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

        // update product stock
        Product::where('id', $request->product_id)->decrement('stock', $request->quantity);

        Cart::where('id', $request->cart_id)->delete();

        return redirect()->route('history');
    }
    public function history()
    {

        $orders = Order::where('user_id', auth()->user()->id)->get();
        


        $cancellations = Cancellation::where('user_id', auth()->user()->id)->get();

        return view('client.transaction.history', compact('orders', 'cancellations'));
    }

    public function detail($id)
    {
        $order = Order::find($id);
        return view('client.transaction.detail', compact('order'));
    }
}
