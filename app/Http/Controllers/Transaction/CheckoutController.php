<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Transaction;
use Faker\Provider\ar_EG\Payment;

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
        // insert
        Order::create([
            'name' => auth()->user()->name,
            'order_number' => 'ORD' . time(),
            'cart_id' => $request->cart_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total' => $request->quantity * $request->price,
            'size' => $request->size,
            'status' => 'pending',
        ]);
        return redirect()->route('history');
    }

    public function payment()
    {
        $order = Order::where('cart_id', auth()->user()->id)->first();

        return view('client.transaction.payment', compact('order'));
    }

    // pay
    public function pay(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        Transaction::create([
            'order_id' => $request->order_id,
            'transaction_number' => 'TRX' . time(),
            'total' => $request->total,
            'status' => 'success',
            'payment_by' => $request->payment_by,

        ]);

        Order::where('cart_id', auth()->user()->id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => 'payment confirmed',
        ]);

        // redirect ke halaman history
        return redirect()->route('history');
    }

    public function history()
    {
        // get data order
        $orders = Order::where('cart_id', auth()->user()->id)->get();
        return view('client.transaction.history', compact('orders'));
    }

    public function detail($id)
    {
        //
        $order = Order::find($id);
        return view('client.transaction.detail', compact('order'));
    }
}