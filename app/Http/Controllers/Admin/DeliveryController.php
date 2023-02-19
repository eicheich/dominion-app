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
        $deliveries = Delivery::all();
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

    public function updateStatus(Request $request, $id)
    {
        Order::where('id', $id)->update([
            'status' => $request->status
        ]);

        return redirect()->route('dashboard')->with('success', 'Delivery status updated');
    }

    public function search(Request $request)
    {
        if ($request->filter == 'all' && $request->search == '') {
            $deliveries = Delivery::whereHas('order', function ($query) {
                $query->where('status', 'Shipped')->orWhere('status', 'Delivered')->orWhere('status', 'Success');
            })->get();
        } else if ($request->search == '') {
            $deliveries = Delivery::whereHas('order', function ($query) use ($request) {
                $query->where('status', $request->filter);
            })->get();
        } else {
            $deliveries = Delivery::where('delivery_number', 'like', '%' . $request->search . '%')->get();
        }

        return view('admin.delivery.index', [
            'deliveries' => $deliveries
        ]);
    }
}
