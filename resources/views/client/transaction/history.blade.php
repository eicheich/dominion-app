{{-- @extends('layouts.main')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (count($orders) == 0)
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>History</h3>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center">You don't have any transaction</h3>
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
                    <th scope="col">Nama</th>
                    <th scope="col">Image</th>
                    <th scope="col">Total</th>
                    <th scope="col">status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $order->product->name }}</td>
                        <td><img src="{{ asset('storage/images/products/' . $order->product->image) }}" alt="product-image"
                                width="100"></td>
                        <td>{{ $order->total }}</td>
                        <td class="{{ getOrderStatusClass($order->status) }}">{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('detail', $order->id) }}" class="btn btn-primary">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    @endif

@endsection --}}

@extends('layouts.main')

<div class="container">
    @section('content')
        @if (count($orders) == 0)
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
    <div class="row">
        <div class="col-md-12">
            <div class="card-pay">
                <h3 class="text-dom-a3 pb-4">History</h3>
            </div>
            @foreach ($orders as $odr)
                <a class="tnone" href="{{ route('detail', $odr  ->id) }}">
                    <div class="card-pay">
                        <div class="card-body-cart">
                            <div class="img-cart">
                                <img class="img-carts" src="{{ asset('storage/images/products/' . $odr->product->image) }}">
                            </div>
                            <div class="title-pay">
                                <h3 class="text-dom-a4">{{ $odr->product->name }}</h3>
                                <h3 class="text-dom-a6">Size : {{ $odr->size }}</h3>
                                <h3 class="text-dom-a6">Color : Blue</h3>
                                <h3 class="text-dom-a6">Qty : {{ $odr->quantity }}</h3>
                            </div>
                        </div>
                        <div class="title-pay">
                            <h3 class="text-dom-a6">{{ $odr->order_number }}</h3>
                        </div>
                        <div class="title-pay">
                            <h3 class="text-dom-a6">{{ $odr->created_at }}</h3>
                        </div>
                        <div class="title-pay">
                            <h3 class="text-dom-a6">$ {{ number_format($odr->total, 2) }}</h3>
                        </div>
                        <div class="title-pay">
                            <span class="{{ getOrderStatusClass($odr->status) }}"> {{ $odr->status }}</span>
                        </div>
                    </div>
                </a>
                <hr class="text-dom-a3 ">
                <br>
            @endforeach
            @endif
        </div>
    @endsection
