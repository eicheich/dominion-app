<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // get user by id and pass to view
        $user = auth()->user();
        return view('client.profile.index', [
            'user' => $user
        ]);
    }

    public function edit()
    {
        return view('client.profile-edit');
    }

    // update user profile
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'required',
        ]);

        $user = auth()->user();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->avatar = $request->avatar;
        $user->gender = $request->gender;
    }


}