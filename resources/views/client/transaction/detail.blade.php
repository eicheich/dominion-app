@extends('layouts.main')

<div class="container">
    @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="detail-header">
                    <p class="text-dom-a4 w-c">No. order : {{ $order->order_number }}</p>
                </div>
                <hr class="text-dom-a3 ">
                <div class="card-detail-header pb-4">
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
                    <div class="card-pay">
                        <div class="card-body-cart">
                            <div class="img-cart">
                                <img class="img-carts"
                                    src="{{ asset('storage/images/products/' . $order->product->image) }}">
                            </div>
                            <div class="qty-pay">
                                <h3 class="text-dom-a4">{{ $order->product->name }}</h3>
                                <h3 class="text-dom-a6">{{ $order->product->category->name }}</h3>
                                <div class="qty-pay gap flex">
                                    <h3 class="text-dom-a6">Blue</h3>
                                    <h3 class="text-dom-a6">Qty : x{{ $order->quantity }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="qty-pay">
                            <h3 class="text-dom-a5">IDR. {{ number_format($order->product->price) }}</h3>
                        </div>
                    </div>
                </a>
                <hr class="text-dom-a3 ">

                <div class="flex-r pt-5">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th class="d-text">Fee Shipping</th>
                                <td class="d-text-2">Free</td>
                            </tr>
                            <tr>
                                <th class="d-text">Taxes</th>
                                <td class="d-text-2">-</td>
                            </tr>
                            <tr>
                                <th class="d-text">Subtotal</th>
                                <td class="d-text-2">IDR. {{ number_format($order->total) }}</td>
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
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
    </div>
@endsection
