<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }

        if ($user->google_id != null && $user->password == null) {
            return back()->withErrors(['email' => 'Kamu mendaftar dengan Google. Silahkan log in menggunakan Google Account anda.']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Check if the logged-in user is an admin
            if ($user->role === 'admin') {
                return redirect()->intended('/adminproperty');  // Redirect to the admin dashboard
            }
 
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login Gagal!');

    }
}
