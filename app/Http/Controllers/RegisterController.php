<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'username' => ['required', 'min:3', 'max:255', 'regex:/^[a-zA-Z0-9_\-]+$/', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:8', 'max:255', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'],
            'phone' => ['required', 'unique:users', 'regex:/^\d{12}$/'],
            'gender' => ['required'],
            'age' => ['required', 'integer', 'min:18', 'max:100']
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        Auth::login($user);

        event(new Registered($user));

        return redirect()->route('verification.notice')
                         ->with('message', 'Registrasi berhasil! Tolong verifikasi email anda.');
    }

    public function verifypage()
    {
        return view('auth.verify-email');
    }

    public function verifyrequest(EmailVerificationRequest $request)
    {
        $request->fulfill();  // This marks the user's email as verified
        return redirect('/');  // Redirect the user after successful verification
    }

    public function resendlink(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();  // Resend the verification email
        return back()->with('message', 'Link Verifikasi telah dikirim!');
    }
}
