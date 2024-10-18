<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class MyPropertyController extends Controller
{
    // Display the list of properties owned by the logged-in user
    public function index()
    {
        $user = auth()->user();
        $properties = Property::where('user_id', $user->id)->with('document')->paginate(10);
        $title = "My Properties";
        return view('myproperties', compact('properties', 'title'));
    }

    // Search function with multiple filters
    public function search(Request $request)
    {
        $user = auth()->user();
        $query = Property::where('user_id', $user->id)->with('user'); // Ensure related user is loaded

        // Search by keyword (name, location, description, etc.)
        if ($request->has('search')) {
            $searchKeyword = $request->input('search');
            $query->where(function ($query) use ($searchKeyword) {
                // Filter properties based on various fields
                $query->where('name', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('location', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('description', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('price', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('status', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('type', 'LIKE', '%' . $searchKeyword . '%');
        
                // Join with the documents table to filter based on document type
                $query->orWhereHas('documents', function ($query) use ($searchKeyword) {
                    $query->where('type', 'LIKE', '%' . $searchKeyword . '%');
                });
            });
        }
        

        // Filter by status
        if ($request->has('status') && $request->input('status') != '') {
            $query->where('status', $request->input('status'));
        }

        // Filter by bedrooms
        if ($request->has('bedrooms') && $request->input('bedrooms') != '') {
            switch ($request->input('bedrooms')) {
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
        if ($request->has('bathrooms') && $request->input('bathrooms') != '') {
            switch ($request->input('bathrooms')) {
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
        if ($request->has('land_size_min') || $request->has('land_size_max')) {
            $landSizeMin = $request->input('land_size_min', 0);
            $landSizeMax = $request->input('land_size_max', PHP_INT_MAX);
            $query->whereBetween('surfaceArea', [$landSizeMin, $landSizeMax]);
        }

        // Filter by building size
        if ($request->has('building_size_min') || $request->has('building_size_max')) {
            $buildingSizeMin = $request->input('building_size_min', 0);
            $buildingSizeMax = $request->input('building_size_max', PHP_INT_MAX);
            $query->whereBetween('buildingArea', [$buildingSizeMin, $buildingSizeMax]);
        }

        // Filter by property type
        if ($request->has('property_type') && $request->input('property_type') != '') {
            $query->where('type', $request->input('property_type'));
        }

        // Filter by city (kota)
        if ($request->has('kota') && $request->input('kota') != '') {
            $query->where('location', 'LIKE', '%' . $request->input('kota') . '%');
        }
        
        if ($request->has('certificate') && $request->input('certificate') != '') {
            $certificateType = $request->input('certificate');
            $query->whereHas('documents', function ($query) use ($certificateType) {
                $query->where('type', $certificateType);
            });
        }
        // Execute the filtered query and paginate results
        $properties = $query->paginate(10);
        $title = "My Properties";
        return view('myproperties', compact('properties', 'title'));
        
        
    }
}
