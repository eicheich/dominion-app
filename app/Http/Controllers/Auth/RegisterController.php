<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register',
    [
        'title' => 'Register',
    ]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->orWhere('username', $request->username)->first();
        if ($user) {
            return redirect()->back()->with('error', 'Email atau Username sudah terdaftar');
        } else{
            $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
            $user->save();
            return redirect()->route('login')->with('success', 'Register Success');
        }

    }
}