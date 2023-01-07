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
        // register dengan mengecek apakah email sudah ada atau belum dan confirm password
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        // cek email sudah ada atau belum
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return redirect()->route('register')->with('error', 'Email Already Exist');
        } else {
            // jika email belum ada maka akan di register
            $user = new User;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('login')->with('success', 'Register Success');
        }
    }
}