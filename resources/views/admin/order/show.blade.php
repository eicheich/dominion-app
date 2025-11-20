@extends('layouts.mainAdmin')

@section('title', 'Order Details - Admin Dashboard')

@section('content')
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4 mb-0">
            <i class="bi bi-receipt me-2"></i>Order #{{ $order->order_number ?? $order->id }}
        </h1>
        <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-chevron-left me-1"></i>Back
        </a>
    </div>

    <div class="row">
        <!-- Order Details -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-light py-2">
                    <h6 class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>Order Information
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-bold">Order ID:</td>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Order Number:</td>
                            <td><span class="badge bg-primary">#{{ $order->order_number }}</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Date:</td>
                            <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Status:</td>
                            <td>
                                <span
                                    class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : 'info') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Total Amount:</td>
                            <td class="h6 text-success">${{ number_format($order->total, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Payment Method:</td>
                            <td>{{ $order->transaction->payment_by ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Payment Status:</td>
                            <td>
                                <span
                                    class="badge bg-{{ $order->transaction->status == 'success' ? 'success' : 'warning' }}">
                                    {{ ucfirst($order->transaction->status ?? 'Pending') }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Customer Details -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-light py-2">
                    <h6 class="mb-0">
                        <i class="bi bi-person-circle me-2"></i>Customer Information
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-bold">Name:</td>
                            <td>{{ $order->name ?? $order->user->name }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Email:</td>
                            <td>{{ $order->user->email }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Phone:</td>
                            <td>{{ $order->phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Address:</td>
                            <td>{{ $order->address ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details -->
    <div class="card shadow mb-4">
        <div class="card-header bg-light py-2">
            <h6 class="mb-0">
                <i class="bi bi-box-seam me-2"></i>Product Details
            </h6>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-2">
                    @if ($order->product->image)
                        <img src="{{ asset('storage/images/products/' . $order->product->image) }}"
                            alt="{{ $order->product->name }}" class="img-fluid rounded" style="max-width: 150px;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded"
                            style="width: 150px; height: 150px;">
                            <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3">{{ $order->product->name }}</h6>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="fw-bold" style="width: 40%;">Price:</td>
                            <td>${{ number_format($order->product->price, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Quantity:</td>
                            <td>{{ $order->quantity }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Subtotal:</td>
                            <td class="text-success fw-bold">${{ number_format($order->total, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    @if ($order->status == 'pending' || $order->status == 'confirmed')
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('orders.update.delivery', $order->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="status" value="shipped">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-truck me-2"></i>Mark as Shipped
                    </button>
                </form>
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Cancel
                </a>
            </div>
        </div>
    @endif
@endsection
