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
    @foreach ($products as $product)
        <div class=" container py-5">
            <h4 class="mt-4 mb-5"><strong>Top Deals</strong></h4>
            <div class="row">
                <div class="col-lg-3 col-md-12 mb-4">
                    <a href="{{ route('client.product.show', $product->id) }}">
                    <div class="card" >
                        <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                            data-mdb-ripple-color="light">
                            <img src="{{ asset('storage/images/products/' . $product->image) }}" class="w-100" />
                            <a href="#!">
                                <div class="mask">
                                    <div class="d-flex justify-content-start align-items-end h-100">
                                        <h5><span class="badge bg-primary ms-2">New</span></h5>
                                    </div>
                                </div>
                                <div class="hover-overlay">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </div>
                            </a>
                        </div>
                        <div class="card-body">
                                <h5 class="card-title mb-3">{{ $product->name }}</h5>
                                <p>Category</p>
                            <h6 class="mb-3">$61.99</h6>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    @endforeach


    <div class="row row-cols-1 row-cols-md-6 g-4">
        <div class="col">
            <div class="card">
                <img src="{{ asset('storage/images/products/' . $product->image) }}" class="card-img-top" alt="...">
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
    @endsection
