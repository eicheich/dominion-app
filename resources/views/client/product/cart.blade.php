{{-- @extends('layouts.main')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (count($carts) == 0)
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Cart</h3>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center">Your cart is empty</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('landingpage') }}" class="btn btn-primary">Buy Products</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $cart->product->name }}</td>
                        <td>{{ $cart->product->price }}</td>
                        <td>
                            <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $cart->quantity }}">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </td>
                        <td>{{ $cart->product->price * $cart->quantity }}</td>
                        <td>
                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                @method('post')
                                <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                <input type="hidden" name="product_id" value="{{ $cart->product->id }}">
                                <input type="hidden" name="quantity" value="{{ $cart->quantity }}">
                                <input type="hidden" name="price" value="{{ $cart->product->price }}">
                                <input type="hidden" name="total" value="{{ $cart->product->price * $cart->quantity }}">
                                <input type="hidden" name="size" value="{{ $cart->size }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <button type="submit" class="btn btn-warning">Checkout</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </form>
    @endif
@endsection
 --}}

@extends('layouts.main')

<div class="container">
    @section('content')
        @if (count($carts) == 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Cart</h3>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center">Your cart is empty</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('landingpage') }}" class="btn btn-primary">Buy Products</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@else
    {{-- card --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <h3 class="text-dom-a3 pb-4">Shopping Cart</h3>
            </div>
            @foreach ($carts as $cart)
                <div class="card-cart">
                    <div class="card-body-cart">
                        <div class="img-cart">
                            <img class="img-carts" src="{{ asset('storage/images/products/' . $cart->product->image) }}">
                        </div>
                        <div class="title-cart">
                            <h3 class="text-dom-a4">{{ $cart->product->name }}</h3>
                            <h3 class="text-dom-a6">Size : {{ $cart->size }}</h3>
                            <h3 class="text-dom-a6">Color : Blue</h3>
                        </div>
                        {{-- button + and - --}}

                    </div>
                    <div class="qty-cart">
                        <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="input-group">
                                <button type="submit" class="btn-id" name="quantity"
                                    value="{{ $cart->quantity - 1 }}">-</button>
                                <input type="number" class="form-id" readonly value="{{ $cart->quantity}}"
                                    min="1" max="{{$cart->product->stock}}">
                                <button type="submit" class="btn-id" name="quantity"
                                    value="{{ $cart->quantity + 1 }}">+</button>
                            </div>
                        </form>
                    </div>
                    <div class="action-group">
                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" ><i data-feather="trash"></i></button>
                        </form>
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            @method('post')
                            <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                            <input type="hidden" name="product_id" value="{{ $cart->product->id }}">
                            <input type="hidden" name="quantity" value="{{ $cart->quantity }}">
                            <input type="hidden" name="price" value="{{ $cart->product->price }}">
                            <input type="hidden" name="total" value="{{ $cart->product->price * $cart->quantity }}">
                            <input type="hidden" name="size" value="{{ $cart->size }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <button type="submit" class="btn-ck">Checkout</button>
                        </form>
                        </form>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    @endsection
