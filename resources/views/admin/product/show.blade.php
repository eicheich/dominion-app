@extends('layouts.mainAdmin')

@section('title', 'Product Details - Admin Dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="bi bi-eye me-2"></i>Product Details
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-1"></i>Edit Product
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Back to Products
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-image me-2"></i>Product Image
                    </h5>
                </div>
                <div class="card-body text-center">
                    @if ($product->image)
                        <img src="{{ asset('storage/images/products/' . $product->image) }}" alt="{{ $product->name }}"
                            class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: cover;">
                    @else
                        <div class="text-muted">
                            <i class="bi bi-image display-1"></i>
                            <p class="mt-2">No image available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-info-circle me-2"></i>Product Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Product Name:</div>
                        <div class="col-sm-8">{{ $product->name }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Category:</div>
                        <div class="col-sm-8">
                            <span class="badge bg-primary">{{ $product->category->name ?? 'No Category' }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Price:</div>
                        <div class="col-sm-8">
                            <span class="fs-5 fw-bold text-success">Rp
                                ${{ number_format($product->price) }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Stock:</div>
                        <div class="col-sm-8">
                            @if ($product->stock > 10)
                                <span class="badge bg-success fs-6">{{ $product->stock }} units</span>
                            @elseif($product->stock > 0)
                                <span class="badge bg-warning fs-6">{{ $product->stock }} units</span>
                            @else
                                <span class="badge bg-danger fs-6">Out of Stock</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Description:</div>
                        <div class="col-sm-8">
                            <p class="mb-0">{{ $product->description }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Created:</div>
                        <div class="col-sm-8">
                            <small class="text-muted">{{ $product->created_at->format('M d, Y H:i') }}</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Last Updated:</div>
                        <div class="col-sm-8">
                            <small class="text-muted">{{ $product->updated_at->format('M d, Y H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-gear me-2"></i>Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="btn-group" role="group">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-1"></i>Edit Product
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash me-1"></i>Delete Product
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="bi bi-exclamation-triangle text-danger me-2"></i>Confirm Delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong>{{ $product->name }}</strong>?</p>
                    <p class="text-muted">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i>Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .card-header {
            border-bottom: 1px solid #dee2e6;
        }

        .btn-group .btn {
            margin-right: 0.5rem;
        }

        .btn-group .btn:last-child {
            margin-right: 0;
        }
    </style>
@endpush
