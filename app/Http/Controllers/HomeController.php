<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $properties = Property::where('check', 'Approved')
                          ->with('images')
                          ->paginate(20);
        return view('home', compact('properties'));
    }
}
