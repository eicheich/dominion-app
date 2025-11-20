<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('client.profile.index', compact('user'));
    }

    public function edit()
    {
        return view('client.profile-edit');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Check if the user is authorized to update this profile
        if (Auth::id() !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:20|regex:/^([0-9\s\-\+\(\)]*)$/',
            'address' => 'nullable|string|max:500',
            'gender' => 'nullable|in:M,F',
            'dob' => 'nullable|date|before:today',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ];

        $messages = [
            'name.required' => 'Name is required.',
            'username.required' => 'Username is required.',
            'username.unique' => 'This username is already taken.',
            'username.alpha_dash' => 'Username may only contain letters, numbers, dashes and underscores.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'phone.regex' => 'Please enter a valid phone number.',
            'gender.in' => 'Please select a valid gender.',
            'dob.before' => 'Date of birth must be before today.',
            'avatar.image' => 'Avatar must be an image file.',
            'avatar.mimes' => 'Avatar must be a file of type: jpeg, png, jpg, gif.',
            'avatar.max' => 'Avatar may not be greater than 2MB.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];

        $request->validate($rules, $messages);

        try {
            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Delete the old avatar if it exists
                if ($user->avatar && Storage::disk('public')->exists('images/avatar/' . $user->avatar)) {
                    Storage::disk('public')->delete('images/avatar/' . $user->avatar);
                }

                // Upload the new avatar
                $file = $request->file('avatar');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('images/avatar', $filename, 'public');
                $user->avatar = $filename;
            }

            // Update user information
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->gender = $request->gender;

            // Handle date of birth
            if ($request->dob) {
                $user->dob = $request->dob;
            }

            // Update password if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while updating your profile. Please try again.');
        }
    }
}
