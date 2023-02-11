@extends('layouts.main')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    {{-- jika cart kosong maka --}}
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
