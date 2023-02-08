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
                                <a href="{{ route('products.edit', $product->id) }}" class="btn-dom"><i data-feather="edit"></i></a>
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
        @endsection
