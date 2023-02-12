<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Delivery;
use App\Models\Order;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->paginate(5);
        return view('admin.order.index', [
            'orders' => $orders
        ]);
    }
    public function show($id)
    {
        $order = Order::with('user')->find($id);
        return view('admin.order.show', [
            'order' => $order
        ]);
    }
    public function updateDelivery(Request $request, $id)
    {
        // checkjika di tabel deliveries sudah ada order_id yang sama maka tidak bisa update
        $delivery = Delivery::where('order_id', $id)->first();
        if ($delivery) {
            return redirect()->route('dashboard')->with('error', 'Order has been delivered');
        } else {
            Order::where('id', $id)->update([
                'status' => $request->status
            ]);
            Delivery::create([
                'order_id' => $id,
                'delivery_  number' => 'DV-' . time()
            ]);
            return redirect()->route('dashboard')->with('success', 'Order status updated');
        }
    }

    public function search(Request $request)
    {
        $orders = Order::where('order_number', 'like', '%' . $request->search . '%');
        return view('admin.order.index', [
            'orders' => $orders->paginate(5)
        ]);
    }
}
