<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'properties' => Property::all()
        ]);
    }
    public function show($id) {
        return view('property', [
            "property" => Property::findOrFail($id)
        ]);
    }
}
