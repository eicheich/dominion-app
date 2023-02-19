@extends('layouts.main')

<div class="container">
    @section('content')
        <p class="text-dom-a3 text-center">
            Rate Product
        </p>
        <div class="p-5">
            <a class="tnone" href="{{ route('client.product.show', $order->product->id) }}">
                <div class="card-pay">
                    <div class="card-body-cart">
                        <div class="img-cart">
                            <img class="img-carts" src="{{ asset('storage/images/products/' . $order->product->image) }}">
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
            <div class="flex-r">
                <table class="table table-borderless ">
                    <tbody>

                        <tr>
                            <th class="d-text">Subtotal</th>
                            <td class="d-text-2 text-end">IDR. {{ number_format($order->total) }}</td>
                        </tr>
                        <tr>
                            <th class="d-text">Status</th>
                            <td class="d-text-2 text-end">{{ $order->status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <form action="{{route('confirm.orders', $order->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="text-center">
                    <div id="rating">
                        <i class="fa fa-star" data-index="0"></i>
                        <i class="fa fa-star" data-index="1"></i>
                        <i class="fa fa-star" data-index="2"></i>
                        <i class="fa fa-star" data-index="3"></i>
                        <i class="fa fa-star" data-index="4"></i>
                    </div>
                    <script>
                        const rating = document.getElementById("rating");
                        const stars = rating.getElementsByClassName("fa-star");

                        for (let i = 0; i < stars.length; i++) {
                            stars[i].addEventListener("click", function() {
                                setRating(i);
                                setRatingValue(i);
                            });
                        }

                        function setRating(index) {
                            for (let i = 0; i < stars.length; i++) {
                                if (i <= index) {
                                    stars[i].classList.add("checked");
                                } else {
                                    stars[i].classList.remove("checked");
                                }
                            }
                        }
                        // function untuk memberi value pada bintang yang di klik
                        function setRatingValue(index) {
                            document.getElementById("rate").value = index + 1;
                        }
                    </script>
                </div>
                <input type="hidden" name="rate" id="rate" value="">
                <div class="text-center">

                    <div class="form-group mt-4">
                        <label class="text-dom-a4" for="comment">Wdyt? About this product</label>
                        <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="center">
                        <button type="submit" class="btn-c mt-4 ">Submit</button>
                    </div>
            </form>
        </div>
    </div>
    </div>
    </div>
@endsection
