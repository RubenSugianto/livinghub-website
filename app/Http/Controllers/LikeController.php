<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Property $property)
    {
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
