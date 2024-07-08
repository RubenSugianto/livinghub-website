<?php
// app/Http/Controllers/PropertyController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
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
        return view('property', compact('property'));
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
            'type' => 'required|string',
            'published_at' => 'nullable|date',
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
        $property->type = $request->type;
        $property->published_at = $request->published_at ?? now(); // Default to current timestamp if not provided

        $property->save();

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
}
