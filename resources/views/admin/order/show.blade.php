@extends('layouts.mainAdmin')

@section('content')
    {{-- form detail --}}
    <div class="container-fluid">
        <div class="row">

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard Admin</h1>
                    <h2>Order</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-secondary">Back</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="color-black">Order Detail</h3>
                        <table class="table-infouser">
                            <tr>
                                <th>Order ID</th>
                                <td>{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Order Status</th>
                                <td>{{ $order->status }}</td>
                            </tr>
                            <tr>
                                <th>Order Total</th>
                                <td>{{ $order->total }}</td>
                            </tr>
                            {{-- jika ada payment yang order_id nya sama maka tampilkan value pament by --}}
                            @if ($order->transaction)
                                <tr>
                                    <th>Payment By</th>
                                    <td>{{ $order->transaction->payment_by }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Status</th>
                                    <td>{{ $order->transaction->status }}</td>
                                </tr>
                            @else
                                <tr>
                                    <th>Payment By</th>
                                    <td>Not Yet</td>
                                </tr>
                                <tr>
                                    <th>Payment Status</th>
                                    <td>Not Yet</td>
                                </tr>
                            @endif



                        </table>
                    </div>
                    <div class="col-md-6">
                        <h3 class="color-black">Customer Detail</h3>
                        <table class="table-infouser">
                            <tr>
                                <th>Customer Name</th>
                                <td>{{ $order->name }}</td>
                            </tr>
                            <tr>
                                <th>Customer Email</th>
                                <td>{{ $order->user->email }}</td>
                            </tr>
                            <tr>
                                <th>Customer Phone</th>
                                <td>{{ $order->phone }}</td>
                            </tr>
                            <tr>
                                <th>Customer Adress</th>
                                <td>{{ $order->address }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="color-black">Product Detail</h3>
                        <table class="table-product">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tr>
                                <td><img src="{{ asset('storage/images/products/' . $order->product->image) }}"
                                        alt="" width="100"></td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->product->price }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total }}</td>
                            </tr>
                        </table>
                        <div class="btn-group">
                            @if ($order->status == 'payment confirmed')
                                <form action="{{ route('orders.update.delivery', $order->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="status" value="shipped">
                                    <button type="submit" class="btn-dom align-right">Delivery</button>
                                </form>
                            @endif
                            <a class="btn-dom" href="#" id="menu"><i data-feather="printer"></i></a>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
