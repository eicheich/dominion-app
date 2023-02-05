<?php

function getOrderStatusClass($status)
{
    switch ($status) {
        case 'pending':
            return 'text-warning fw-bold';
        case 'success':
            return 'text-success fw-bold';
        case 'payment confirmed':
            return 'text-info fw-bold';
        default:
            return 'text-danger fw-bold';
    }
}

function getCancellationLink($order)
{
    $cancellation = App\Models\Cancellation::where('order_id', $order->id)->first();
    if ($cancellation) {
        return '
        <div class="alert alert-danger">
             <p>Cancellation request has been sent</p>
        </div>';
    } else {
        if ($order->status == 'pending') {
            return '<a href="' . route('orders.cancel', $order->id) . '" class="btn btn-danger">Cancel</a>';
        }
    }
    return '';
}
