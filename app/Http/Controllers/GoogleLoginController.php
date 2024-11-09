<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleLoginController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle() {
        try {
            $google_user = Socialite::driver('google')->user();

            $user = User::where('google_id', $google_user->getId())->first();

            if (!$user) {
                // Check if a user exists with the same email as Google account
                $user = User::where('email', $google_user->getEmail())->first();
    
                if ($user) {
                    // If user exists, link the Google ID to the existing account
                    $user->google_id = $google_user->getId();
                    $user->save();
                } else {
                    // If no user exists, create a new user with Google details
                    $user = User::create([
                        'name' => $google_user->getName(),
                        'email' => $google_user->getEmail(),
                        'google_id' => $google_user->getId(),
                        'username' => strtolower(str_replace(' ', '', $google_user->getName())) . '-' . uniqid(),
                    ]);
                }
            }

            Auth::login($user);
            return redirect()->to('/');

            // if (!$user) {
            //     $new_user = User::create([
            //         'name' => $google_user->getName(),
            //         'email' => $google_user->getEmail(),
            //         'google_id' => $google_user->getId(),
            //         'username' => strtolower(str_replace(' ', '', $google_user->getName())) . '-' . uniqid(),
            //     ]);

            //     Auth::login($new_user);

            //     return redirect()->to('/');

            // } else {
            //     Auth::login($user);
            //     return redirect()->to('/');
            // }
        } catch (\Throwable $th) {
            dd('Ada yang salah!'. $th->getMessage());
        }
    }
}
