<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Faker\Provider\ar_EG\Payment;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Category;


class TransactionController extends Controller
{
    public function payment()
    {
        $category = Category::all();
        $order = Order::where('order_number', request()->order_number)->first();
        return view('client.transaction.payment', compact('order', 'category'));
    }

    // pay
    public function pay(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);



        Order::where('id', $request->order_id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => 'Paid',
        ]);
        return redirect()->route('history');
    }
    public function history()
    {
        $category = Category::all();
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return view('client.transaction.history', compact('orders', 'category'));
    }

    public function detail($id)
    {

        $category = Category::all();
        $order = Order::find($id);
        return view('client.transaction.detail', compact('order', 'category'));
    }

    public function confirm($id)
    {
        Order::where('id', $id)->update([
            'status' => 'Success',
        ]);
        return redirect()->route('history')->with('success', 'Order confirmed');
    }
}
