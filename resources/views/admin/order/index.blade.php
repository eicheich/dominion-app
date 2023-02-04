@extends('layouts.mainAdmin')
@include('layouts.navadmin')

<div class="container-fluid">
  <div class="row">
    {{-- include navbar --}}
    @include('layouts.dashboard')
    {{-- table --}}
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard Admin</h1>
        <h2>Order</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a href="{{ route('orders.create') }}" class="btn btn-sm btn-outline-secondary">tambah order</a>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th class="fs-5">Image</th>
              <th class="fs-5">Product</th>
              <th class="fs-5">Customer</th>
              <th class="fs-5">Quantity</th>
              <th class="fs-5">Status</th>
              <th class="fs-5">Subtotal</th>
              <th class="fs-5">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
            <tr>
              <td>{{ $loop->iteration }}</td>
                <td><img src="{{ asset('storage/images/products/'.$order->product->image) }}" alt="" width="100px"></td>
              <td class="fs-5">{{ $order->product->name }}</td>
              <td class="fs-5">{{ $order->user->name }}</td>
              <td class="fs-5">{{ $order->quantity }}</td>
              <td class="fs-5">{{ $order->status }}</td>
              <td class="fs-5   ">{{ $order->total }}</td>
              <td>
            {{-- button view --}}
            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-m btn-outline-danger">view</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </main>
    </div>

    </div>
</div>

