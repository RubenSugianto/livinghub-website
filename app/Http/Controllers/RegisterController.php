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
            'fullname' => 'required|max:255|unique:users',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
            'phone' => ['required', 'unique:users', 'regex:/^\d{12}$/'],
            'gender' => 'required',
            'age' => 'required|integer|min:0'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        // dd('registrasi berhasil');
        User::create($validatedData);

        // $request->session()->flash('success', 'Registration successful! Please login');

        return redirect('/login')->with('success', 'Registration successful! Please login');
    }
}
