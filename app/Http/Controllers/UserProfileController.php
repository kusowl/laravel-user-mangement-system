<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if ($search_key = $request->input('search_key')) {
            $query->where(function ($q) use ($search_key) {
                $q->where('name', 'like', "%{$search_key}%")
                    ->orWhere('email', 'like', "%{$search_key}%");
            });
        }

        if ($role = $request->input('role')) {
            $query->where('role', $role);
        }

        if ($sortBy = $request->input('sort')) {
            $query->orderBy($sortBy, 'asc');
        } else {
            $query->latest();
        }

        $users = $query->paginate('10');

        return view('user.index', compact('users'));
    }

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
            if (Auth::user()->profile_photo != '') {
                Storage::disk('public')->delete(Auth::user()->profile_photo);
            }
            $data['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
            Auth::user()->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Photo updated successfully!',
                'photo_url' => asset('storage/'.$data['profile_photo']),
            ]);
        }

        return response()->json([
            'sucess' => false,
            'message' => 'No Photo file found',
        ]);
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
        if (Auth::user()->update($validatedData)) {
            return response()->json([
                'success' => true,
                'message' => 'Profile Updated',
            ]);
        } else {
            return response()->json([
                'succcess' => false,
                'message' => 'Profile cannot be updated',
            ]);
        }
    }

    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
        ]);

        // Check if the current password is correct
        if (Hash::check($validatedData['current_password'], Auth::user()->password)) {
            Auth::user()->update([
                'password' => bcrypt($validatedData['new_password']),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password updated',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Current password is wrong',
        ]);
    }

    public function deactivate(Request $request, int $id)
    {
        $response = [];
        try {
            $user = User::findOrFail($id);
            $user->isActive = false;
            $response['success'] = $user->save();
            $response['success'] ? $response['message'] = 'User Deactivated' : 'Error while user deactivation';
            if (Gate::allows('activate', Auth::user())) {
                $response['canActivate'] = true;
                $response['url'] = route('user.activate', $user->id);
            }

            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function activate(Request $request, int $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->isActive = true;
            $response['success'] = $user->save();
            $response['success'] ? $response['message'] = 'User Activated' : 'Error while user Activation';
            if (Gate::allows('disable', Auth::user())) {
                $response['canDisable'] = true;
                $response['url'] = route('user.deactivate', $user->id);
            }

            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function delete(Request $request, int $id)
    {
        try {
            $user = User::findOrFail($id);
            ds($user);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User Deleted',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
