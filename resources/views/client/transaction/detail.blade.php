@extends('layouts.main')

<div class="container">
    @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card-detail-header">
                    <p class="text-dom-a4">No. order : {{ $order->order_number }}</p>
                </div>
                <div class="card-detail-header">
                    {{-- <hr class="text-dom-a3"> --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="flex-r">
                                    <p class="text-dom-a5"> {{ date('d-m-Y', strtotime($order->created_at)) }}</p>
                                    <span class="{{ getOrderStatusClass($order->status) }}"> {{ $order->status }}</span>
                                </div>

                                <br>
                                <div class="flex-r">
                                    <div class="col">
                                        <p class="text-dom-a4">Address</p>
                                        <div class="text-dom-a5">{{ $order->name }}</div>
                                        <div class="text-dom-a5">{{ $order->phone }}</div>
                                        <br>
                                        <div class="text-dom-a5 text-max">{{ $order->address }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="tnone" href="{{ route('client.product.show', $order->product->id) }}">
                    <div class="card-d">
                        <div class="card-body-cart">
                            <div class="img-cart">
                                <img class="img-carts"
                                    src="{{ asset('storage/images/products/' . $order->product->image) }}">
                            </div>
                            <div class="title-cart">
                                <h3 class="text-dom-a4">{{ $order->product->name }}</h3>
                                <h3 class="text-dom-a6">x{{ $order->quantity }}</h3>
                            </div>
                        </div>

                        <div class="qty-cart">
                            {{-- number format idr --}}
                            <h3 class="text-dom-a4">IDR. {{ number_format($order->product->price, 3) }}</h3>
                        </div>

                    </div>
                </a>
                <div class="flex-r">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th scope="row">Fee Shipping</th>
                                <td>Free</td>
                            </tr>
                            <tr>
                                <th scope="row">Subtotal</th>
                                <td>$ {{ number_format($order->total, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {!! getCancellationLink($order) !!}


                @if ($order->status == 'delivered')
                    <form action="{{ route('confirm.orders', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary ">Confirm</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
