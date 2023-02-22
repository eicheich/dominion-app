@extends('layouts.mainAdmin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row-product">
                <h3>Order data</h3>
                <div class="search-filter">
                    <div class="col">
                        <form action="{{ route('search.order') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search by order number"
                                    aria-label="Recipient's username" aria-describedby="button-addon2" name="search">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <table class="table-product height-admin">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order number</th>
                    <th>Name</th>
                    <th>Product</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $odr)
                    <tr>
                        <td>{{ $odr->id }}</td>
                        <td>{{ $odr->order_number }}</td>
                        <td>{{ $odr->user->name }}</td>
                        <td>{{ $odr->product->name }}</td>
                        <td>{{ $odr->status }}</td>
                        <td>{{ $odr->total }}</td>
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
