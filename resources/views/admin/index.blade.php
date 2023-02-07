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
            @endsection

