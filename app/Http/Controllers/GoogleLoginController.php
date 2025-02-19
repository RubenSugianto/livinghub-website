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
        return Socialite::driver('google')->redirect(); //utk munculin google login
    }

    public function callbackGoogle() {
        try {
            $google_user = Socialite::driver('google')->user();

            $user = User::where('google_id', $google_user->getId())->first();

            if (!$user) {
                // cek user udh pernah login pake akun googlenya blm
                $user = User::where('email', $google_user->getEmail())->first();
    
                if ($user) {
                    // kalau pernah terdaftar ambil google id nya
                    $user->google_id = $google_user->getId();
                    $user->save();
                } else {
                    // kl gk ada akun bikin akun baru
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

           
        } catch (\Throwable $th) {
            dd('Ada yang salah!'. $th->getMessage());
        }
    }
}
