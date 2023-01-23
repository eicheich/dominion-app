@extends('layouts.main')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    {{-- table cart yang menggunakan checkbox untuk memilih product yang akan di checkout atau delete --}}

    <form action="#" method="POST">
        @csrf
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
                        <td>{{ $cart->quantity }}</td>
                        <td>{{ $cart->product->price * $cart->quantity }}</td>
                        <td>
                            <input type="checkbox" name="product_id[]" value="{{ $cart->id }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Checkout</button>
    </form>
@endsection
