<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cancellation;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Order;

class CancellController extends Controller
{
    //index
    public function index()
    {
        $cancellations = Cancellation::all();
        return view('admin.cancellation.index', compact('cancellations'));
    }

    public function cancel($id)
    {
        // to page cancel
        $order = Order::find($id);
        return view('client.transaction.cancel', compact('order'));
    }

    public function cancelOrder($id, Request $request)
    {
        Cancellation::create([
            'cancellation_number' => 'C' . time(),
            'order_id' => $id,
            'reason' => $request->reason,
        ]);

        return redirect()->route('history')->with('success', 'Order cancellation request sent');
    }
}