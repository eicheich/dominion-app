@extends('layouts.main')

<div class="container">
    @section('content')
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-md-6">
                <img class="img-detail" src="{{ asset('storage/images/products/' . $product->image) }}"
                    alt="{{ $product->name }}">
            </div>
            <div class="col-md-6 ">
                <h1 class="text-dom-span">{{ $product->category->name }}</h1>
                <h1 class="text-dom-a3">{{ $product->name }}</h1>
                <p class="text-dom-a4">IDR. {{ number_format($product->price) }}</p>
                {{-- make a line with grey color --}}
                <hr class="text-dom-a3">
                <p class="text-dom-a4">Color :</p>
                <div class="color-img">
                    <img class="color-item" src="{{ asset('images/assets/null photo.png') }}" alt="">
                    <img class="color-item border" src="{{ asset('storage/images/products/' . $product->image) }}"
                        alt="">
                    <img class="color-item" src="{{ asset('images/assets/null photo.png') }}" alt="">
                    <img class="color-item" src="{{ asset('images/assets/null photo.png') }}" alt="">
                </div>
                <p class="text-dom-a4">Size :</p>
                <div class="flex gap">
                    <div class="size-box">
                        <a class="size-item text-dom-a4" href="#">S</a>
                    </div>
                    <div class="size-box">
                        <a class="size-item text-dom-a4" href="#">M</a>
                    </div>
                    <div class="size-box">
                        <a class="size-item text-dom-a4" href="#">L</a>
                    </div>
                    <div class="size-box">
                        <a class="size-item text-dom-a4" href="#">XL</a>
                    </div>
                </div>


                <div class="button-group">
                    <form action="#" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <button class="heart" type="submit"><i data-feather="heart"></i></button>
                    </form>
                    <form class="add-cart" action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="size" value="M">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-add-cart">Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col mt-5">
            <div class="desc">
                <p class="text-dom-a3">Description</p>
                <p class="text-dom-a5">{{ $product->description }}</p>
            </div>
            <div class="desc">
                <p class="text-dom-a3">Technical feature</p>
                <p class="text-dom-a5 ">
                    - Japanese PU <br>
                    - 3 layers of natural foam <br>
                    - Attached thumb: better protection against injuries <br>
                    - Anatomical shape / Grip <br>
                    - Optimized metacarpal protection <br>
                    - Reinforced seams: durability <br>
                    - Wide Velcro closure: precise hold and fit <br>
                    - Long cuff: protection and stability of the wrist <br>
                    - Embossed Venum 3D logo <br>
                    - Fully assembled and hand-stitched in Thailand <br>
                </p>
            </div>
            <br>
            <br>
            @if (count($rate) == 0)
            <div class="text-dom-a3 text-center">No Ratings</div>
            @else
                <div class="flex-rate">
                    <div class="row-1">
                        <p class="text-dom-a3">Product Reviews</p>
                        <i class="fas fa-star"></i>
                        <p class="rateInt">{{ $rateStar }}<span>/ 5</span></p>
                        <br>
                    </div>
                    <div class="row-2">
                        <p class="text-dom-a3">Featured Reviews</p>
                        <p class="text-dom-a4 c-gray">Showing 5 Of 45 Reviews</p>
                        @foreach ($rate as $rt)
                            <div class="card-p">
                                <div class="flex gap">
                                    <i class="fas fa-user-circle"></i>
                                    <p class="text-dom-a4">{{ $rt->user->name }}</p>
                                </div>
                                <div class="flex-rx">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $rt->rate)
                                            <i class="fas fa-star" style="color: #FFC107"></i>
                                        @else
                                            <i class="fas fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <p class="text-dom-a4">{{ $rt->comment }}</p>
                                <hr class="text-dom-a3">
                                <br>
                            </div>
                        @endforeach
                    </div>
                    <div class="row-3">
                        <p></p>
                    </div>
                </div>
            @endif

        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    @endsection
