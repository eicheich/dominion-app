@extends('layouts.main')



<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>

@section('content')

<div class="row row-cols-1 row-cols-md-6 g-4">
            @foreach ($products as $product)
            <div class="col">
            <div class="card">
                <img src="{{ asset('storage/images/products/'.$product->image) }}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                {{-- buat stock dan price dalam satu baris --}}
                <div class="row">
                    <div class="col">
                        <p class="card-text">Stock: {{ $product->stock }}</p>
                    </div>
                    <div class="col">
                        <p class="card-text">Price: {{ $product->price }}</p>
                    </div>
                </div>
                <a href="{{ route('client.product.show', $product->id) }}" class="btn btn-primary">View</a>
                </div>
            </div>
            </div>
            @endforeach




@endsection

