@extends('layouts.main')

@section('title', $category->name . ' - Dominion Sports Store')

@section('content')
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('landingpage') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active">{{ $category->name }}</li>
            </ol>
        </nav>

        <!-- Category Header -->
        <div class="mb-5">
            <div class="d-flex align-items-center gap-3 mb-2">
                <h1 class="h2 fw-bold mb-0">
                    <i class="bi bi-tag-fill me-2" style="color: #001f3f;"></i>{{ $category->name }}
                </h1>
                <span class="badge bg-primary fs-6">{{ $products->total() }} products</span>
            </div>
            <p class="text-muted mb-4">
                Browse all items in the {{ $category->name }} category
            </p>

            <!-- Back Button -->
            <a href="{{ route('landingpage') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-2"></i>Back to Home
            </a>
        </div>

        @if ($products->count() > 0)
            <!-- Products Grid -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 mb-5">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm product-card">
                            @auth
                                <a href="{{ route('client.product.show', $product->id) }}" class="text-decoration-none">
                                @else
                                    <a href="{{ route('login') }}" class="text-decoration-none">
                                    @endauth
                                    <div class="position-relative overflow-hidden">
                                        @if ($product->image && file_exists(public_path('storage/images/products/' . $product->image)))
                                            <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                                class="card-img-top" alt="{{ $product->name }}"
                                                style="height: 250px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center"
                                                style="height: 250px;">
                                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                            </div>
                                        @endif

                                        @if ($product->stock > 0)
                                            <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                                <i class="bi bi-check-circle me-1"></i>In Stock
                                            </span>
                                        @else
                                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                                <i class="bi bi-x-circle me-1"></i>Out of Stock
                                            </span>
                                        @endif

                                        <span class="badge bg-primary position-absolute top-0 end-0 m-2">
                                            {{ $product->category->name ?? 'Uncategorized' }}
                                        </span>
                                    </div>

                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-dark fw-bold mb-2">{{ $product->name }}</h5>
                                        <p class="card-text text-muted small mb-3 flex-grow-1">
                                            {{ Str::limit($product->description, 80) }}
                                        </p>

                                        <div class="d-flex justify-content-between align-items-center mt-auto">
                                            <div>
                                                <span class="h5 text-primary fw-bold mb-0">
                                                    ${{ number_format($product->price) }}
                                                </span>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="bi bi-box me-1"></i>{{ $product->stock }} items left
                                                </small>
                                            </div>
                                            <div class="text-end">
                                                @auth
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="bi bi-cart-plus"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-outline-primary btn-sm">
                                                        <i class="bi bi-box-arrow-in-right"></i>
                                                    </button>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($products->hasPages())
                <nav aria-label="Page navigation" class="d-flex justify-content-center">
                    {{ $products->links() }}
                </nav>
            @endif
        @else
            <!-- No Products State -->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-inbox display-1 text-muted"></i>
                        </div>
                        <h4 class="text-muted mb-2">No Products in This Category</h4>
                        <p class="text-muted mb-4">
                            There are no products available in the <strong>{{ $category->name }}</strong> category yet.
                        </p>

                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ route('landingpage') }}" class="btn btn-primary">
                                <i class="bi bi-shop me-2"></i>Browse All Products
                            </a>
                            <a href="{{ route('landingpage') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .breadcrumb {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
        }

        .product-card {
            transition: all 0.25s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        .product-card img {
            transition: transform 0.25s ease;
        }

        .product-card:hover img {
            transform: scale(1.03);
        }

        .btn-primary {
            background-color: #001f3f !important;
            border-color: #001f3f !important;
        }

        .btn-primary:hover {
            background-color: #003366 !important;
            border-color: #003366 !important;
        }
    </style>
@endsection
