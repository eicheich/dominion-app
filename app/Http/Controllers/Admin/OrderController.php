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
        //  buat 3 kondisi, 1 jika filter = all maka tampilkan semua data, 2 jika search kosong maka data sesuai filter, 3 cari sesuai search
        if ($request->filter == 'all' && $request->search == '') {
            $orders = Order::all();
        } elseif ($request->search == '') {
            $orders = Order::where('status', $request->filter)->get();
        } else {
            $orders = Order::where('status', $request->filter)
                ->where('order_number', 'like', '%' . $request->search . '%')
                ->get();
        }
        return view('admin.order.index', [
            'orders' => $orders
        ]);


    }
}
