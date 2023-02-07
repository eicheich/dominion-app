@extends('layouts.main')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- avatar --}}
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <img src="{{ $user->avatar ? asset('storage/images/avatar/'.$user->avatar) : asset('storage/images/avatar/defaultProfile.png') }}"
                alt="avatar" width="100px" height="100px">
            <br>
            <input type="file" name="avatar" id="avatar" class="form-control">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
        </div>
        {{-- username --}}
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}">
        </div>
        <label for="form-check">Gender</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Totebag Mekidi
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" value="M" name="flexRadioDefault" id="flexRadioDefault2"
                checked>
            <label class="form-check-label" for="flexRadioDefault2">
                Male
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" value="F" name="flexRadioDefault" id="flexRadioDefault2"
                checked>
            <label class="form-check-label" for="flexRadioDefault2">
                Female
            </label>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Password Confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
    {{-- logout --}}
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    @endsection
