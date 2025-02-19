<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Property;

class LikesController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = $user->likes()->with('user'); 

        $searchKeyword = $request->input('search');

        if ($searchKeyword) {
            $query->where(function ($query) use ($searchKeyword) {
                $query->where('name', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('location', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('description', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('price', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('status', 'LIKE', '%' . $searchKeyword . '%')
                      ->orWhere('type', 'LIKE', '%' . $searchKeyword . '%');

                        $query->orWhereHas('documents', function ($query) use ($searchKeyword) {
                        $query->where('type', 'LIKE', '%' . $searchKeyword . '%');
                    });
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

        if ($request->has('certificate') && $request->input('certificate') != '') {
            $certificateType = $request->input('certificate');
            $query->whereHas('documents', function ($query) use ($certificateType) {
                $query->where('type', $certificateType);
            });
        }

        $likes = $query->paginate(10);

        return view('likes', compact('likes'));
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $property = Property::findOrFail($id);
        
        $user->likes()->detach($property);

        return redirect()->route('likes')->with('success', 'Properti dihapus dari suka.');
    }
}
