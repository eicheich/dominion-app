@extends('layouts.main')

@section('title', $product->name . ' - Dominion Sports Store')

@section('content')
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('landingpage') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('landingpage') }}" class="text-decoration-none">Products</a></li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Product Image -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="position-relative">
                        <img src="{{ asset('storage/images/products/' . $product->image) }}" class="card-img-top rounded"
                            alt="{{ $product->name }}" style="height: 500px; object-fit: cover;">

                        <!-- Stock Status Badge -->
                        @if ($product->stock > 0)
                            <span class="badge bg-success position-absolute top-0 start-0 m-3 px-3 py-2">
                                <i class="bi bi-check-circle me-2"></i>In Stock
                            </span>
                        @else
                            <span class="badge bg-danger position-absolute top-0 start-0 m-3 px-3 py-2">
                                <i class="bi bi-x-circle me-2"></i>Out of Stock
                            </span>
                        @endif

                        <!-- Category Badge -->
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3 px-3 py-2">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-lg-6">
                <div class="ps-lg-4">
                    <h1 class="display-5 fw-bold mb-3">{{ $product->name }}</h1>

                    <div class="mb-4">
                        <span class="h2 text-primary fw-bold">${{ number_format($product->price) }}</span>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-bold mb-2">Description</h5>
                        <p class="text-muted">{{ $product->description }}</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-box text-primary me-2"></i>
                                <strong>Stock:</strong>
                                <span
                                    class="ms-2 badge {{ $product->stock > 10 ? 'bg-success' : ($product->stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $product->stock }} items
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-tag text-primary me-2"></i>
                                <strong>Category:</strong>
                                <span class="ms-2">{{ $product->category->name ?? 'Uncategorized' }}</span>
                            </div>
                        </div>
                    </div>

                    @if ($product->stock > 0)
                        <!-- Add to Cart Form -->
                        <div class="card border-0 bg-light p-4 mb-4">
                            <h5 class="fw-bold mb-3">Add to Cart</h5>
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="size" class="form-label fw-bold">Size</label>
                                        <select class="form-select" name="size" id="size" required>
                                            <option value="">Choose size...</option>
                                            <option value="S">Small (S)</option>
                                            <option value="M">Medium (M)</option>
                                            <option value="L">Large (L)</option>
                                            <option value="XL">Extra Large (XL)</option>
                                            <option value="XXL">Double XL (XXL)</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="quantity" class="form-label fw-bold">Quantity</label>
                                        <select class="form-select" name="quantity" id="quantity" required>
                                            <option value="">Choose quantity...</option>
                                            @for ($i = 1; $i <= min($product->stock, 10); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Out of Stock!</strong> This product is currently unavailable.
                        </div>
                    @endif

                    <!-- Additional Actions -->
                    <div class="d-flex gap-2">
                        <a href="{{ route('landingpage') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                        </a>
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-cart3 me-2"></i>View Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .product-image:hover {
                transform: scale(1.02);
                transition: transform 0.3s ease;
            }
        </style>
    @endpush
    </div>

    </div>

    {{-- related product --}}


@endsection
