<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property; 

class DijualController extends Controller
{
    public function index()
    {
        $properties = Property::where('status', 'Disewa')
                          ->where('check', 'Approved')
                          ->with('document')
                          ->paginate(10);
        return view('dijual', compact('properties'));
    }
}
