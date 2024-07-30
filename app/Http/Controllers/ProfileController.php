<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Auth::user();
        return view('lihatprofile', compact('profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'gender' => 'required|string|max:10',
            'age' => 'required|integer|min:0',
            'profilepicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->fullname = $request->input('fullname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->age = $request->input('age');

        // Handle image upload
        if ($request->hasFile('profilepicture')) {
            // Delete old image if exists
            if ($user->profilepicture && Storage::exists($user->profilepicture)) {
                Storage::delete($user->profilepicture);
            }

            // Store the new image
            $imagePath = $request->file('profilepicture')->store('profile_pictures', 'public');
            $user->profilepicture = $imagePath;
        }

        $user->save();

        return redirect()->route('home')->with('success', 'Profile updated successfully.');
    }
}

