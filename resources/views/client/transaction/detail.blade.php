@extends('layouts.main')

@section('title', 'Order Details - Dominion Sports Store')

@section('content')
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('landingpage') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('history') }}" class="text-decoration-none">My Orders</a></li>
                <li class="breadcrumb-item active">Order #{{ $order->order_number }}</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h2 fw-bold mb-1">
                    <i class="bi bi-receipt me-2"></i>Order Details
                </h1>
                <p class="text-muted mb-0">Order #{{ $order->order_number }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('history') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Orders
                </a>
                @if ($order->status == 'pending')
                    <a href="{{ route('payment', $order->order_number) }}" class="btn btn-warning">
                        <i class="bi bi-credit-card me-2"></i>Pay Now
                    </a>
                @endif
            </div>
        </div>

        <!-- Order Status Timeline -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-4">
                    <i class="bi bi-clock-history me-2"></i>Order Status
                </h5>
                <div class="row">
                    <div class="col-12">
                        <div class="progress mb-3" style="height: 8px;">
                            @if ($order->status == 'pending')
                                <div class="progress-bar bg-warning" style="width: 20%"></div>
                            @elseif ($order->status == 'payment confirmed')
                                <div class="progress-bar bg-info" style="width: 40%"></div>
                            @elseif ($order->status == 'shipped')
                                <div class="progress-bar bg-warning" style="width: 70%"></div>
                            @elseif ($order->status == 'delivered' || $order->status == 'success')
                                <div class="progress-bar bg-success" style="width: 100%"></div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="text-center">
                                <div class="mb-2">
                                    @if ($order->status != 'pending')
                                        <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                    @else
                                        <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                    @endif
                                </div>
                                <small class="fw-bold">Order Placed</small>
                                <br><small class="text-muted">{{ $order->created_at->format('M d, Y H:i') }}</small>
                            </div>
                            <div class="text-center">
                                <div class="mb-2">
                                    @if (
                                        $order->status == 'payment confirmed' ||
                                            $order->status == 'shipped' ||
                                            $order->status == 'delivered' ||
                                            $order->status == 'success')
                                        <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                    @elseif ($order->status == 'pending')
                                        <i class="bi bi-clock text-warning fs-4"></i>
                                    @else
                                        <i class="bi bi-circle text-muted fs-4"></i>
                                    @endif
                                </div>
                                <small class="fw-bold">Payment</small>
                                <br><small class="text-muted">
                                    @if ($order->status == 'pending')
                                        Waiting for payment
                                    @elseif (
                                        $order->status == 'payment confirmed' ||
                                            $order->status == 'shipped' ||
                                            $order->status == 'delivered' ||
                                            $order->status == 'success')
                                        Payment confirmed
                                    @else
                                        Pending
                                    @endif
                                </small>
                            </div>
                            <div class="text-center">
                                <div class="mb-2">
                                    @if ($order->status == 'shipped' || $order->status == 'delivered' || $order->status == 'success')
                                        <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                    @else
                                        <i class="bi bi-circle text-muted fs-4"></i>
                                    @endif
                                </div>
                                <small class="fw-bold">Processing</small>
                                <br><small class="text-muted">
                                    @if ($order->status == 'shipped' || $order->status == 'delivered' || $order->status == 'success')
                                        Order processed
                                    @else
                                        Pending
                                    @endif
                                </small>
                            </div>
                            <div class="text-center">
                                <div class="mb-2">
                                    @if ($order->status == 'delivered' || $order->status == 'success')
                                        <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                    @else
                                        <i class="bi bi-circle text-muted fs-4"></i>
                                    @endif
                                </div>
                                <small class="fw-bold">Delivered</small>
                                <br><small class="text-muted">
                                    @if ($order->status == 'delivered' || $order->status == 'success')
                                        Order delivered
                                    @else
                                        Pending
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Status Badge -->
                <div class="text-center mt-4">
                    @if ($order->status == 'pending')
                        <span class="badge bg-warning text-dark px-4 py-2 fs-6">
                            <i class="bi bi-clock me-2"></i>Pending Payment
                        </span>
                    @elseif ($order->status == 'payment confirmed')
                        <span class="badge bg-info px-4 py-2 fs-6">
                            <i class="bi bi-credit-card me-2"></i>Payment Confirmed
                        </span>
                    @elseif ($order->status == 'shipped')
                        <span class="badge bg-warning px-4 py-2 fs-6">
                            <i class="bi bi-box-seam me-2"></i>Shipped
                        </span>
                    @elseif ($order->status == 'delivered')
                        <span class="badge bg-success px-4 py-2 fs-6">
                            <i class="bi bi-check-circle me-2"></i>Delivered
                        </span>
                    @elseif ($order->status == 'success')
                        <span class="badge bg-success px-4 py-2 fs-6">
                            <i class="bi bi-check-circle me-2"></i>Order Completed
                        </span>
                    @else
                        <span class="badge bg-secondary px-4 py-2 fs-6">
                            <i class="bi bi-info-circle me-2"></i>{{ ucfirst($order->status) }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Order Information -->
            <div class="col-lg-8 mb-4">
                <!-- Product Details -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-box me-2"></i>Product Details
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Product Image -->
                            <div class="col-md-3 mb-3 mb-md-0">
                                @if ($order->product->image)
                                    <img src="{{ asset('storage/images/products/' . $order->product->image) }}"
                                        alt="{{ $order->product->name }}" class="img-fluid rounded shadow-sm"
                                        style="height: 150px; width: 150px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded shadow-sm d-flex align-items-center justify-content-center"
                                        style="height: 150px; width: 150px;">
                                        <i class="bi bi-image text-muted fs-1"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="col-md-9">
                                <h4 class="fw-bold mb-2">{{ $order->product->name }}</h4>
                                <p class="text-muted mb-3">{{ $order->product->description }}</p>

                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-tag text-primary me-2"></i>
                                            <strong>Category:</strong>
                                            <span
                                                class="ms-2 badge bg-light text-dark">{{ $order->product->category->name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-rulers text-primary me-2"></i>
                                            <strong>Size:</strong>
                                            <span class="ms-2 badge bg-light text-dark">{{ $order->size ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-box text-primary me-2"></i>
                                            <strong>Quantity:</strong>
                                            <span class="ms-2 badge bg-light text-dark">{{ $order->quantity ?? 1 }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-currency-dollar text-primary me-2"></i>
                                            <strong>Unit Price:</strong>
                                            <span
                                                class="ms-2 text-success fw-bold">${{ number_format($order->price ?? $order->total) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delivery Information -->
                @if ($order->name || $order->phone || $order->address)
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-truck me-2"></i>Delivery Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if ($order->name)
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person text-primary me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Recipient Name</small>
                                                <strong>{{ $order->name }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($order->phone)
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-telephone text-primary me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Phone Number</small>
                                                <strong>{{ $order->phone }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($order->address)
                                    <div class="col-12 mb-3">
                                        <div class="d-flex align-items-start">
                                            <i class="bi bi-geo-alt text-primary me-2 mt-1"></i>
                                            <div>
                                                <small class="text-muted d-block">Delivery Address</small>
                                                <strong>{{ $order->address }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 sticky-top" style="top: 100px;">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-receipt me-2"></i>Order Summary
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Order Details -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Order Number:</span>
                                <strong>#{{ $order->order_number }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Order Date:</span>
                                <strong>{{ $order->created_at->format('M d, Y') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Order Time:</span>
                                <strong>{{ $order->created_at->format('H:i') }}</strong>
                            </div>
                        </div>

                        <hr>

                        <!-- Pricing -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>${{ number_format($order->total * 0.91) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tax (10%)</span>
                                <span>${{ number_format($order->total * 0.09) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping</span>
                                <span class="text-success">Free</span>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <strong class="h5">Total</strong>
                            <strong class="h5 text-primary">${{ number_format($order->total) }}</strong>
                        </div>

                        <!-- Actions -->
                        <div class="d-grid gap-2">
                            @if ($order->status == 'pending')
                                <a href="{{ route('payment', $order->order_number) }}" class="btn btn-warning btn-lg">
                                    <i class="bi bi-credit-card me-2"></i>Complete Payment
                                </a>
                                <button class="btn btn-outline-danger" onclick="cancelOrder()">
                                    <i class="bi bi-x-circle me-2"></i>Cancel Order
                                </button>
                            @elseif ($order->status == 'delivered')
                                <form action="{{ route('confirm.delivery', $order->id) }}" method="POST"
                                    class="w-100">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-lg w-100"
                                        onclick="return confirm('Confirm that you have received this order?');">
                                        <i class="bi bi-check-circle me-2"></i>Confirm Delivery
                                    </button>
                                </form>
                                <small class="text-muted text-center d-block">Click to confirm receipt of your
                                    order</small>
                            @elseif ($order->status == 'success')
                                <button class="btn btn-success btn-lg" disabled>
                                    <i class="bi bi-check-circle me-2"></i>Order Completed
                                </button>
                            @elseif ($order->status == 'payment confirmed' || $order->status == 'shipped')
                                <button class="btn btn-info btn-lg" disabled>
                                    <i class="bi bi-box-seam me-2"></i>
                                    @if ($order->status == 'payment confirmed')
                                        Processing
                                    @else
                                        In Transit
                                    @endif
                                </button>
                                <small class="text-muted text-center d-block">Your order is on the way!</small>
                            @endif

                            <button class="btn btn-outline-secondary" onclick="reorderItem({{ $order->product->id }})">
                                <i class="bi bi-arrow-repeat me-2"></i>Reorder This Item
                            </button>

                            <a href="{{ route('landingpage') }}" class="btn btn-outline-primary">
                                <i class="bi bi-shop me-2"></i>Continue Shopping
                            </a>
                        </div>

                        <!-- Customer Support -->
                        <div class="mt-4 pt-3 border-top text-center">
                            <small class="text-muted d-block mb-2">Need help with your order?</small>
                            <a href="#" class="btn btn-sm btn-outline-info">
                                <i class="bi bi-headset me-1"></i>Contact Support
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .card {
                border-radius: 15px;
            }

            .progress-bar {
                border-radius: 10px;
            }

            .sticky-top {
                transition: all 0.3s ease;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            function cancelOrder() {
                if (confirm('Are you sure you want to cancel this order? This action cannot be undone.')) {
                    // Implement cancel order functionality
                    alert('Cancel order functionality will be implemented soon.');
                }
            }

            function reorderItem(productId) {
                if (confirm('Add this product to your cart again?')) {
                    window.location.href = `/product/${productId}`;
                }
            }
        </script>
    @endpush
@endsection
