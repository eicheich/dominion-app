@extends('layouts.mainAdmin')
{{-- @include('layouts.dashboard') --}}

@section('content')
    <div class="container-fluid">
        <div class="row">


            {{-- include navbar --}}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="container-fluid">

                <div class="info">
                    <!-- Column -->
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <div class="card bg-danger m-b-30">
                            <div class="card-body">
                                <div class="d-flex row">
                                    <div class="col-3 align-self-center">
                                        <div class="round">
                                            <i class="mdi mdi-google-physical-web"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 ml-auto align-self-center text-center">
                                        <div class="m-l-10 text-white float-right">
                                            <h5 class="mt-0 round-inner">18090</h5>
                                            <p class="mb-0 ">Visits Today</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card bg-info m-b-30">
                            <div class="card-body">
                                <div class="d-flex row">
                                    <div class="col-3 align-self-center">
                                        <div class="round">
                                            <i class="mdi mdi-account-multiple-plus"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 text-center ml-auto align-self-center">
                                        <div class="m-l-10 text-white float-right">
                                            <h5 class="mt-0 round-inner">{{$countUsers}}</h5>
                                            <p class="mb-0 ">New Users</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card bg-success m-b-30">
                            <div class="card-body">
                                <div class="d-flex row">
                                    <div class="col-3 align-self-center">
                                        <div class="round ">
                                            <i class="mdi mdi-basket"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 ml-auto align-self-center text-center">
                                        <div class="m-l-10 text-white float-right">
                                            <h5 class="mt-0 round-inner">{{ $countOrders }}</h5>
                                            <p class="mb-0 ">All Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card bg-primary m-b-30">
                            <div class="card-body">
                                <div class="d-flex row">
                                    <div class="col-3 align-self-center">
                                        <div class="round">
                                            <i class="mdi mdi-calculator"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 ml-auto align-self-center text-center">
                                        <div class="m-l-10 text-white float-right">
                                            <h5 class="mt-0 round-inner">{{$countProduct}}</h5>
                                            <p class="mb-0">Total Product</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            </div>

        </div>
        <div class="countainer">
            
        </div>
    @endsection
