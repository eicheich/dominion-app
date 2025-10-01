@extends('layouts.main')

@section('title', 'Home - Dominion Sports Store')

@section('content')
    <!-- Hero Section -->
    <section class="bg-primary text-white py-5 mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Welcome to Dominion Sports</h1>
                    <p class="lead mb-4">Discover the best sports equipment and gear for all your athletic needs. From
                        professional gear to beginner-friendly options, we have everything you need to excel in your
                        favorite sports.</p>
                    @auth
                        <a href="#products" class="btn btn-light btn-lg">
                            <i class="bi bi-arrow-down me-2"></i>Shop Now
                        </a>
                    @else
                        <div class="d-flex gap-3">
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                                <i class="bi bi-person-plus me-2"></i>Join Now
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                            </a>
                        </div>
                    @endauth
                </div>
                <div class="col-lg-6 text-center">
                    <i class="bi bi-trophy-fill" style="font-size: 10rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 mb-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0">
                        <div class="card-body">
                            <i class="bi bi-truck text-primary mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Free Delivery</h5>
                            <p class="card-text text-muted">Free shipping on orders over $100. Fast and reliable delivery to
                                your doorstep.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0">
                        <div class="card-body">
                            <i class="bi bi-shield-check text-primary mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Quality Guarantee</h5>
                            <p class="card-text text-muted">All our products come with quality guarantee. Return within 30
                                days if not satisfied.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0">
                        <div class="card-body">
                            <i class="bi bi-headset text-primary mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">24/7 Support</h5>
                            <p class="card-text text-muted">Our customer support team is available 24/7 to help you with any
                                questions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">Featured Products</h2>
                    <p class="lead text-muted">Discover our top-rated sports equipment and gear</p>
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
                                                style="height: 250px; object-fit: cover; transition: transform 0.3s ease;">

                                            <!-- Stock Badge -->
                                            @if ($product->stock > 0)
                                                <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                                    <i class="bi bi-check-circle me-1"></i>In Stock
                                                </span>
                                            @else
                                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                                    <i class="bi bi-x-circle me-1"></i>Out of Stock
                                                </span>
                                            @endif

                                            <!-- Category Badge -->
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
            .product-card:hover img {
                transform: scale(1.05);
            }

            .product-card:hover {
                transform: translateY(-5px);
            }

            .hero-section {
                background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
            }
        </style>
    @endpush
@endsection
