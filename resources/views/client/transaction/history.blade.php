@extends('layouts.main')

@section('content')

@if (count($orders) == 0)
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>History</h3>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">You don't have any transaction</h3>
                        {{-- button buy products --}}
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('landingpage') }}" class="btn btn-primary">Buy Products</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
            <th scope="col">status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $order->name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->total }}</td>
                @if ($order->status == 'pending')
                    <td class="text-warning bold">{{ $order->status }}</td>
                @elseif ($order->status == 'success')
                    <td class="text-success">{{ $order->status }}</td>
                @else
                    <td class="text-danger">{{ $order->status }}</td>
                @endif
                <td>
                    <a href="{{ route('detail', $order->id) }}" class="btn btn-primary">View</a>
                </td>
            </tr>

        @endforeach
    </tbody>

</table>
@endif

@endsection
