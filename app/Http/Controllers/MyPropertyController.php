<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class MyPropertyController extends Controller
{
  
    public function index()
    {
        $user = auth()->user();
        $properties = Property::where('user_id', $user->id)->paginate(10);
        $title = "My Properties";
        return view('myproperties', compact('properties', 'title'));
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

        return view('myproperties', compact('properties', 'title'));
    }
}
