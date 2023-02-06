@extends('layouts.mainAdmin')
@include('layouts.navadmin')

<div class="container-fluid">
    <div class="row">
        {{-- include navbar --}}
        @include('layouts.dashboard')
        {{-- data cancellation --}}
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
                            {{-- confirmasi cacnellation atau menolak --}}
                            {{-- jika status pending maka muncul button --}}
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





