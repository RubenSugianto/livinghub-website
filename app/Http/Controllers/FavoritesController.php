<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favorites()->paginate(10);

        return view('favorites', compact('favorites'));
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $property = Property::findOrFail($id);
        
        $user->favorites()->detach($property);

        return redirect()->route('favorites')->with('success', 'Property removed from favorites.');
    }

    public function search(Request $request)
    {
        $user = auth()->user();
        $query = Property::where('user_id', $user->id);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%")
                    ->orWhere('price', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%");
            });
        }

     
        $properties = $query->paginate(10);
        $title = "Search Results";

        return view('favorites', compact('properties', 'title'));
    }
}
