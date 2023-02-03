@extends('layouts.main')



<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
    integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
</script>
<script src="dashboard.js"></script>

@section('content')

{{-- card product ke samping 5 dan seterusnya ke bawah --}}
<div class="row row-cols-1 row-cols-md-5 g-4 pt-5">
    @foreach ($products as $product)
        <div class="col">
            <div class="card">
                <a href="{{ route('client.product.show', $product->id) }}">
                <img src="{{ asset('storage/images/products/' . $product->image) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Stock: {{ $product->stock }}</p>
                    <p class="card-text">Price: ${{ $product->price }}</p>
                </div>
                </a>
            </div>
        </div>
    @endforeach

    @endsection
