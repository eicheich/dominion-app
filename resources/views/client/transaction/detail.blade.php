@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Detail Order</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Order</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Order ID</th>
                                        <td>{{ $order->order_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Date</th>
                                        <td>{{ $order->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Status</th>
                                        <td class="{{ getOrderStatusClass($order->status) }}">{{ $order->status }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>{{ $order->total }}</td>
                                    </tr>
                                    <tr>
                                        <th>Delivery status</th>
                                        <td>{{ $order->name }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5>Customer</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $order->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $order->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ $order->address }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Product</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><img src="{{ asset('storage/images/products/' . $order->product->image) }}"
                                                    alt="product-image" width="200"></td>
                                            <td>{{ $order->product->name }}</td>
                                            <td>{{ $order->product->category->name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                {!! getCancellationLink($order) !!}
                                @if ($order->status == 'delivered')
                                    <form action="{{route('confirm.orders', $order->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary ">Confirm</button>
                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
