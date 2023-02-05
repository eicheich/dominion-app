<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Order;

class DeliveryController extends Controller
{
    //
    public function index()
    {
        // get data delivery->order->status = shipped dan status = delivered
        $deliveries = Delivery::whereHas('order', function($query) {
            $query->where('status', 'shipped')->orWhere('status', 'delivered');
        })->get();

        return view('admin.delivery.index', [
            'deliveries' => $deliveries
        ]);


    }


    public function edit($id)
    {
        $delivery = Delivery::find($id);
        return view('admin.delivery.edit', [
            'delivery' => $delivery
        ]);
    }

    public function updateStatus(Request $request, $id) {
        Order::where('id', $id)->update([
            'status' => $request->status
        ]);

        return redirect()->route('dashboard')->with('success', 'Delivery status updated');
    }
}