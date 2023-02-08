@extends('layouts.mainAdmin')

@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="row-product">
                <h3>All Orders</h3>
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
    </div>
    </div>
@endsection
