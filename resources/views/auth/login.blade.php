{{-- masukan layouts.main --}}
@extends('layouts.main')

{{-- isi section content --}}
@section('content')
    <form method="post" action="{{ route('login.post') }}">
        @csrf
        <div class="form-group">
            <label for="username">Name</label>
            <input id="username" type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Login
            </button>
        </div>
    </form>
    <div class="form-group">
        <a href="{{ route('register') }}">Register</a>
    </div>
@endsection
