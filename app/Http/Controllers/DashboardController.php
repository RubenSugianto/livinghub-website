<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this import
use App\Models\Property;

class DashboardController extends Controller
{
    public function showMyProperty()
    {
        $user = Auth::user(); 
        $properties = Property::with('images')->where('user_id', $user->id)->paginate(20); 
        $title = 'My Properties';

        return view('dashboard.myproperties', compact('properties', 'title'));
    }
}
