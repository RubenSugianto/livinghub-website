<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function addToFavourites(Request $request)
    {
        $user_id = $request->input('user_id');
        $item_id = $request->input('item_id');


        return response()->json(['message' => 'Item added to favourites successfully']);
    }

    public function removeFromFavourites($item)
    {
        $user_id = auth()->id();


        return response()->json(['message' => 'Item removed from favourites successfully']);
    }
}
