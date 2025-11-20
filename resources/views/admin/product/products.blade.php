@extends('layouts.mainAdmin')

@section('title', 'Products Management - Dominion Sports Store')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="bi bi-box me-2"></i>Products Management
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <span class="badge bg-primary fs-6 me-2">{{ $products->total() }} Products</span>
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Add Product
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Products</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Product::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box text-primary fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">In Stock</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\Product::where('stock', '>', 0)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check-circle text-success fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Low Stock</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\Product::where('stock', '>', 0)->where('stock', '<=', 10)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-exclamation-triangle text-warning fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Out of Stock</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\Product::where('stock', '=', 0)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-x-circle text-danger fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="searchProducts" class="form-label">Search Products</label>
                    <input type="text" class="form-control" id="searchProducts"
                        placeholder="Search by name, description...">
                </div>
                <div class="col-md-3">
                    <label for="categoryFilter" class="form-label">Category</label>
                    <select class="form-select" id="categoryFilter">
                        <option value="">All Categories</option>
                        @foreach (\App\Models\Category::all() as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="stockFilter" class="form-label">Stock Status</label>
                    <select class="form-select" id="stockFilter">
                        <option value="">All Stock</option>
                        <option value="in-stock">In Stock</option>
                        <option value="low-stock">Low Stock (≤10)</option>
                        <option value="out-of-stock">Out of Stock</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-outline-secondary w-100" onclick="clearFilters()">
                        <i class="bi bi-x-circle me-1"></i>Clear
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4" id="productsGrid">
        @foreach ($products as $product)
            <div class="col product-card" data-name="{{ strtolower($product->name) }}"
                data-category="{{ strtolower($product->category->name) }}" data-stock="{{ $product->stock }}">
                <div class="card h-100 shadow-sm">
                    <!-- Product Image -->
                    <div class="position-relative">
                        @if ($product->image && file_exists(public_path('storage/images/products/' . $product->image)))
                            <img src="{{ asset('storage/images/products/' . $product->image) }}" class="card-img-top"
                                style="height: 200px; object-fit: cover;" alt="{{ $product->name }}">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                style="height: 200px;">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>
                        @endif

                        <!-- Stock Badge -->
                        <div class="position-absolute top-0 end-0 p-2">
                            @if ($product->stock > 10)
                                <span class="badge bg-success">In Stock</span>
                            @elseif($product->stock > 0)
                                <span class="badge bg-warning">Low Stock</span>
                            @else
                                <span class="badge bg-danger">Out of Stock</span>
                            @endif
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <!-- Product Title -->
                        <h5 class="card-title mb-2">{{ $product->name }}</h5>

                        <!-- Product Description -->
                        <p class="card-text text-muted small mb-2" style="height: 40px; overflow: hidden;">
                            {{ Str::limit($product->description, 80) }}
                        </p>

                        <!-- Category -->
                        <div class="mb-2">
                            <span class="badge bg-light text-dark">
                                <i class="bi bi-tag me-1"></i>{{ $product->category->name }}
                            </span>
                        </div>

                        <!-- Price and Stock Info -->
                        <div class="row mb-3">
                            <div class="col-6">
                                <small class="text-muted">Price</small>
                                <div class="fw-bold text-success">${{ number_format($product->price) }}
                                </div>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Stock</small>
                                <div
                                    class="fw-bold {{ $product->stock > 10 ? 'text-success' : ($product->stock > 0 ? 'text-warning' : 'text-danger') }}">
                                    {{ $product->stock }} units
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-auto">
                            <div class="d-flex gap-1 mb-2">
                                <a href="{{ route('products.show', $product->id) }}"
                                    class="btn btn-sm btn-outline-info flex-fill" title="View Details">
                                    <i class="bi bi-eye me-1"></i>View
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="btn btn-sm btn-outline-warning flex-fill" title="Edit Product">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                            </div>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                class="form-action">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100"
                                    onclick="return confirm('Are you sure you want to delete this product?')"
                                    title="Delete Product">
                                    <i class="bi bi-trash me-1"></i>Delete Product
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="text-center py-5" style="display: none;">
        <div class="mb-3">
            <i class="bi bi-search display-1 text-muted"></i>
        </div>
        <h5 class="text-muted">No Products Found</h5>
        <p class="text-muted">Try adjusting your search or filter criteria.</p>
        <button type="button" class="btn btn-outline-primary" onclick="clearFilters()">
            <i class="bi bi-arrow-clockwise me-1"></i>Clear Filters
        </button>
    </div>
    <!-- Pagination -->
    @if ($products->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    @endif

    <script>
        // Search and Filter Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchProducts');
            const categoryFilter = document.getElementById('categoryFilter');
            const stockFilter = document.getElementById('stockFilter');
            const productsGrid = document.getElementById('productsGrid');
            const emptyState = document.getElementById('emptyState');

            function filterProducts() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedCategory = categoryFilter.value.toLowerCase();
                const selectedStock = stockFilter.value;
                const productCards = document.querySelectorAll('.product-card');

                let visibleCount = 0;

                productCards.forEach(card => {
                    const name = card.dataset.name || '';
                    const category = card.dataset.category || '';
                    const stock = parseInt(card.dataset.stock) || 0;

                    let showCard = true;

                    // Search filter
                    if (searchTerm && !name.includes(searchTerm)) {
                        showCard = false;
                    }

                    // Category filter
                    if (selectedCategory && category !== selectedCategory) {
                        showCard = false;
                    }

                    // Stock filter
                    if (selectedStock) {
                        switch (selectedStock) {
                            case 'in-stock':
                                if (stock <= 10) showCard = false;
                                break;
                            case 'low-stock':
                                if (stock > 10 || stock === 0) showCard = false;
                                break;
                            case 'out-of-stock':
                                if (stock > 0) showCard = false;
                                break;
                        }
                    }

                    if (showCard) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show/hide empty state
                if (visibleCount === 0) {
                    productsGrid.style.display = 'none';
                    emptyState.style.display = 'block';
                } else {
                    productsGrid.style.display = 'flex';
                    emptyState.style.display = 'none';
                }
            }

            // Event listeners
            searchInput.addEventListener('input', filterProducts);
            categoryFilter.addEventListener('change', filterProducts);
            stockFilter.addEventListener('change', filterProducts);

            // Clear filters function (global scope)
            window.clearFilters = function() {
                searchInput.value = '';
                categoryFilter.value = '';
                stockFilter.value = '';
                filterProducts();
            };
        });
    </script>
@endsection
