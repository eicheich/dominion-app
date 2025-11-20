@extends('layouts.main')

@section('title', 'Home - Dominion')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section py-5">
        <div class="container py-4">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6">
                    <p class="text-uppercase text-muted fw-semibold small mb-2">New Arrivals • 2025</p>
                    <h1 class="display-5 fw-bold mb-3">Gear up for every match in style</h1>
                    <p class="text-secondary mb-4">Discover curated collections for volleyball, badminton, football, and
                        more. Sleek fits, breathable fabrics, and pro-grade equipment ready for your next game.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#products" class="btn btn-primary px-4">Shop Featured</a>
                        <a href="{{ route('history') }}" class="btn btn-outline-secondary px-4">Track Orders</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://wallpapers.com/images/hd/friends-playing-sports-png-wdq-g7je3sapli04unmv.jpg"
                        alt="Athlete" class="img-fluid hero-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Category Quick Links -->
    <section class="py-4 border-top border-bottom bg-white">
        <div class="container">
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                @forelse ($categories as $category)
                    <a href="{{ route('category', $category->id) }}" class="category-chip">
                        {{ $category->name }}
                    </a>
                @empty
                    <p class="text-muted">No categories available</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-4">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3">
                <div>
                    <p class="text-uppercase text-muted small mb-1">Just for you</p>
                    <h3 class="fw-bold mb-0">Featured Products</h3>
                </div>
                <div class="btn-group" role="group" aria-label="product filters">
                    <button class="btn btn-sm btn-outline-secondary">Latest</button>
                    <button class="btn btn-sm btn-outline-secondary">Popular</button>
                    <button class="btn btn-sm btn-outline-secondary">Top Rated</button>
                </div>
            </div>

            @if ($products->count() > 0)
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                    @foreach ($products as $product)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm product-card">
                                @auth
                                    <a href="{{ route('client.product.show', $product->id) }}" class="text-decoration-none">
                                    @else
                                        <a href="{{ route('login') }}" class="text-decoration-none">
                                        @endauth
                                        <div class="position-relative overflow-hidden">
                                            <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                                class="card-img-top" alt="{{ $product->name }}"
                                                style="height: 250px; object-fit: cover;">

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
            @else
                <div class="text-center py-5">
                    <i class="bi bi-box text-muted mb-3" style="font-size: 4rem;"></i>
                    <h4 class="text-muted">No Products Available</h4>
                    <p class="text-muted">Check back later for new products.</p>
                </div>
            @endif
        </div>
    </section>

    @push('styles')
        <style>
            .hero-section {
                background: linear-gradient(135deg, #f4f7fb 0%, #ffffff 100%);
                border-bottom: 1px solid #eef2f6;
            }

            .hero-image {
                max-height: 420px;
                object-fit: contain;
            }

            .btn-primary {
                background-color: #001f3f !important;
                border-color: #001f3f !important;
            }

            .btn-primary:hover {
                background-color: #003366 !important;
                border-color: #003366 !important;
            }

            .category-chip {
                display: block;
                padding: 0.65rem 1rem;
                border: 1px solid #e2e8f0;
                border-radius: 999px;
                font-weight: 600;
                color: #0f172a;
                text-decoration: none;
                transition: all 0.2s ease;
                font-size: 0.9rem;
                background-color: #fff;
            }

            .category-chip:hover {
                border-color: #001f3f;
                color: #001f3f;
                box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
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
        </style>
    @endpush
@endsection
