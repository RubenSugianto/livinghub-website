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
}
