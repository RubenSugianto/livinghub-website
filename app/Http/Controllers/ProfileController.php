<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Property;

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
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'gender' => 'required|string|max:10',
            'age' => 'required|integer|min:0',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Change to 'avatar'
        ]);
    
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->age = $request->input('age');

        // Handle avatar removal
        if ($request->input('remove_picture') == '1') {
            if ($user->avatar && Storage::exists('public/users-avatar/' . $user->avatar)) {
                Storage::delete('public/users_avatar/' . $user->avatar);
            }
            $user->avatar = null;
        } else if ($request->hasFile('profilepicture')) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::exists('public/users-avatar/' . $user->avatar)) {
                Storage::delete('public/users-avatar/' . $user->avatar);
            }
    
            // Store the new avatar
            $avatarPath = $request->file('profilepicture')->store('users-avatar', 'public');
            $user->avatar = basename($avatarPath); // Store only the file name
        }
    
        $user->save();
    
        return response()->json([
            'success' => 'Profile updated successfully.',
            'profilepicture' => $user->avatar ? asset('storage/users-avatar/' . $user->avatar) : asset('defaultprofilepicture.png')
        ]);
    }

}
