<?php

use App\Http\Controllers\DijualController;
use App\Http\Controllers\DisewaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SimulasikprController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavouriteController;
use Illuminate\Support\Facades\Route;

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/property/{property}', [PropertyController::class, 'show'])->name('property.show');

// Other Routes
Route::get('/dijual', [DijualController::class, 'index'])->name('dijual');
Route::get('/disewa', [DisewaController::class, 'index'])->name('disewa');
Route::get('/simulasikpr', [SimulasikprController::class, 'index'])->name('simulasikpr');
Route::post('/simulasikpr/calculate', [SimulasikprController::class, 'calculate'])->name('simulasikpr.calculate');

// Auth Routes
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/lihatprofile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/lihatprofile', [ProfileController::class, 'update'])->name('profile.update');
});


// Add Property Routes
Route::get('/properties/add', [PropertyController::class, 'add'])->name('property.add')->middleware('auth');
Route::post('/properties', [PropertyController::class, 'store'])->name('property.store')->middleware('auth');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('property.show');
Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('property.edit')->middleware('auth');
Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('property.update')->middleware('auth');
Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('property.destroy')->middleware('auth');

// Search
Route::get('/search', [PropertyController::class, 'search'])->name('search');

// Dashboard
Route::get('/myproperties', [DashboardController::class, 'showMyProperty'])->middleware('auth');

//Favourite and likes
Route::middleware(['auth'])->group(function () {
    Route::post('/properties/{property}/favorite', [PropertyController::class, 'favorite'])->name('properties.favorite');
    Route::post('/properties/{property}/unfavorite', [PropertyController::class, 'unfavorite'])->name('properties.unfavorite');
    Route::post('/properties/{property}/like', [PropertyController::class, 'like'])->name('properties.like');
    Route::post('/properties/{property}/unlike', [PropertyController::class, 'unlike'])->name('properties.unlike');
    Route::get('/favorites', [PropertyController::class, 'favorites'])->name('properties.favorites');
    Route::get('/likes', [PropertyController::class, 'likes'])->name('properties.likes');
});
