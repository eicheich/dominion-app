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

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //         'phone' => 'required',
    //         'address' => 'required',
    //     ]);

    //     $user = auth()->user();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->phone = $request->phone;
    //     $user->address = $request->address;
    //     $user->save();

    //     return redirect()->route('profile')->with('success', 'Profile updated successfully');
    // }

}