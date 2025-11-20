@extends('layouts.mainAdmin')

@section('title', 'Add Product - Dominion Sports Store')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="bi bi-plus-circle me-2"></i>Add New Product
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Products
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Product Information</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-bold">Product Name</label>
                                <input id="name" type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label fw-bold">Price ($)</label>
                                <input id="price" type="number" class="form-control" name="price" required
                                    step="0.01">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea id="description" class="form-control" name="description" rows="3" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label fw-bold">Category</label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <option value="">Choose category...</option>
                                    @foreach ($categories as $ctg)
                                        <option value="{{ $ctg->id }}">{{ $ctg->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stock" class="form-label fw-bold">Stock Quantity</label>
                                <input id="stock" type="number" class="form-control" name="stock" required
                                    min="0">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold">Product Image</label>
                            <input id="image" type="file" class="form-control" name="image" required
                                accept="image/*">
                            <small class="text-muted">Upload product image (JPG, PNG, GIF)</small>
                        </div>
                        <div class="form-group pt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-save me-2"></i>Add Product
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
