<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Faker\Provider\ar_EG\Payment;
use App\Models\Order;
use App\Models\Transaction;


class TransactionController extends Controller
{
    public function payment()
    {
        // cari order berdasarkan order number
        $order = Order::where('order_number', request()->order_number)->first();
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

        Order::where('id', $request->order_id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => 'payment confirmed',
        ]);
        return redirect()->route('history');
    }
    public function history()
    {
        $orders = Order::with(['product', 'product.category', 'user'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('client.transaction.history', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::with(['product', 'product.category', 'user'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('client.transaction.detail', compact('order'));
    }

    public function confirmDelivery($id)
    {
        $order = Order::with(['product', 'product.category', 'user'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        // Only allow confirmation if order is delivered
        if ($order->status !== 'delivered') {
            return redirect()->route('detail', $id)
                ->with('error', 'Order must be delivered before confirmation.');
        }

        // Update order status to success
        $order->update([
            'status' => 'success'
        ]);

        return redirect()->route('detail', $id)
            ->with('success', 'Order confirmed! Thank you for your purchase.');
    }
}
