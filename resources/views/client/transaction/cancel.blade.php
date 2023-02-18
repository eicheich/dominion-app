{{-- @extends('layouts.main')

@section('content')
    <form action="{{ route('orders.cancellation', $order->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" readonly value="{{ $order->name }}">
        </div>
        <div class="form-group">
            <label for="name">Item</label>
            <input type="text" name="name" id="name" class="form-control" readonly
                value="{{ $order->product->name }}">
        </div>
        <label class="mt-3" for="image">Image</label>

        <div class="form-group">
            <img src="{{ asset('storage/images/products/' . $order->product->image) }}" alt="" width="100">
        </div>

        <div class="form-group mt-5">
            <label for="address">Reason for cancellation</label>
            <textarea name="reason" id="reason" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group pt-4">
            <button type="submit" class="btn btn-danger">Submit</button>
        </div>
    </form>
@endsection --}}

@extends('layouts.main')

<div class="container">
    @section('content')
        <p class="text-dom-a3 text-center">
            Cancellation Order
        </p>
        <div class="p-5">
            <a class="tnone" href="{{ route('client.product.show', $order->product->id) }}">
                <div class="card-pay">
                    <div class="card-body-cart">
                        <div class="img-cart">
                            <img class="img-carts" src="{{ asset('storage/images/products/' . $order->product->image) }}">
                        </div>
                        <div class="qty-pay">
                            <h3 class="text-dom-a4">{{ $order->product->name }}</h3>
                            <h3 class="text-dom-a6">{{ $order->product->category->name }}</h3>
                            <div class="qty-pay gap flex">
                                <h3 class="text-dom-a6">Blue</h3>
                                <h3 class="text-dom-a6">Qty x{{ $order->quantity }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="qty-pay">
                        <h3 class="text-dom-a5">IDR. {{ number_format($order->product->price, 3) }}</h3>
                    </div>
                </div>
            </a>
            <div class="flex-r">
                <table class="table table-borderless ">
                    <tbody>
                        <tr>
                            <th class="d-text">Fee Shipping</th>
                            <td class="d-text-2  text-end">Free</td>
                        </tr>
                        <tr>
                            <th class="d-text">Taxes</th>
                            <td class="d-text-2 text-end">-</td>
                        </tr>
                        <tr>
                            <th class="d-text">Subtotal</th>
                            <td class="d-text-2 text-end">IDR. {{ number_format($order->total) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr class="text-dom-a3">
            <div class="center">
                <form  action="{{ route('orders.cancellation', $order->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group mt-5">
                    <label class="text-dom-a4" for="address">Reason for cancellation</label>
                    <textarea name="reason" id="reason" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="center">
                    <button type="submit" class="btn-c mt-4 ">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    </div>
@endsection
