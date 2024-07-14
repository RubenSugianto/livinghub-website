<?php
// app/Http/Controllers/PropertyController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Document;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        return view('home', compact('properties'));
    }

    public function show(Property $property)
    {
        $propertyImages = PropertyImage::where('property_id', $property->id)->get();

        return view('property', compact('property', 'propertyImages'));
    }

    public function add()
    {
        return view('addproperty');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'bedroom' => 'required|integer',
            'bathroom' => 'required|integer',
            'electricity' => 'required|integer',
            'surfaceArea' => 'required|integer',
            'buildingArea' => 'required|integer',
            'status' => 'required|string',
            'typeProperty' => 'required|string',
            'typeDocument' => 'required|string',
            'published_at' => 'nullable|date',
            'images' => 'required|array|max:10',
            'images.*' => 'required|image|mimes:png,jpg,jpeg,webp'
        ]);

        $property = new Property();
        $property->id = (string) Str::uuid(); // Generate UUID for id field
        $property->user_id = auth()->id();
        $property->name = $request->name;
        $property->price = $request->price;
        $property->location = $request->location;
        $property->description = $request->description;
        $property->bedroom = $request->bedroom;
        $property->bathroom = $request->bathroom;
        $property->electricity = $request->electricity;
        $property->surfaceArea = $request->surfaceArea;
        $property->buildingArea = $request->buildingArea;
        $property->status = $request->status;
        $property->type = $request->typeProperty;
        $property->published_at = $request->published_at ?? now(); // Default to current timestamp if not provided

        $property->save();
        
        if($files = $request->file('images')) {
            foreach($files as $key => $file) {
                $extension = $file ->getClientOriginalExtension();
                $filename = $key. '-' .time(). '.'. $extension;

                $path = 'uploads/properties/';

                $file->move($path,$filename);

                PropertyImage::create([
                    'property_id' => $property->id,
                    'user_id' => auth()->id(),
                    'images' => $path . $filename,
                ]);
            }
        }

        Document::create([
            'property_id' => $property->id,
            'user_id' => auth()->id(),
            'type' => $request->typeDocument,
            'status' => 'Not Uploaded'
        ]);
        

        return redirect()->route('home')->with('success', 'Property added successfully.');
    }

    public function edit(Property $property)
    {
        return view('property.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'bedroom' => 'required|integer',
            'bathroom' => 'required|integer',
            'electricity' => 'required|integer',
            'surfaceArea' => 'required|integer',
            'buildingArea' => 'required|integer',
            'status' => 'required|string',
            'type' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        $property->update($request->all());

        return redirect()->route('home')->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('home')->with('success', 'Property deleted successfully.');
    }
    public function search(Request $request)
    {
        $query = Property::query();
    
        // Filter based on various fields
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('location', 'LIKE', "%{$search}%")
                      ->orWhere('description', 'LIKE', "%{$search}%")
                      ->orWhere('price', 'LIKE', "%{$search}%")
                      ->orWhere('status', 'LIKE', "%{$search}%")
                      ->orWhere('type', 'LIKE', "%{$search}%");
            });
        }
    
        // Additional filters based on individual fields
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
        
        if ($request->has('kota')) {
            $kota = $request->input('kota');
            $query->where('location', 'LIKE', "%{$kota}%");
        }
        
        $properties = $query->paginate(2); // Paginate with 10 items per page
    
        return view('search-results', compact('properties'));
    }
    
}    
