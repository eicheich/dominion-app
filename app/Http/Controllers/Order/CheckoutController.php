<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Cancellation;
use App\Helper\OrderHelper;
use App\Models\Category;
use App\Models\Delivery;
use App\Models\Transaction;

class CheckoutController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('transaction.checkout', compact('category'));
    }

    public function checkout(Request $request)
    {
        $category = Category::all();
        $order = Order::create([
            'id' => 100,
            'name' => auth()->user()->name,
            'address' => auth()->user()->address,
            'phone' => auth()->user()->phone,
            'order_number' => 'ORD' . time(),
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total' => $request->quantity * $request->price,
            'size' => $request->size,
            'status' => 'Pending',
        ]);
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => request('total'),
            ),
            'customer_details' => array(
                'first_name' => request('name'),
                'last_name' => ' ',
                'email' => request('email'),
                'phone' => request('phone'),
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        Product::where('id', $request->product_id)->decrement('stock', $request->quantity);
        Cart::where('id', $request->cart_id)->delete();
        return view('client.transaction.payment', compact('category', 'snapToken', 'order'));
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
        $delivery = Delivery::where('order_id', $id)->first();
        return view('client.transaction.detail', compact('order', 'delivery', ));
    }

    public function callback(Request $request)
    {
        $serverKey = 'SB-Mid-server-0LVu3nOeh5dgccOrGwVJ2Rp6';
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $data = Order::find($request->order_id);
                $data->update(['status' => 'Paid']);
            }
        }
    }
}
