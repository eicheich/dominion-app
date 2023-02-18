{{-- @extends('layouts.mainAdmin')
@include('layouts.navadmin')
<div class="container-fluid">
    <div class="row">
        @include('layouts.dashboard')
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Cancellation</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        This week
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cancellation number</th>
                            <th>Order number</th>
                            <th>Product name</th>
                            <th>Total price</th>
                            <th>Reason</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cancellations as $cancellation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cancellation->cancellation_number }}</td>
                            <td>{{ $cancellation->order->order_number }}</td>
                            <td>{{ $cancellation->order->product->name }}</td>
                            <td>{{ $cancellation->order->total }}</td>
                            <td>{{ $cancellation->reason }}</td>
                            <td>{{ $cancellation->order->name }}</td>
                            <td>{{ $cancellation->status }}</td>
                            @if ($cancellation->status == 'pending')
                            <td>
                                <form action="{{ route('admin.cancellations.approve', $cancellation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Confirm</button>
                                </form>
                                <form action="{{ route('admin.cancellations.reject', $cancellation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                </form>
                            </td>
                            @else
                            <td>
                                <button disabled>{{ $cancellation->status }}</button>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
 --}}

@extends('layouts.mainAdmin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row-product">
                <h3>Cancellation data</h3>
                <div class="search-filter">
                    <div class="col">
                        <form action="{{ route('search.filter.cancell') }}" method="GET">
                            <div class="input-group mb-3">
                                <select name="filter" id="filter" class="form-select" aria-label="Default select example">
                                    <option value="all" selected>All</option>
                                    <option value="rejected">Rejected</option>
                                    <option value="approved">Approved</option>
                                    <option value="pending">Pending</option>
                                </select>
                                <input type="text" class="form-control" placeholder="Search by cancellations number"
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
                    <th>#</th>
                    <th>Cancellation number</th>
                    <th>Product name</th>
                    <th>Total price</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cancellations as $cancellation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cancellation->cancellation_number }}</td>
                        <td>{{ $cancellation->order->product->name }}</td>
                        <td>{{ $cancellation->order->total }}</td>
                        <td class="max-width">{{ $cancellation->reason }}</td>
                        <td>{{ $cancellation->status }}</td>
                        @if ($cancellation->status == 'Pending')
                            <td>
                                <form action="{{ route('admin.cancellations.approve', $cancellation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="order_id" value="{{$cancellation->order->id }}">
                                    <button type="submit" class="btn-p">Confirm</button>
                                </form>
                                <form action="{{ route('admin.cancellations.reject', $cancellation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn-p">Reject</button>
                                </form>
                            </td>
                        @else
                            <td>
                                <button type="submit" class="btn btn-sm btn-outline-secondary"
                                    disabled>{{ $cancellation->order->status }}</button>

                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>




    </div>
    </div>
@endsection
