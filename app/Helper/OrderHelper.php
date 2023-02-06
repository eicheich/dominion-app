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
    $cancellation = App\Models\Cancellation::where('order_id', $order->id )->first();
    if ($order->status == 'canceled') {
        return '
        <div class="alert alert-danger">
             <p>Order has been canceled</p>
        </div>';
    }
    elseif ($cancellation ) {
        return '
        <div class="alert alert-danger">
             <p>Cancellation request has been sent</p>
        </div>';
    
    // jika status cancellationnya approved maka mucncul alert
    }
    else {
        if ($order->status == 'pending') {
            return '<a href="' . route('orders.cancel', $order->id) . '" class="btn btn-danger">Cancel</a>
            <form action="' . route('payment', $order->order_number) . '" method="GET">
                <button type="submit" class="btn btn-success">Pay</button>
            </form>';
        }
    }
    return '';
}
