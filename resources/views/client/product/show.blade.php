@extends('layouts.main')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    @section('content')
        <div class="row">
            <div class="col-md-6">
                <img class="img-detail" src="{{ asset('storage/images/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
            </div>
            <div class="col-md-6 ">
                <h1 class="text-dom-span">{{ $product->category->name }}</h1>
                <h1 class="text-dom-a3">{{ $product->name }}</h1>
                <p class="text-dom-a4">$ {{ $product->price }}.00</p>
                {{-- make a line with grey color --}}
                <hr class="text-dom-a3">
                <p class="text-dom-a4" >{{ $product->description }}</p>
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <button type="submit" class="btn btn-success">Add to cart</button>
                </form>
            </div>
        </div>
@endsection
