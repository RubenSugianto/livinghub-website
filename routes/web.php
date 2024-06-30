<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DijualController;
use App\Http\Controllers\DisewaController;
use App\Http\Controllers\SimulasikprController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dijual', [DijualController::class, 'index'])->name('dijual');
Route::get('/disewa', [DisewaController::class, 'index'])->name('disewa');
Route::get('/simulasikpr', [SimulasikprController::class, 'index'])->name('simulasikpr');
Route::post('/simulasikpr/calculate', [SimulasikprController::class, 'calculate'])->name('simulasikpr.calculate');
