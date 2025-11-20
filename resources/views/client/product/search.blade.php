@extends('layouts.main')

@section('title', 'Search Results - Dominion Sports Store')

@section('content')
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('landingpage') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active">Search Results</li>
            </ol>
        </nav>

        <!-- Search Header -->
        <div class="mb-5">
            <h1 class="h2 fw-bold mb-2">
                <i class="bi bi-search me-2"></i>Search Results
            </h1>
            <p class="text-muted mb-3">
                Found <strong>{{ $products->total() }}</strong> product(s) for "<strong>{{ $query }}</strong>"
            </p>

            <!-- New Search Form -->
            <form action="{{ route('search') }}" method="GET" class="mb-4">
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" placeholder="Search products..." name="q"
                        value="{{ $query }}" required>
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search me-2"></i>Search Again
                    </button>
                    <a href="{{ route('landingpage') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-2"></i>Clear
                    </a>
                </div>
            </form>
        </div>

        @if ($products->count() > 0)
            <!-- Products Grid -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 mb-5">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm product-card">
                            @auth
                                <!-- Product Image with Wishlist -->
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

                                    <!-- Stock Badge -->
                                    @if ($product->stock == 0)
                                        <span class="position-absolute top-2 end-2 badge bg-danger">
                                            <i class="bi bi-x-circle me-1"></i>Out of Stock
                                        </span>
                                    @elseif ($product->stock <= 5)
                                        <span class="position-absolute top-2 end-2 badge bg-warning">
                                            <i class="bi bi-exclamation-circle me-1"></i>Only {{ $product->stock }} left
                                        </span>
                                    @endif
                                </div>

                                <!-- Category Badge -->
                                <div class="position-absolute top-2 start-2">
                                    <span class="badge bg-primary">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                </div>
                            @else
                                @if ($product->image && file_exists(public_path('storage/images/products/' . $product->image)))
                                    <img src="{{ asset('storage/images/products/' . $product->image) }}" class="card-img-top"
                                        alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                        style="height: 250px;">
                                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                            @endauth

                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-dark fw-bold mb-2">{{ $product->name }}</h5>
                                <p class="card-text text-muted small mb-3 flex-grow-1">
                                    {{ Str::limit($product->description, 80) }}
                                </p>

                                <!-- Price and Stock Info -->
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
                                            <a href="{{ route('client.product.show', $product->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="bi bi-eye me-1"></i>View
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-box-arrow-in"></i>
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($products->hasPages())
                <nav aria-label="Page navigation" class="d-flex justify-content-center">
                    {{ $products->appends(request()->query())->links() }}
                </nav>
            @endif
        @else
            <!-- No Results State -->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-search display-1 text-muted"></i>
                        </div>
                        <h4 class="text-muted mb-2">No Products Found</h4>
                        <p class="text-muted mb-4">
                            We couldn't find any products matching "<strong>{{ $query }}</strong>".
                            <br>Try searching with different keywords.
                        </p>

                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <form action="{{ route('search') }}" method="GET" class="d-inline">
                                <button type="submit" class="btn btn-outline-primary" name="q" value="">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Try New Search
                                </button>
                            </form>
                            <a href="{{ route('landingpage') }}" class="btn btn-primary">
                                <i class="bi bi-shop me-2"></i>Back to Home
                            </a>
                        </div>

                        <!-- Suggestions -->
                        <div class="mt-5 pt-4 border-top">
                            <h6 class="fw-bold mb-3 text-muted">Popular Categories</h6>
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
        @endif
    </div>

    <style>
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
        }

        .breadcrumb {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
        }
    </style>
@endsection
