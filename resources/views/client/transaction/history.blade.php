@extends('layouts.main')

@section('title', 'My Orders - Dominion Sports Store')

@section('content')
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('landingpage') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active">My Orders</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 fw-bold">
                <i class="bi bi-clock-history me-2"></i>My Orders
            </h1>
            <div class="d-flex gap-2">
                <a href="{{ route('cart.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-cart3 me-2"></i>View Cart
                </a>
                <a href="{{ route('landingpage') }}" class="btn btn-primary">
                    <i class="bi bi-shop me-2"></i>Continue Shopping
                </a>
            </div>
        </div>

        @if ($orders->count() > 0)
            <!-- Orders Statistics -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card bg-primary text-white border-0">
                        <div class="card-body text-center">
                            <i class="bi bi-bag-check display-6 mb-2"></i>
                            <h3 class="h4 fw-bold">{{ $orders->count() }}</h3>
                            <p class="mb-0">Total Orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-warning text-white border-0">
                        <div class="card-body text-center">
                            <i class="bi bi-clock display-6 mb-2"></i>
                            <h3 class="h4 fw-bold">{{ $orders->where('status', 'pending')->count() }}</h3>
                            <p class="mb-0">Pending</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-success text-white border-0">
                        <div class="card-body text-center">
                            <i class="bi bi-check-circle display-6 mb-2"></i>
                            <h3 class="h4 fw-bold">
                                {{ $orders->whereIn('status', ['success', 'payment confirmed', 'shipped', 'delivered'])->count() }}
                            </h3>
                            <p class="mb-0">Completed</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-info text-white border-0">
                        <div class="card-body text-center">
                            <i class="bi bi-currency-dollar display-6 mb-2"></i>
                            <h3 class="h4 fw-bold">${{ number_format($orders->sum('total')) }}</h3>
                            <p class="mb-0">Total Spent</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Options -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-2 mb-md-0">Filter Orders</h6>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2 flex-wrap">
                                <button class="btn btn-sm btn-outline-secondary active" onclick="filterOrders('all')">
                                    All Orders
                                </button>
                                <button class="btn btn-sm btn-outline-warning" onclick="filterOrders('pending')">
                                    Pending
                                </button>
                                <button class="btn btn-sm btn-outline-success" onclick="filterOrders('completed')">
                                    Completed
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders List -->
            <div class="row">
                @foreach ($orders->sortByDesc('created_at') as $order)
                    <div class="col-12 mb-4 order-item" data-status="{{ $order->status }}">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-header bg-white py-3">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h6 class="fw-bold mb-1">
                                            <i class="bi bi-receipt me-2"></i>Order #{{ $order->order_number }}
                                        </h6>
                                        <small class="text-muted">
                                            <i
                                                class="bi bi-calendar me-1"></i>{{ $order->created_at->format('M d, Y \a\t H:i') }}
                                        </small>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        @if ($order->status == 'pending')
                                            <span class="badge bg-warning text-dark px-3 py-2">
                                                <i class="bi bi-clock me-1"></i>Pending Payment
                                            </span>
                                        @elseif ($order->status == 'payment confirmed')
                                            <span class="badge bg-info px-3 py-2">
                                                <i class="bi bi-credit-card me-1"></i>Payment Confirmed
                                            </span>
                                        @elseif ($order->status == 'shipped')
                                            <span class="badge bg-warning px-3 py-2">
                                                <i class="bi bi-box-seam me-1"></i>Shipped
                                            </span>
                                        @elseif ($order->status == 'delivered')
                                            <span class="badge bg-success px-3 py-2">
                                                <i class="bi bi-check-circle me-1"></i>Delivered
                                            </span>
                                        @elseif ($order->status == 'success')
                                            <span class="badge bg-success px-3 py-2">
                                                <i class="bi bi-check-circle me-1"></i>Completed
                                            </span>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2">
                                                <i class="bi bi-info-circle me-1"></i>{{ ucfirst($order->status) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <!-- Product Image -->
                                    <div class="col-md-2 col-3 mb-3 mb-md-0">
                                        @if ($order->product->image)
                                            <img src="{{ asset('storage/images/products/' . $order->product->image) }}"
                                                alt="{{ $order->product->name }}" class="img-fluid rounded shadow-sm"
                                                style="height: 80px; width: 80px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded shadow-sm d-flex align-items-center justify-content-center"
                                                style="height: 80px; width: 80px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Product Info -->
                                    <div class="col-md-4 col-9 mb-3 mb-md-0">
                                        <h6 class="fw-bold mb-1">{{ $order->product->name }}</h6>
                                        <p class="text-muted small mb-2">{{ Str::limit($order->product->description, 60) }}
                                        </p>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-light text-dark">
                                                <i class="bi bi-rulers me-1"></i>Size: {{ $order->size ?? 'N/A' }}
                                            </span>
                                            <span class="badge bg-light text-dark">
                                                <i class="bi bi-box me-1"></i>Qty: {{ $order->quantity }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Order Details -->
                                    <div class="col-md-3 col-6 mb-3 mb-md-0">
                                        <div class="text-center">
                                            <small class="text-muted d-block">Total Amount</small>
                                            <span
                                                class="fw-bold text-primary h5">${{ number_format($order->total) }}</span>

                                            @if ($order->name)
                                                <div class="mt-2">
                                                    <small class="text-muted d-block">Delivery to:</small>
                                                    <small class="fw-bold">{{ $order->name }}</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="col-md-3 col-6">
                                        <div class="d-grid gap-2">
                                            <a href="{{ route('detail', $order->id) }}"
                                                class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-eye me-1"></i>View Details
                                            </a>

                                            @if ($order->status == 'pending')
                                                <a href="{{ route('payment', $order->order_number) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-credit-card me-1"></i>Pay Now
                                                </a>
                                            @elseif ($order->status == 'success' || $order->status == 'payment confirmed')
                                                <button class="btn btn-success btn-sm" disabled>
                                                    <i class="bi bi-check-circle me-1"></i>Completed
                                                </button>
                                            @endif

                                            <button class="btn btn-outline-secondary btn-sm"
                                                onclick="reorderItem({{ $order->product->id }})">
                                                <i class="bi bi-arrow-repeat me-1"></i>Reorder
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty Orders -->
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 text-center py-5">
                        <div class="card-body">
                            <div class="mb-4">
                                <i class="bi bi-bag-x" style="font-size: 5rem; color: #e9ecef;"></i>
                            </div>
                            <h3 class="h4 fw-bold mb-3">No orders yet</h3>
                            <p class="text-muted mb-4">You haven't placed any orders yet. Start shopping to see your order
                                history here!</p>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ route('landingpage') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-shop me-2"></i>Start Shopping
                                </a>
                                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-lg">
                                    <i class="bi bi-cart3 me-2"></i>View Cart
                                </a>
                            </div>

                            <!-- Popular Categories -->
                            <div class="mt-4 pt-4 border-top">
                                <h6 class="fw-bold mb-3">Popular Categories</h6>
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <span class="badge bg-light text-dark px-3 py-2">Football</span>
                                    <span class="badge bg-light text-dark px-3 py-2">Basketball</span>
                                    <span class="badge bg-light text-dark px-3 py-2">Running</span>
                                    <span class="badge bg-light text-dark px-3 py-2">Fitness</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('styles')
        <style>
            .card {
                border-radius: 15px;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            }

            .order-item {
                transition: opacity 0.3s ease;
            }

            .order-item.hidden {
                display: none;
            }

            .badge {
                font-size: 0.875rem;
            }

            .btn-sm {
                font-size: 0.8rem;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Filter orders by status
            function filterOrders(status) {
                const orderItems = document.querySelectorAll('.order-item');
                const filterButtons = document.querySelectorAll('[onclick^="filterOrders"]');

                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                event.target.classList.add('active');

                // Filter orders
                orderItems.forEach(item => {
                    const orderStatus = item.dataset.status;

                    if (status === 'all') {
                        item.style.display = 'block';
                    } else if (status === 'pending' && orderStatus === 'pending') {
                        item.style.display = 'block';
                    } else if (status === 'completed' && (orderStatus === 'success' || orderStatus ===
                            'payment confirmed' || orderStatus === 'shipped' || orderStatus === 'delivered')) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            // Reorder functionality
            function reorderItem(productId) {
                if (confirm('Add this product to your cart again?')) {
                    window.location.href = `/product/${productId}`;
                }
            }

            // Auto-refresh for pending orders
            document.addEventListener('DOMContentLoaded', function() {
                const pendingOrders = document.querySelectorAll('[data-status="pending"]');

                if (pendingOrders.length > 0) {
                    // Refresh page every 2 minutes for pending orders
                    setTimeout(() => {
                        window.location.reload();
                    }, 120000);
                }
            });
        </script>
    @endpush
@endsection
