@extends('layouts.main')

@section('title', 'Shopping Cart - Dominion Sports Store')

@section('content')
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('landingpage') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active">Shopping Cart</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 fw-bold">
                <i class="bi bi-cart3 me-2"></i>Your Shopping Cart
            </h1>
            <a href="{{ route('landingpage') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-2"></i>Continue Shopping
            </a>
        </div>

        @if ($carts->count() > 0)
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-bag-check me-2"></i>Cart Items ({{ $carts->count() }})
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            @foreach ($carts as $cart)
                                <div class="cart-item border-bottom p-3 {{ $loop->last ? 'border-0' : '' }}">
                                    <!-- Desktop Layout -->
                                    <div class="row align-items-center g-2 d-none d-md-flex">
                                        <!-- Product Image -->
                                        <div class="col-md" style="flex: 0 0 auto; width: 90px;">
                                            @if ($cart->product->image)
                                                <img src="{{ asset('storage/images/products/' . $cart->product->image) }}"
                                                    alt="{{ $cart->product->name }}" class="img-fluid rounded"
                                                    style="height: 80px; width: 80px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                    style="height: 80px; width: 80px;">
                                                    <i class="bi bi-image text-muted" style="font-size: 1.5rem;"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Info -->
                                        <div class="col">
                                            <h6 class="fw-bold mb-1" style="font-size: 0.95rem;">{{ $cart->product->name }}
                                            </h6>
                                            <p class="text-muted small mb-2" style="font-size: 0.8rem;">
                                                {{ Str::limit($cart->product->description, 35) }}</p>
                                            <div class="d-flex gap-2" style="flex-wrap: wrap;">
                                                <span class="badge bg-light text-dark" style="font-size: 0.75rem;">
                                                    Size: {{ $cart->size }}
                                                </span>
                                                <span class="badge bg-light text-dark" style="font-size: 0.75rem;">
                                                    {{ $cart->product->category->name ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Price -->
                                        <div class="col-md" style="flex: 0 0 auto; width: 90px; text-align: center;">
                                            <small class="d-block text-muted mb-1" style="font-size: 0.75rem;">Price</small>
                                            <span class="fw-bold text-primary"
                                                style="font-size: 0.9rem;">${{ number_format($cart->product->price) }}</span>
                                        </div>

                                        <!-- Quantity -->
                                        <div class="col-md" style="flex: 0 0 auto; width: 100px;">
                                            <small class="d-block text-muted mb-1 text-center"
                                                style="font-size: 0.75rem;">Qty</small>
                                            <form action="{{ route('cart.update', $cart->id) }}" method="POST"
                                                class="quantity-form">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-group input-group-sm">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                                        onclick="decrementQuantity({{ $cart->id }})"
                                                        style="padding: 0.25rem 0.4rem;">
                                                        <i class="bi bi-dash"></i>
                                                    </button>
                                                    <input type="number" name="quantity" value="{{ $cart->quantity }}"
                                                        class="form-control text-center form-control-sm" min="1"
                                                        style="font-size: 0.85rem; padding: 0.25rem;"
                                                        max="{{ $cart->product->stock }}"
                                                        id="quantity-{{ $cart->id }}"
                                                        onchange="updateQuantity({{ $cart->id }})">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                                        onclick="incrementQuantity({{ $cart->id }})"
                                                        style="padding: 0.25rem 0.4rem;">
                                                        <i class="bi bi-plus"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- Total -->
                                        <div class="col-md" style="flex: 0 0 auto; width: 90px; text-align: center;">
                                            <small class="d-block text-muted mb-1" style="font-size: 0.75rem;">Total</small>
                                            <span class="fw-bold text-success"
                                                style="font-size: 0.9rem;">${{ number_format($cart->product->price * $cart->quantity) }}</span>
                                        </div>

                                        <!-- Checkout Button -->
                                        <div class="col-md" style="flex: 0 0 auto; width: 50px;">
                                            <form action="{{ route('checkout') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                                <input type="hidden" name="product_id" value="{{ $cart->product->id }}">
                                                <input type="hidden" name="quantity" value="{{ $cart->quantity }}">
                                                <input type="hidden" name="price" value="{{ $cart->product->price }}">
                                                <input type="hidden" name="total"
                                                    value="{{ $cart->product->price * $cart->quantity }}">
                                                <input type="hidden" name="size" value="{{ $cart->size }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <button type="submit" class="btn btn-success btn-sm w-100"
                                                    style="padding: 0.4rem;">
                                                    <i class="bi bi-credit-card"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Remove Button -->
                                        <div class="col-md" style="flex: 0 0 auto; width: 50px;">
                                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm w-100"
                                                    style="padding: 0.4rem;"
                                                    onclick="return confirm('Remove this item?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Mobile Layout -->
                                    <div class="d-md-none">
                                        <div class="d-flex gap-3 mb-3">
                                            @if ($cart->product->image)
                                                <img src="{{ asset('storage/images/products/' . $cart->product->image) }}"
                                                    alt="{{ $cart->product->name }}" class="img-fluid rounded"
                                                    style="height: 100px; width: 100px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                    style="height: 100px; width: 100px;">
                                                    <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="fw-bold mb-2">{{ $cart->product->name }}</h6>
                                                <p class="text-muted small mb-2">
                                                    {{ Str::limit($cart->product->description, 30) }}</p>
                                                <div class="d-flex gap-2 flex-wrap">
                                                    <span class="badge bg-light text-dark small">
                                                        Size: {{ $cart->size }}
                                                    </span>
                                                    <span class="badge bg-light text-dark small">
                                                        {{ $cart->product->category->name ?? 'N/A' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-2 mb-3">
                                            <div class="col-4 text-center">
                                                <small class="d-block text-muted mb-1">Price</small>
                                                <span
                                                    class="fw-bold text-primary small">${{ number_format($cart->product->price) }}</span>
                                            </div>
                                            <div class="col-4 text-center">
                                                <small class="d-block text-muted mb-1">Qty</small>
                                                <form action="{{ route('cart.update', $cart->id) }}" method="POST"
                                                    class="quantity-form d-inline-block">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="input-group input-group-sm" style="width: 75px;">
                                                        <button class="btn btn-outline-secondary btn-sm" type="button"
                                                            onclick="decrementQuantity({{ $cart->id }})">
                                                            −
                                                        </button>
                                                        <input type="number" name="quantity"
                                                            value="{{ $cart->quantity }}"
                                                            class="form-control text-center form-control-sm"
                                                            min="1" max="{{ $cart->product->stock }}"
                                                            id="quantity-{{ $cart->id }}"
                                                            onchange="updateQuantity({{ $cart->id }})">
                                                        <button class="btn btn-outline-secondary btn-sm" type="button"
                                                            onclick="incrementQuantity({{ $cart->id }})">
                                                            +
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-4 text-center">
                                                <small class="d-block text-muted mb-1">Total</small>
                                                <span
                                                    class="fw-bold text-success small">${{ number_format($cart->product->price * $cart->quantity) }}</span>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <form action="{{ route('checkout') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                                <input type="hidden" name="product_id"
                                                    value="{{ $cart->product->id }}">
                                                <input type="hidden" name="quantity" value="{{ $cart->quantity }}">
                                                <input type="hidden" name="price"
                                                    value="{{ $cart->product->price }}">
                                                <input type="hidden" name="total"
                                                    value="{{ $cart->product->price * $cart->quantity }}">
                                                <input type="hidden" name="size" value="{{ $cart->size }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="bi bi-credit-card me-1"></i>Checkout
                                                </button>
                                            </form>
                                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Remove this item?')">
                                                    <i class="bi bi-trash me-1"></i>Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 sticky-top" style="top: 100px;">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-calculator me-2"></i>Order Summary
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Summary Items -->
                            <div class="d-flex justify-content-between mb-2">
                                <span>Items ({{ $carts->sum('quantity') }})</span>
                                <span>${{ number_format($carts->sum(function ($cart) {return $cart->product->price * $cart->quantity;})) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping</span>
                                <span class="text-success">Free</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tax</span>
                                <span>${{ number_format($carts->sum(function ($cart) {return $cart->product->price * $cart->quantity;}) * 0.1) }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Total</strong>
                                <strong
                                    class="text-primary h5">${{ number_format($carts->sum(function ($cart) {return $cart->product->price * $cart->quantity;}) * 1.1) }}</strong>
                            </div>

                            <!-- Bulk Actions -->
                            <div class="d-grid gap-2">
                                <form action="{{ route('checkout') }}" method="POST" id="checkoutAllForm">
                                    @csrf
                                    <div id="checkoutItemsContainer"></div>
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="bi bi-credit-card me-2"></i>Checkout All Items
                                    </button>
                                </form>

                                <form action="{{ route('cart.clear') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger w-100"
                                        onclick="return confirm('Are you sure you want to clear your entire cart?')">
                                        <i class="bi bi-trash me-2"></i>Clear Cart
                                    </button>
                                </form>
                            </div>

                            <!-- Trust Badges -->
                            <div class="mt-4 pt-3 border-top">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <i class="bi bi-shield-check text-success fs-4"></i>
                                        <p class="small text-muted mb-0">Secure</p>
                                    </div>
                                    <div class="col-4">
                                        <i class="bi bi-truck text-primary fs-4"></i>
                                        <p class="small text-muted mb-0">Fast Delivery</p>
                                    </div>
                                    <div class="col-4">
                                        <i class="bi bi-arrow-clockwise text-info fs-4"></i>
                                        <p class="small text-muted mb-0">Easy Returns</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 text-center py-5">
                        <div class="card-body">
                            <div class="mb-4">
                                <i class="bi bi-cart-x" style="font-size: 5rem; color: #e9ecef;"></i>
                            </div>
                            <h3 class="h4 fw-bold mb-3">Your cart is empty</h3>
                            <p class="text-muted mb-4">Looks like you haven't added any items to your cart yet. Start
                                shopping to discover amazing sports products!</p>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ route('landingpage') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-shop me-2"></i>Start Shopping
                                </a>
                                @auth
                                    <a href="{{ route('history') }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="bi bi-clock-history me-2"></i>View Order History
                                    </a>
                                @endauth
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
            .cart-item {
                transition: background-color 0.2s ease;
            }

            .cart-item:hover {
                background-color: #f8f9fa;
            }

            .quantity-form .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
            }

            .sticky-top {
                transition: all 0.3s ease;
            }

            .card {
                border-radius: 15px;
            }

            .input-group-sm .btn {
                padding: 0.25rem 0.5rem;
            }

            /* Prevent row wrapping */
            .row {
                flex-wrap: nowrap;
                overflow-x: auto;
            }

            /* Better responsive behavior */
            @media (max-width: 768px) {
                .cart-item {
                    padding: 1rem !important;
                }

                .badge {
                    font-size: 0.75rem;
                }

                .btn-sm {
                    padding: 0.4rem 0.8rem;
                    font-size: 0.875rem;
                }

                .row {
                    flex-wrap: wrap;
                    overflow-x: visible;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Quantity management functions
            function incrementQuantity(cartId) {
                const input = document.getElementById('quantity-' + cartId);
                const max = parseInt(input.getAttribute('max'));
                const current = parseInt(input.value);

                if (current < max) {
                    input.value = current + 1;
                    updateQuantity(cartId);
                }
            }

            function decrementQuantity(cartId) {
                const input = document.getElementById('quantity-' + cartId);
                const current = parseInt(input.value);

                if (current > 1) {
                    input.value = current - 1;
                    updateQuantity(cartId);
                }
            }

            function updateQuantity(cartId) {
                const form = document.querySelector('#quantity-' + cartId).closest('form');

                // Auto-submit form after a small delay
                setTimeout(() => {
                    form.submit();
                }, 1000);
            }

            // Populate checkout form with all cart items
            function populateCheckoutForm() {
                const container = document.getElementById('checkoutItemsContainer');
                const cartItems = document.querySelectorAll('.cart-item');

                container.innerHTML = '';

                cartItems.forEach((item, index) => {
                    const quantityInput = item.querySelector('input[name="quantity"]');
                    const cartId = quantityInput.id.split('-')[1];
                    const quantity = quantityInput.value;
                    const productId = item.querySelector('input[type="hidden"]').value; // Assuming product_id is hidden

                    // Create hidden inputs for each cart item
                    const htmlContent = `
                        <input type="hidden" name="cart_ids[]" value="${cartId}">
                        <input type="hidden" name="quantities[]" value="${quantity}">
                    `;
                    container.insertAdjacentHTML('beforeend', htmlContent);
                });
            }

            // Call on page load to setup form
            document.addEventListener('DOMContentLoaded', function() {
                populateCheckoutForm();
            });

            // Smooth scroll for sticky cart summary
            window.addEventListener('scroll', function() {
                const cartSummary = document.querySelector('.sticky-top');
                if (cartSummary) {
                    const scrolled = window.pageYOffset;
                    const rate = scrolled * -0.5;
                    cartSummary.style.transform = 'translateY(' + rate + 'px)';
                }
            });
        </script>
    @endpush
@endsection
