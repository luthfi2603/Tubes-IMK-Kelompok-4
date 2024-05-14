<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;

Route::middleware(['guest'])->group(function(){
    Route::get('/', function(){
        return view('index');
    });
});

Route::middleware(['auth', 'role:pasien'])->group(function(){
    Route::get('/dashboard', [PasienController::class, 'showDashboardPasien'])
        ->name('dashboard.pasien');
    Route::get('/profil', [PasienController::class, 'editProfil'])
        ->name('profil.pasien');
});

Route::get('/dokter', function(){
    return view('dokter');
});
Route::get('/informasi', function(){
    return view('informasi');
});
Route::get('/register0', function(){
    return view('register0');
});
Route::get('/login-as-page', function(){
    return view('login-as-page');
});

/* Route::middleware('auth')->group(function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */

Route::get('/admin/datapasien', [AdminController::class, 'datapasien'])->name('data_pasien'); 

require __DIR__.'/auth.php';