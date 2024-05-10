<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\ProfileController;

Route::middleware(['auth'])->group(function(){
    Route::get('/', [ViewController::class, 'index']);
});

Route::middleware(['auth', 'role:pasien'])->group(function(){
    Route::get('/dashboard', [ViewController::class, 'showDashboardPasien'])
        ->name('dashboard.pasien');
});

/* Route::middleware('auth')->group(function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */

require __DIR__.'/auth.php';