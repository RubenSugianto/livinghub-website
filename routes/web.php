<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DijualController;
use App\Http\Controllers\DisewaController;
use App\Http\Controllers\SimulasikprController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PropertyController;
// web.php
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/property/{property}', [PropertyController::class, 'show'])->name('property.show');

// Other Routes
Route::get('/dijual', [DijualController::class, 'index'])->name('dijual');
Route::get('/disewa', [DisewaController::class, 'index'])->name('disewa');
Route::get('/simulasikpr', [SimulasikprController::class, 'index'])->name('simulasikpr');
Route::post('/simulasikpr/calculate', [SimulasikprController::class, 'calculate'])->name('simulasikpr.calculate');

// Auth Routes
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store'])->middleware('guest');
Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout']);
Route::get('/lihatprofile', [App\Http\Controllers\ProfileController::class, 'index'])->name('lihatprofile');

// Like Property
Route::post('/like/{property}', [LikeController::class, 'toggleLike'])->name('property.like')->middleware('auth');
