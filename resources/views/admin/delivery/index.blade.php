@extends('layouts.mainAdmin')
@include('layouts.navadmin')

<div class="container-fluid">
    <div class="row">
        {{-- include navbar --}}
        @include('layouts.dashboard')
        {{-- table --}}
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard Admin</h1>
                <h2>Data Delivery</h2>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        {{-- <a href="{{ route('deliveries.create') }}" class="btn btn-sm btn-outline-secondary">Add Delivery</a> --}}
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
                                    {{-- check jika status shipped maka ada form jika delivered maka disable  --}}
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
