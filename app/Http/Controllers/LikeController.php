<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function toggleLike(Request $request, $propertyId)
    {
        $property = Property::find($propertyId);

        if (!$property) {
            return response()->json(['status' => 'error', 'message' => 'Property not found'], 404);
        }

        $user = Auth::user();

        if ($property->isLikedBy($user)) {
            $property->likedByUsers()->detach($user);
            $status = 'unliked';
        } else {
            $property->likedByUsers()->attach($user);
            $status = 'liked';
        }

        return response()->json([
            'status' => $status,
            'likes_count' => $property->likedByUsers()->count()
        ]);
    }
}
