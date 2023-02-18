<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cancellation;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Order;

class CancellController extends Controller
{
    //index
    public function index()
    {
        $cancellations = Cancellation::all();
        $category = Category::all();
        return view('admin.cancellation.index', compact('cancellations', 'category'));
    }

    public function cancel($id)
    {
        // to page cancel
        $order = Order::find($id);
        $category = Category::all();
        return view('client.transaction.cancel', compact('order', 'category'));
    }

    public function cancelOrder($id, Request $request)
    {
        Cancellation::create([
            'cancellation_number' => 'C' . time(),
            'order_id' => $id,
            'reason' => $request->reason,
            'status' => 'Pending'
        ]);

        return redirect()->route('history')->with('success', 'Order cancellation request sent');
    }

    public function approve($id, Request $request)
    {
        Order::where('id', $request->order_id)->update([
            'status' => 'Canceled'
        ]);
        Cancellation::where('id', $id)->update([
            'status' => 'Approved'
        ]);

        return redirect()->route('dashboard')->with('success', 'Order cancellation request approved');
    }

    public function reject($id)
    {
        Cancellation::where('id', $id)->delete();
        return redirect()->route('admin.index')->with('success', 'Order cancellation request rejected');
    }

    public function search(Request $request)
    {
        //  buat 3 kondisi, 1 jika filter = all maka tampilkan semua data, 2 jika search kosong maka data sesuai filter, 3 cari sesuai search
        if ($request->filter == 'all' && $request->search == '') {
            $cancellations = Cancellation::all();
        } else if ($request->search == '') {
            $cancellations = Cancellation::where('status', $request->filter)->get();
        } else {
            $cancellations = Cancellation::where('cancellation_number', 'like', '%' . $request->search . '%')->get();
        }

        return view('admin.cancellation.index', compact('cancellations'));

    }

}
