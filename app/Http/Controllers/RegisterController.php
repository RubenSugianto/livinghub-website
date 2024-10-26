<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255', 'regex:/^[a-zA-Z\s]+$/', 'unique:users'],
            'username' => ['required', 'min:3', 'max:255', 'regex:/^[a-zA-Z0-9_\-]+$/', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:8', 'max:255', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'],
            'phone' => ['required', 'unique:users', 'regex:/^\d{12}$/'],
            'gender' => ['required'],
            'age' => ['required', 'integer', 'min:18', 'max:100']
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        // dd('registrasi berhasil');
        User::create($validatedData);

        // $request->session()->flash('success', 'Registration successful! Please login');

        return redirect('/login')->with('success', 'Registration successful! Please login');
    }
}
