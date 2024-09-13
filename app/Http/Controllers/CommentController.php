<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'comment' => 'required|string',
        ]);

        if (!Auth::check()) {
            return redirect()->back()->withErrors(['error' => 'User is not logged in']);
        }
        $userName = Auth::user()->username;

        // Simpan komentar ke database
        Comment::create([
            'property_id' => $request->property_id,
            'user_name' => $userName, // Nama diambil dari user yang sedang login
            'comment' => $request->comment,
        ]);

        // Redirect kembali ke halaman properti
        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
