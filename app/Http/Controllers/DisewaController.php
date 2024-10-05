<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property; 

class DisewaController extends Controller
{
    
    public function index()
    {
       
        $properties = Property::where('status', 'Disewa')->paginate(10); 
        
        
        return view('disewa', compact('properties'));
    }
}
