@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Payment</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pay') }}" method="POST">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ Auth::user()->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{ Auth::user()->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="text" name="total" id="total" class="form-control" value="{{ $order->total }}">
                            </div>
                            <div class="form-group">
                                <label for="payment">Payment</label>
                                <select name="payment_by" id="payment_by" class="form-control">
                                    <option value="bank">BANK</option>
                                    <option value="ovo">OVO</option>
                                    <option value="gopay">GOPAY</option>
                                    <option value="dana">DANA</option>
                                </select>
                            </div>
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            {{-- hidden user_id --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
