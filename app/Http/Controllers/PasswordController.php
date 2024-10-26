<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    
    public function forgotpassword() {
        return view('auth.forgotpassword');
    }

    public function verifyemail(Request $request) {
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function resetpassword(string $token) {
        return view('auth.resetpassword', ['token' => $token]);
    }

    public function verifypassword(Request $request) {
        // dd($request->all());
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email:dns'], 
            'password' => [
                'required',
                'min:8',
                'max:255',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('password_reset_success', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function changepassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => ['required', 'email:dns'],
            'old_password' => ['required'], 
            'password' => [
                'required',
                'min:8',
                'max:255',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Verify the old password
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password yang diinput salah.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect with a success message
        return redirect()->route('home')->with('success', 'Password changed successfully.');
    }
}
