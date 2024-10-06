<?php

namespace App\Http\Controllers;

use App\Models\User;  
use App\Models\Property; 
use Illuminate\Http\Request;

class showSellerProfileController extends Controller
{
    public function showSellerProfile(Request $request, $id)
    {

        $seller = User::findOrFail($id);

        $searchKeyword = $request->input('search');

        $query = Property::where('user_id', $id);

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

        if ($request->has('status') && $request->input('status') != '') {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        if ($request->has('bedrooms') && $request->input('bedrooms') != '') {
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

        if ($request->has('bathrooms') && $request->input('bathrooms') != '') {
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

        if (($request->has('land_size_min') && $request->input('land_size_min') != '') || ($request->has('land_size_max') && $request->input('land_size_max') != '')) {
            $landSizeMin = $request->input('land_size_min', 0);
            $landSizeMax = $request->input('land_size_max', PHP_INT_MAX);
            $query->whereBetween('surfaceArea', [$landSizeMin, $landSizeMax]);
        }

        if (($request->has('building_size_min') && $request->input('building_size_min') != '') || ($request->has('building_size_max') && $request->input('building_size_max') != '')) {
            $buildingSizeMin = $request->input('building_size_min', 0);
            $buildingSizeMax = $request->input('building_size_max', PHP_INT_MAX);
            $query->whereBetween('buildingArea', [$buildingSizeMin, $buildingSizeMax]);
        }

        if ($request->has('property_type') && $request->input('property_type') != '') {
            $propertyType = $request->input('property_type');
            $query->where('type', $propertyType);
        }
        
        if ($request->has('kota') && $request->input('kota') != '') {
            $kota = $request->input('kota');
            $query->where('location', 'LIKE', '%' . $kota . '%');
        }

        $properties = $query->with('images')->paginate(20);

        return view('profile.sellerprofile', [
            'seller' => $seller,
            'properties' => $properties,
            'searchKeyword' => $searchKeyword 
        ]);
    }
}

