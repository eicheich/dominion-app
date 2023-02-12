{{-- @extends('layouts.mainAdmin')
@include('layouts.navadmin')
<form method="post" action="{{ route('products.update', $product->id) }}" class="p-5 " enctype="multipart/form-data" >
    @csrf
    @method('put')
    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input id="price" type="number" class="form-control" name="price" value="{{ $product->price }}" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input id="description" type="text" class="form-control" name="description" value="{{ $product->description }}" required>
    </div>
    <br>
    <img src="{{ asset('storage/images/products/'.$product->image) }}" alt="" width="100px">
    <div class="form-group">
        <label for="image">Image</label>
        <input id="image" type="file" class="form-control" name="image" value="{{ $product->image }}" >
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $ctg)
                <option value="{{ $ctg->id }}">{{ $ctg->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="stock">Stock</label>
        <input id="stock" type="number" class="form-control" name="stock" value="{{ $product->stock }}" required>
    </div>
    <div class="form-group pt-5 ">
        <button type="submit" class="btn btn-primary">
            Edit
        </button>
    </div>
</form> --}}


@extends('layouts.mainAdmin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <form method="post" action="{{ route('products.update', $product->id) }}" class="p-5 mt-5"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label class="text-dom-a5" for="name">Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}"
                        required>
                </div>
                <div class="form-group">
                    <label class="text-dom-a5" for="price">Price</label>
                    <input id="price" type="number" class="form-control" name="price" value="{{ $product->price }}"
                        required>
                </div>
                <div class="form-group">
                    <label class="text-dom-a5" for="description">Description</label>
                    <input id="description" type="text" class="form-control" name="description"
                        value="{{ $product->description }}" required>
                </div>
                <br>
                <img src="{{ asset('storage/images/products/' . $product->image) }}" alt="" width="100px">
                <div class="form-group">
                    <label class="text-dom-a5" for="image">Image</label>
                    <input id="image" type="file" class="form-control" name="image" value="{{ $product->image }}">
                </div>
                <div class="form-group">
                    <label class="text-dom-a5" for="category">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $ctg)
                            <option value="{{ $ctg->id }}">{{ $ctg->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="text-dom-a5" for="stock">Stock</label>
                    <input id="stock" type="number" class="form-control" name="stock" value="{{ $product->stock }}"
                        required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-dom">
                        Edit
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
