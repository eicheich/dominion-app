@extends('layouts.main')

@section('content')
    {{-- detail order and transaction jangan menggunakan table --}}
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
                                        <td>{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Date</th>
                                        <td>{{ $order->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Status</th>
                                        <td>
                                            @if ($order->status == 'pending')
                                                <p class="text-warning bold">{{ $order->status }} </p>
                                                <a href="{{ route('pay', $order->id) }}"
                                                    class="btn btn-outline-dark">Pay</a>
                                            @elseif ($order->status == 'success')
                                        <td class="text-success">{{ $order->status }}</td>
                                    @else
                                        <td class="text bold">{{ $order->status }}</td>
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th>Order Total</th>
                                        <td>{{ $order->total }}</td>
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
                        {{-- jika blm bayar akan ada button pay --}}

                        <div class="row">
                            <div class="col-md-12">
                                <h5>Product</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $order->product->name }}</td>
                                            <td><img src="{{ asset('storage/images/products/' . $order->product->image) }}"
                                                    alt="product-image" width="200"></td>
                                            <td>{{ $order->product->category->name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
