<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return view('user.show', ['user' => $user]);
    }

    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required',
        ]);
        $data = [];
        // Delete previous photo and update it
        if ($request->hasFile('profile_photo')) {
            Storage::disk('public')->delete(Auth::user()->profile_photo);
            $data['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
        }
        Auth::user()->update($data);
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'location' => 'nullable',
            'phone_no' => 'nullable',
            'bio' => 'nullable',
        ]);

        Auth::user()->update($validatedData);
    }
}
