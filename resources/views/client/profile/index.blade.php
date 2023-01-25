@extends('layouts.main')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- {form edit profile --}}
    <form action="#" method="POST">
        @csrf
        @method('PUT')
        {{-- avatar --}}
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <img src="{{ asset('storage/images/products/' . $user->avatar) }}" class="card-img-top" alt="...">
            <input type="file" name="avatar" id="avatar" class="form-control">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
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
    @endsection
