<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dijual', [App\Http\Controllers\DijualController::class, 'index'])->name('dijual');
Route::get('/disewa', [App\Http\Controllers\DisewaController::class, 'index'])->name('disewa');
Route::get('/simulasikpr', [App\Http\Controllers\DisewaController::class, 'index'])->name('simulasikpr');

Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index'])->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store']);

Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'authenticate']);