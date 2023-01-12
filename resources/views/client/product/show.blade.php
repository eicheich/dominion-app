@extends('layouts.main')



<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


{{-- detail product --}}
<div class="row">
    <div class="col-md-6">
        <img src="{{ asset('storage/images/products/'.$product->image) }}" class="card-img-top" alt="...">
    </div>
    <div class="col-md-6">
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->description }}</p>
        <p>Price: {{ $product->price }}</p>
        <p>Stock: {{ $product->stock }}</p>
    </div>

    {{-- quantity and size --}}
    {{-- kalau barang sudah ada update  --}}

    <div class="col-md-6">
        {{-- menambahkan product_id, user_id, size, quantity secara manual --}}
        <form action="{{ route('cart.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            {{-- {SIZE M, L ,XL --}}
            <div class="form-group">
                <label for="size">Size</label>
                <select class="form-control" name="size" id="size">
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>
            </div>
            {{-- drop down qty --}}
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <select class="form-control" name="quantity" id="quantity">
                    @for ($i = 1; $i <= $product->stock; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add to Cart</button>
        </form>
    </div>

</div>

    {{-- related product --}}


@endsection
