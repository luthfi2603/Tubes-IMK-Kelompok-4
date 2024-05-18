<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;

Route::middleware(['guest'])->group(function(){
    Route::get('/', function(){
        return view('index');
    });
    Route::get('/register0', function(){
        return view('register0');
    });
    Route::get('/login-as-page', function(){
        return view('login-as-page');
    });

    
});

Route::middleware(['auth', 'role:pasien'])->group(function(){
    Route::get('/dashboard', [PasienController::class, 'showDashboardPasien'])
        ->name('pasien.dashboard');
    Route::get('/profil', [PasienController::class, 'editProfil'])
        ->name('pasien.profil');
    Route::put('/profil', [PasienController::class, 'updateProfil']);
    Route::put('/foto-profil', [PasienController::class, 'updateFotoProfil']);
    Route::delete('/hapus-foto-profil', [PasienController::class, 'hapusFotoProfil']);
    Route::get('/pasien-verifikasi', [PasienController::class, 'createVerifikasi'])
        ->name('pasien.verifikasi');
    Route::post('/pasien-verifikasi', [PasienController::class, 'storeVerifikasi']);
    Route::post('/kirim-ulang-kode-otp-update-nomor-handphone', [PasienController::class, 'storeKirimUlangKodeOtp'])
        ->name('kirim.ulang.kode.otp.update.nomor.handphone');
    Route::get('/dokter', function(){
        return view('dokter');
    });
    Route::get('/informasi', function(){
        return view('informasi');
    });

    //ini supaya bisa jalan (nanti hapus aja)
    Route::get('/dashboard-dokter', function(){
        return view('dokter.dashboard-dokter');
    });
    Route::get('/pasien-reset-passsword', function(){
        return view('pasien-reset-password');
    });

});

Route::get('/admin/datapasien', [AdminController::class, 'datapasien'])
    ->name('data_pasien');
Route::get('/admin/datakaryawan', [AdminController::class, 'datakaryawan'])
    ->name('data_karyawan');

/* Route::middleware('auth')->group(function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */

require __DIR__.'/auth.php';