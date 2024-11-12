<?php

use App\Http\Controllers\DijualController;
use App\Http\Controllers\DisewaController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SimulasikprController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\MyPropertyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\showSellerProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasswordController;


use Illuminate\Support\Facades\Route;

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Other Routes
Route::get('/dijual', [DijualController::class, 'index'])->name('dijual');
Route::get('/disewa', [DisewaController::class, 'index'])->name('disewa');
Route::get('/simulasikpr', [SimulasikprController::class, 'index'])->name('simulasikpr');
Route::post('/simulasikpr/calculate', [SimulasikprController::class, 'calculate'])->name('simulasikpr.calculate');

// Show Property
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('property.show');

// Search
Route::get('/search', [PropertyController::class, 'search'])->name('search');

// Profile Seller
Route::get('/profileseller/{id}', [showSellerProfileController::class, 'showSellerProfile'])->name('profileseller');

// LogOut
Route::post('/logout', [LoginController::class, 'logout']);

// Auth::routes(['verify' => true]);

// Email Verification
Route::get('/email/verify', [RegisterController::class, 'verifypage'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'verifyrequest'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [RegisterController::class, 'resendlink'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['guest'])->group(function () {
    // Auth Routes
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/auth/google', [GoogleLoginController::class, 'redirect'])->name('google.login');
    Route::get('/auth/google/call-back', [GoogleLoginController::class, 'callbackGoogle']);

    // Reset Password
    Route::get('/forgot-password', [PasswordController::class, 'forgotpassword'])->name('password.request');
    Route::post('/forgot-password', [PasswordController::class, 'verifyemail'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordController::class, 'resetpassword'])->name('password.reset');
    Route::post('/reset-password', [PasswordController::class, 'verifypassword'])->name('password.update');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // profile page
    Route::get('/lihatprofile', [ProfileController::class, 'index'])->name('profile.index');
    Route::delete('/lihatprofile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/lihatprofile/updateprofile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/lihatprofile/updatepassword', [PasswordController::class, 'changepassword'])->name('password.change');
    Route::put('/lihatprofile/setpassword', [PasswordController::class, 'setpassword'])->name('password.set');

    // Add Property Routes
    Route::get('/property/add', [PropertyController::class, 'add'])->name('property.add');
    Route::post('/propertysave', [PropertyController::class, 'store'])->name('property.store');
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('property.edit');
    Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('property.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('property.destroy');

    // Dashboard
    Route::get('/myproperties', [DashboardController::class, 'showMyProperty']);

    // Favourite and Like Routes
    Route::prefix('properties')->group(function () {
        Route::post('/{property}/favorite', [PropertyController::class, 'favorite'])->name('properties.favorite');
        Route::post('/{property}/unfavorite', [PropertyController::class, 'unfavorite'])->name('properties.unfavorite');
        Route::post('/{property}/like', [PropertyController::class, 'like'])->name('properties.like');
        Route::post('/{property}/unlike', [PropertyController::class, 'unlike'])->name('properties.unlike');
    });

    // Favorites Page Routes
    Route::prefix('favorites')->group(function () {
        Route::get('/', [FavoritesController::class, 'index'])->name('favorites');
        Route::delete('/{id}', [FavoritesController::class, 'destroy'])->name('favorites.destroy');
    });

    // Favorites Page Routes
    Route::prefix('likes')->group(function () { 
        Route::get('/', [LikesController::class, 'index'])->name('likes');
        Route::delete('/{id}', [LikesController::class, 'destroy'])->name('likes.destroy');
    });
    Route::post('/compare-properties', [PropertyController::class, 'compare'])->name('property.compare');

    // My Property Page
    Route::get('/myproperties', [MyPropertyController::class, 'index'])->name('myproperties');
    Route::get('/myproperties/search', [MyPropertyController::class, 'search'])->name('myproperties.search');
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('property.edit');
    Route::put('/properties/{id}', [PropertyController::class, 'update'])->name('property.update');
    Route::delete('/properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    Route::get('/document/{property}/edit', [DocumentController::class, 'edit'])->name('document.edit');
    Route::put('/document/{property_id}', [DocumentController::class, 'update'])->name('document.update');

    // Comment
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Property
    Route::get('/adminproperty', [AdminController::class, 'showPendingProperties'])->name('admin.property'); 
    Route::post('/property/approve/{id}', [AdminController::class, 'approveProperty'])->name('property.approve');
    Route::post('/property/reject/{id}', [AdminController::class, 'rejectProperty'])->name('property.reject');

    // Admin Document
    Route::get('/admindocument', [AdminController::class, 'showDocuments'])->name('document.pending'); // Mengubah nama rute untuk menampilkan dokumen pending
    Route::post('/document/approve/{id}', [AdminController::class, 'approveDocument'])->name('document.approve');
    Route::post('/document/decline/{id}', [AdminController::class, 'declineDocument'])->name('document.decline');
    Route::get('/admin/document/search', [AdminController::class, 'searchDocuments'])->name('admin.document.search');
    Route::get('/admin/document/filter', [AdminController::class, 'filterDocuments'])->name('admin.document.filter');


    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});