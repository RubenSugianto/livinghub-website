<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    // Display user's favorite properties
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favorites()->paginate(10);

        return view('favorites', compact('favorites'));
    }

    // Remove a property from favorites
    public function destroy($id)
    {
        $user = Auth::user();
        $property = Property::findOrFail($id);
        
        $user->favorites()->detach($property);

        return redirect()->route('favorites')->with('success', 'Property removed from favorites.');
    }

    // Search in favorites
    public function search(Request $request)
    {
        $user = auth()->user();
        $query = $user->favorites(); 

        // Search keyword
        $searchKeyword = $request->input('search');
        if ($searchKeyword) {
            $query->where(function ($query) use ($searchKeyword) {
                $query->where('name', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('location', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('description', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('price', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('status', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('type', 'LIKE', '%' . $searchKeyword . '%');
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter by bedrooms
        if ($request->filled('bedrooms')) {
            $bedrooms = $request->input('bedrooms');
            switch ($bedrooms) {
                case '1 Kamar':
                    $query->where('bedroom', 1);
                    break;
                case '2 Kamar':
                    $query->where('bedroom', 2);
                    break;
                case '3 Kamar':
                    $query->where('bedroom', 3);
                    break;
                case '3+ Kamar':
                    $query->where('bedroom', '>=', 3);
                    break;
            }
        }

        // Filter by bathrooms
        if ($request->filled('bathrooms')) {
            $bathrooms = $request->input('bathrooms');
            switch ($bathrooms) {
                case '1 Kamar':
                    $query->where('bathroom', 1);
                    break;
                case '2 Kamar':
                    $query->where('bathroom', 2);
                    break;
                case '3 Kamar':
                    $query->where('bathroom', 3);
                    break;
                case '3+ Kamar':
                    $query->where('bathroom', '>=', 3);
                    break;
            }
        }

        // Filter by land size
        if (($request->filled('land_size_min') || $request->filled('land_size_max'))) {
            $landSizeMin = $request->input('land_size_min', 0);
            $landSizeMax = $request->input('land_size_max', PHP_INT_MAX);
            $query->whereBetween('surfaceArea', [$landSizeMin, $landSizeMax]);
        }

        // Filter by building size
        if (($request->filled('building_size_min') || $request->filled('building_size_max'))) {
            $buildingSizeMin = $request->input('building_size_min', 0);
            $buildingSizeMax = $request->input('building_size_max', PHP_INT_MAX);
            $query->whereBetween('buildingArea', [$buildingSizeMin, $buildingSizeMax]);
        }

        // Filter by property type
        if ($request->filled('property_type')) {
            $query->where('type', $request->input('property_type'));
        }

        // Filter by city
        if ($request->filled('kota')) {
            $kota = $request->input('kota');
            $query->where('location', 'LIKE', '%' . $kota . '%');
        }

        // Paginate the results (default to 10 per page)
        $favorites = $query->paginate(10);
        $title = "Favorite Properties";

        return view('favorites', compact('favorites', 'title'));
    }
}
