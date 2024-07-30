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

        return redirect()->route('favorites.index')->with('success', 'Property removed from favorites.');
    }
}
