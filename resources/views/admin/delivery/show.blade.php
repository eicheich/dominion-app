@extends('layouts.mainAdmin')

@section('title', 'Delivery Details - Admin Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4 mb-0">
            <i class="bi bi-truck me-2"></i>Delivery Details
        </h1>
        <a href="{{ route('admin.deliveries') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Back
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Delivery Information -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-light py-3">
                    <h6 class="m-0">
                        <i class="bi bi-info-circle me-2"></i>Delivery Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">Delivery ID</label>
                        <p class="fw-bold">#{{ $delivery->id }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Status</label>
                        <div>
                            @if ($delivery->order->status == 'payment confirmed')
                                <span class="badge bg-info">Payment Confirmed</span>
                            @elseif ($delivery->order->status == 'shipped')
                                <span class="badge bg-warning">Shipped</span>
                            @elseif ($delivery->order->status == 'delivered')
                                <span class="badge bg-success">Delivered</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($delivery->order->status) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Created Date</label>
                        <p class="fw-bold">{{ $delivery->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Delivery Address</label>
                        <p class="fw-bold">{{ $delivery->delivery_address ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Tracking Number</label>
                        <p class="fw-bold">{{ $delivery->tracking_number ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Information -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-light py-3">
                    <h6 class="m-0">
                        <i class="bi bi-clipboard-data me-2"></i>Order Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">Order Number</label>
                        <p class="fw-bold">
                            <span class="badge bg-primary">#{{ $delivery->order->order_number }}</span>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Customer Name</label>
                        <p class="fw-bold">{{ $delivery->order->user->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Customer Email</label>
                        <p class="fw-bold">{{ $delivery->order->user->email }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Customer Phone</label>
                        <p class="fw-bold">{{ $delivery->order->user->phone ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Order Date</label>
                        <p class="fw-bold">{{ $delivery->order->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Total Amount</label>
                        <p class="fw-bold text-success">${{ number_format($delivery->order->total) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details -->
    <div class="card shadow mb-4">
        <div class="card-header bg-light py-3">
            <h6 class="m-0">
                <i class="bi bi-box-seam me-2"></i>Product Details
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 text-center mb-3">
                    @if ($delivery->order->product->image)
                        <img src="{{ asset('storage/images/products/' . $delivery->order->product->image) }}"
                            alt="{{ $delivery->order->product->name }}" class="img-fluid rounded"
                            style="max-width: 250px;">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                            style="width: 250px; height: 250px;">
                            <i class="bi bi-image text-muted fs-1"></i>
                        </div>
                    @endif
                </div>
                <div class="col-lg-8">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="text-muted small">Product Name</td>
                            <td class="fw-bold">{{ $delivery->order->product->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted small">Category</td>
                            <td class="fw-bold">{{ $delivery->order->product->category->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted small">Price</td>
                            <td class="fw-bold">${{ number_format($delivery->order->product->price) }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted small">Quantity</td>
                            <td class="fw-bold">{{ $delivery->order->quantity }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted small">Subtotal</td>
                            <td class="fw-bold text-success">
                                ${{ number_format($delivery->order->product->price * $delivery->order->quantity) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Update -->
    @if ($delivery->order->status != 'delivered')
        <div class="card shadow">
            <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0">
                    <i class="bi bi-pencil-square me-2"></i>Update Delivery Status
                </h6>
                <span class="badge bg-primary">Current:
                    @if ($delivery->order->status == 'payment confirmed')
                        Payment Confirmed
                    @else
                        {{ ucfirst($delivery->order->status) }}
                    @endif
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    @if ($delivery->order->status == 'payment confirmed')
                        <div class="col-md-6 mb-3">
                            <form action="{{ route('delivery.update.status', $delivery->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to mark this order as shipped?');">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="status" value="shipped">
                                <button type="submit" class="btn btn-warning w-100 btn-lg">
                                    <i class="bi bi-box-seam me-2"></i>Mark as Shipped
                                </button>
                            </form>
                            <small class="d-block mt-2 text-muted">This will update the order status to "Shipped"</small>
                        </div>
                    @elseif ($delivery->order->status == 'shipped')
                        <div class="col-md-6 mb-3">
                            <form action="{{ route('delivery.update.status', $delivery->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to mark this order as delivered?');">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="status" value="delivered">
                                <button type="submit" class="btn btn-success w-100 btn-lg">
                                    <i class="bi bi-check-circle me-2"></i>Mark as Delivered
                                </button>
                            </form>
                            <small class="d-block mt-2 text-muted">This will complete the delivery</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="card shadow bg-success bg-opacity-10 border-success">
            <div class="card-body text-center py-5">
                <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                <h5 class="mt-3 mb-0 text-success fw-bold">Delivery Completed</h5>
                <p class="mt-2 mb-0 text-muted">This order has been successfully delivered to the customer.</p>
            </div>
        </div>
    @endif
@endsection

@push('styles')
    <style>
        .card-header {
            border-bottom: 1px solid #e3e6f0;
        }

        .card {
            border: none;
            border-radius: 0.5rem;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.35rem 0.5rem;
        }

        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }
    </style>
@endpush
