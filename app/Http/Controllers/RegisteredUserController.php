<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required',
            'password_confirmed' => 'required',
            'profile_photo' => 'required',
        ]);

        // Store the profile image
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            if ($path) {
                $validateData['profile_photo'] = $path;
            }
        }

        if (User::create($validateData)) {
            return to_route('home');
        }
    }

    public function create()
    {
        return view('register');
    }
}
