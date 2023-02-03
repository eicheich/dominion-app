<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login',
    [
        'title' => 'Login',
    ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('landingpage');
        } else {
            return redirect()->route('login')->with('error', 'Username or Password is Wrong');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


}