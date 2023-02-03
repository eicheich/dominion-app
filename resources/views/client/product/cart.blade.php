@extends('layouts.main')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
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
                        {{-- <input type="checkbox" name="product_id[]" value="{{ $cart->id }}"> --}}
                        {{-- checkout --}}
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
@endsection
