<?php

function getOrderStatusClass($status)
{
    switch ($status) {
        case 'pending':
            return 'text-warning fw-bold';
        case 'success':
        case 'payment confirmed':
            return 'text-success fw-bold';
        default:
            return 'text-danger fw-bold';
    }
}
?>
