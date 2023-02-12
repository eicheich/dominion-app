@extends('layouts.mainAdmin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row-product">
                <h3>Order data</h3>
                {{-- <div class="search-filter">
                    <div class="col">
                        <form action="{{ route('search.filter.orders') }}" method="GET">
                            <div class="input-group mb-3">
                                <select name="filter" id="filter" class="form-select" aria-label="Default select example">
                                    <option value="all" selected>All</option>
                                    <option value="pending">Pending</option>
                                    <option value="payment confirmed">Payment confirmed</option>
                                    <option value="pending">Pending</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="success">Success</option>
                                    <option value="canceled">canceled</option>
                                </select>
                                <input type="text" class="form-control" placeholder="Search by cancellations number"
                                    aria-label="Recipient's username" aria-describedby="button-addon2" name="search">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                            </div>

                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
        <table class="table-product height-admin">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Product</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Ordered At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $odr)
                    <tr>
                        <td>{{ $odr->id }}</td>
                        <td>{{ $odr->user->name }}</td>
                        <td>{{ $odr->product->name }}</td>
                        <td>{{ $odr->status }}</td>
                        <td>{{ $odr->total }}</td>
                        <td>{{ $odr->created_at }}</td>
                        <td>
                            <a href="{{ route('orders.show', $odr->id) }}" class="btn-dom"><i data-feather="eye"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center pt-5">
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{ $orders->previousPageUrl() }}" class="btn btn-sm btn-outline-secondary">Previous</a>
                </div>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{ $orders->nextPageUrl() }}" class="btn btn-sm btn-outline-secondary">Next</a>
                </div>
            </div>
        </div>
    @endsection
