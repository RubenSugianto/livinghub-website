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
            'name' => ['required', 'min:8', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'username' => ['required', 'min:3', 'max:255', 'regex:/^[a-zA-Z0-9_\-]+$/', 'unique:users,username,' . $user->id],
            'email' => ['required', 'email:dns', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'max:20', 'regex:/^\d{12}$/', 'unique:users,phone,' . $user->id],
            'gender' => ['required', 'string', 'max:10'],
            'age' => ['required', 'integer', 'min:18', 'max:100'],
            'profilepicture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
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
                Storage::delete('public/users-avatar/' . $user->avatar);
            }
            $user->avatar = null;
        } else if ($request->hasFile('profilepicture')) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::exists('public/users-avatar/' . $user->avatar)) {
                Storage::delete('public/users-avatar/' . $user->avatar);
            }
    
            // Store the new avatar
            $avatarPath = $request->file('profilepicture')->store('users-avatar', 'public');
            $user->avatar = basename($avatarPath); 
        }
    
        $user->save();
    
        return redirect()->route('home')->with('success', 'Profil berhasil diperbarui.',);
    }

    public function destroy()
    {
        $user = Auth::user();

        $properties = $user->properties()->with('propertyImages', 'document')->get();

        if (!$properties->isEmpty()) {
            foreach ($properties as $property) {
                $property->propertyImages()->delete();
                $property->document()->delete();
            }
            $user->properties()->delete();
        }

        if ($user->avatar && Storage::exists('public/users-avatar/' . $user->avatar)) {
            Storage::delete('public/users-avatar/' . $user->avatar);
        }

        Auth::logout();

        $user->delete();

        return redirect()->route('home')->with('success', 'Profil berhasil dihapus.');
    }

}
