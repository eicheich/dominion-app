{{-- masukan layouts.main --}}
@extends('layouts.main')

{{-- isi section content --}}
@section('content')
<form method="post" action="{{ route('register.store') }}">
    @csrf

    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text" class="form-control" name="name" required>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input id="username" type="text" class="form-control" name="username" required>
    </div>
    <div class="form-group">
        <label for="email">E-Mail Address</label>
        <input id="email" type="email" class="form-control" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" type="password" class="form-control" name="password" required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            Register
        </button>
    </div>
</form>


@endsection

