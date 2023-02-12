<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index()
    {
        // get user by id and pass to view
        $category = Category::all();
        $user = auth()->user();
        return view('client.profile.index', [
            'category' => $category,
            'user' => $user
        ]);
    }

    public function edit()
    {
        return view('client.profile-edit');
    }

    // update user profile
    public function update(Request $request, $id)
    {
        $user = user::find($id);
        $request -> validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'image'
        ]);

        // check if image is uploaded
        if ($request->hasFile('image')) {
            Storage::delete('public/images/avatar/' . $user->image);
            $image = $request->file('image');
            $image = $image->hashName();
            $request->file('image')->storeAs('images/users', $image, 'public');
        } else {
            $image = $user->image;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $image
        ]);


    }


}
