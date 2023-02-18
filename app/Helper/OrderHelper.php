<?php

function getOrderStatusClass($status)
{
    switch ($status) {
        case 'Pending':
            return 'text-warning fw-bold';
        case 'Success':
            return 'text-success fw-bold';
        case 'Paid':
            return 'text-info fw-bold';
        default:
            return 'text-danger fw-bold';
    }
}

function getCancellationLink($order)
{
    $cancellation = App\Models\Cancellation::where('order_id', $order->id)->first();
    if ($order->status == 'Canceled') {
        return '
        <div class="alert alert-danger">
             <p>Order has been canceled</p>
        </div>';
    } elseif ($cancellation) {
        return '
        <div class="alert alert-danger">
             <p>Cancellation request has been sent</p>
        </div>';
    } else {
        if ($order->status == 'Pending') {
            return
                '<div class="group-cp">
                    <button class="btn-p">Pay</button>

                    <a href="' . route('orders.cancel', $order->id) . '" class="btn btn-light">Cancel</a>
                </div>';
        }
    }
    return '';
}
