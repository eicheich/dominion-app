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
        $deliveries = Delivery::with('order')->paginate(10);
        return view('admin.delivery.index', [
            'deliveries' => $deliveries
        ]);
    }

    public function show($id)
    {
        $delivery = Delivery::with('order', 'order.user', 'order.product')->findOrFail($id);
        return view('admin.delivery.show', [
            'delivery' => $delivery
        ]);
    }

    public function edit($id)
    {
        $delivery = Delivery::find($id);
        return view('admin.delivery.edit', [
            'delivery' => $delivery
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $delivery = Delivery::findOrFail($id);
        $order = $delivery->order;

        // Update order status
        $order->update([
            'status' => $request->status
        ]);

        // Update delivery tracking if provided
        if ($request->has('tracking_number')) {
            $delivery->update([
                'tracking_number' => $request->tracking_number
            ]);
        }

        return redirect()->route('admin.deliveries.show', $id)->with('success', 'Delivery status updated successfully');
    }
}
