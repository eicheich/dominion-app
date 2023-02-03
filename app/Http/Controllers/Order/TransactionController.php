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
        return redirect()->route('history');
    }
        public function history()
    {
        $orders = Order::where('id', auth()->user()->id)->get();
        return view('client.transaction.history', compact('orders'));
    }

    public function detail($id)
    {
        //
        $order = Order::find($id);
        return view('client.transaction.detail', compact('order'));
    }

}