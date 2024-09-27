<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Make sure to import Auth
use App\Models\Property; // Ensure to import the Property model

class LikesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $likes = $user->likes()->paginate(10); // Changed from $favorites to $likes

        return view('likes', compact('likes')); // Using 'likes' here
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $property = Property::findOrFail($id);
        
        $user->likes()->detach($property); // Ensure you are detaching from 'likes'

        return redirect()->route('likes')->with('success', 'Property removed from likes.');
    }
}
