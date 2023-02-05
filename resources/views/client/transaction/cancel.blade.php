@extends('layouts.main')

@section('content')
    {{-- form cancellaion yang berisi input reaason --}}
    <form action="{{ route('orders.cancellation', $order->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" readonly value="{{ $order->name }}">
        </div>
        <div class="form-group">
            <label for="name">Item</label>
            <input type="text" name="name" id="name" class="form-control" readonly
                value="{{ $order->product->name }}">
        </div>
        {{-- image dari order --}}
        <label class="mt-3" for="image">Image</label>

        <div class="form-group">
            <img src="{{ asset('storage/images/products/' . $order->product->image) }}" alt="" width="100">
        </div>

        <div class="form-group mt-5">
            <label for="address">Reason for cancellation</label>
            <textarea name="reason" id="reason" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group pt-4">
            <button type="submit" class="btn btn-danger">Submit</button>
        </div>
    </form>
@endsection
