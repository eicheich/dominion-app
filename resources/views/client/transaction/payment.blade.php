{{-- @extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Payment</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pay', $order->order_number) }}" method="POST">
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
                                <input type="text" name="total" id="total" class="form-control" value="{{ $order->total }} " readonly>
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
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection --}}

@extends('layouts.main')

<div class="container">
    @section('content')
        <div class="flex-pay">
            <div class="block-1">
                <p class="text-dom-a3 ps-3">Shopping list</p>
                <a class="tnone" href="{{ route('client.product.show', $order->product->id) }}">
                    <div class="card-pay">
                        <div class="card-body-cart">
                            <div class="img-cart">
                                <img class="img-carts"
                                    src="{{ asset('storage/images/products/' . $order->product->image) }}">
                            </div>
                            <div class="qty-pay">
                                <h3 class="text-dom-a4">{{ $order->product->name }}</h3>
                                <h3 class="text-dom-a6">{{ $order->product->category->name }}</h3>
                                <div class="qty-pay gap flex">
                                    <h3 class="text-dom-a6">Blue</h3>
                                    <h3 class="text-dom-a6">Qty x{{ $order->quantity }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="qty-pay">
                            <h3 class="text-dom-a5">IDR. {{ number_format($order->product->price) }}</h3>
                        </div>
                    </div>
                </a>
                <hr class="text-dom-a3">

            </div>
            <div class="block-2">
                <div class="container-pay">
                    <p class="text-dom-a3 w-c">Summary</p>
                    <div class="subt">
                        <p class="text-dom-a5 w-c">Subtotal <i data-feather="help-circle"></i></p>
                        <p class="text-dom-a5 w-c">IDR. {{ number_format($order->product->price) }}</p>
                    </div>
                    <div class="subt">
                        <p class="text-dom-a5 w-c">Estimated Delivery & Handling</p>
                        <p class="text-dom-a5 w-c">IDR. 0</p>
                    </div>
                    <div class="subt">
                        <p class="text-dom-a5 w-c">Taxes</p>
                        <p class="text-dom-a5 w-c">-</p>
                    </div>
                    <br>
                    <div class="subt">
                        <p class="text-dom-a5 w-c fw-600">TOTAL</p>
                        <p class="text-dom-a5 w-c fw-600">IDR. {{ number_format($order->total) }}</p>
                    </div>
                    <div>
                        <button id="pay-button" class="btnt b-w">Pay now</button>
                    </div>
                    <div>
                        <button class="btnt b-b" disabled>COD</button>
                    </div>

                </div>

            </div>

        </div>

    </div>

    </div>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    // go to detail transaction
                    alert("payment success!");
                    window.location.href = '../order/detail/{{$order->id}}'
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
@endsection
