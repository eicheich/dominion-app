{{-- @extends('layouts.mainAdmin')
@include('layouts.navadmin')

<div class="container-fluid">
    <div class="row">
        @include('layouts.dashboard')
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard Admin</h1>
                <h2>Data Delivery</h2>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <th>No Delivery</th>
                        <th>Item</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($deliveries as $delivery)
                            <tr>
                                <td>{{ $delivery->order->order_number }}</td>
                                <td>{{ $delivery->order->product->name }}</td>
                                <td>{{ $delivery->order->total }}</td>
                                <td>
                                    @if ($delivery->order->status == 'shipped')
                                        <form action="{{ route('delivery.update.status', $delivery->order_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('POST')
                                            <select name="status" id="status">
                                                <option value="shipped">Shipped</option>
                                                <option value="delivered">Delivered</option>
                                            </select>
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-secondary">update</button>
                                        </form>
                                    @elseif ($delivery->order->status == 'delivered')
                                        <button type="submit" class="btn btn-sm btn-outline-secondary"
                                            disabled>Delivered</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-outline-secondary"
                                            disabled>Cancelled</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                </table>
            </div>
        </main>
    </div>
</div>

{{-- @extends('layouts.mainAdmin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row-product">
                <h3>All Orders</h3>
            </div>
            <table class="table-product">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Order Number</th>
                        <th>Product</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
               <tbody>
                        @foreach ($deliveries as $delivery)
                            <tr>
                                <td>{{ $delivery->order->order_number }}</td>
                                <td>{{ $delivery->order->product->name }}</td>
                                <td>{{ $delivery->order->total }}</td>
                                <td>
                                    @if ($delivery->order->status == 'shipped')
                                        <form action="{{ route('delivery.update.status', $delivery->order_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('POST')
                                            <select name="status" id="status">
                                                <option value="shipped">Shipped</option>
                                                <option value="delivered">Delivered</option>
                                            </select>
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-secondary">update</button>
                                        </form>
                                    @elseif ($delivery->order->status == 'delivered')
                                        <button type="submit" class="btn btn-sm btn-outline-secondary"
                                            disabled>Delivered</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-outline-secondary"
                                            disabled>Cancelled</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection --}}

@extends('layouts.mainAdmin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row-product">
                <h3>Delivery data</h3>
                <div class="search-filter">
                    <div class="col">
                        <form action="{{ route('search.filter.delivery') }}" method="GET">
                            <div class="input-group mb-3">
                                <select name="filter" id="filter" class="form-select" aria-label="Default select example">
                                    <option value="all" selected>All</option>
                                    <option value="shipped">On delivery</option>
                                    <option value="delivered">Delivered</option>
                                </select>
                                <input type="text" class="form-control" placeholder="Search by delivery number"
                                    aria-label="Recipient's username" aria-describedby="button-addon2" name="search">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <table class="table-product">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Order Number</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deliveries as $delivery)
                    <tr>
                        <td>{{ $delivery->delivery_number }}</td>
                        <td>{{ $delivery->order->name }}</td>
                        <td>{{ $delivery->order->product->name }}</td>
                        <td>{{ $delivery->order->quantity }}</td>
                        <td>
                            @if ($delivery->order->status == 'shipped')
                                <form action="{{ route('delivery.update.status', $delivery->order_id) }}" class="flex"
                                    method="POST">
                                    @csrf
                                    @method('POST')
                                    <select name="status" class="form-select form-select" id="status">
                                        <option value="shipped">Shipped</option>
                                        <option value="delivered">Delivered</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">update</button>
                                </form>
                            @elseif ($delivery->order->status == 'delivered')
                                <button type="submit" class="btn btn-sm btn-outline-secondary" disabled>Delivered</button>
                            @else
                                <button type="submit" class="btn btn-sm btn-outline-secondary" disabled>Success</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection
