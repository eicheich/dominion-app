@extends('layouts.main')

@section('content')
{{-- session message --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

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
                    <th scope="col">Image</th>
                    <th scope="col">Total</th>
                    <th scope="col">status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $order->product->name }}</td>
                        <td><img src="{{ asset('storage/images/products/' . $order->product->image) }}" alt="product-image"
                                width="100"></td>
                        <td>{{ $order->total }}</td>
                        @if ($order->status == 'pending')
                            <td class="text-warning fw-bold">{{ $order->status }}</td>
                        @elseif ($order->status == 'success')
                            <td class="text-success fw-bold">{{ $order->status }}</td>
                        @elseif ($order->status == 'payment confirmed')
                            <td class="text-success fw-bold">{{ $order->status }}</td>
                        @else
                            <td class="text-danger fw-bold">{{ $order->status }}</td>
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
