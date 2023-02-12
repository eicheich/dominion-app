@extends('layouts.mainAdmin')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- include navbar --}}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            {{-- information card with big icons --}}
            <div class="row-product">
                <h3>All Products</h3>
                 <div class="search-filter">
                    <div class="col">
                        <form action="{{ route('search.product') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search by cancellations number"
                                    aria-label="Recipient's username" aria-describedby="button-addon2" name="search">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                            </div>

                        </form>
                    </div>
                </div>

                <a href="{{ route('products.create') }}" class="btn-dom">Add Product</a>
            </div>


            <table class="table-product">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td><img src="{{ asset('storage/images/products/' . $product->image) }}" alt=""
                                    style="width: 100px"></td>
                            <td class="button-group">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn-dom"><i
                                        data-feather="edit"></i></a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn-dom"><i data-feather="trash-2"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center pt-5">
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <a href="{{ $products->previousPageUrl() }}" class="btn btn-sm btn-outline-secondary">Previous</a>
                    </div>
                </div>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <a href="{{ $products->nextPageUrl() }}" class="btn btn-sm btn-outline-secondary">Next</a>
                    </div>
                </div>
            </div>
        @endsection
