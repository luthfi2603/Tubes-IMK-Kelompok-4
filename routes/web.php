<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

Route::middleware(['guest'])->group(function(){
    Route::get('/', [ViewController::class, 'index']);
});

Route::middleware(['auth', 'role:pasien'])->group(function(){
    Route::get('/dashboard', [ViewController::class, 'showDashboardPasien'])
    ->name('dashboard.pasien');
    Route::get('/profil', function(){
        return view('profil');
    })->name('profil');
});

Route::get('/dokter', function(){
    return view('dokter');
});
Route::get('/informasi', function(){
    return view('informasi');
});

/* Route::middleware('auth')->group(function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */

Route::get('/admin/datapasien', [AdminController::class, 'datapasien'])->name('data_pasien'); 

require __DIR__.'/auth.php';