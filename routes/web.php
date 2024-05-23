<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PerawatController;
use App\Http\Controllers\ProfileController;

Route::middleware(['guest2'])->group(function(){
    Route::get('/', function(){
        return view('index');
    });
    Route::get('/masuk-sebagai', function(){
        return view('login-as-page');
    })->name('masuk.sebagai');
});

Route::middleware(['auth', 'role:pasien'])->group(function(){
    Route::controller(PasienController::class)->group(function(){
        Route::get('/dashboard', 'showDashboardPasien')
            ->name('pasien.dashboard');
        Route::get('/profil', 'editProfil')
            ->name('pasien.profil');
        Route::put('/profil', 'updateProfil');
        Route::put('/foto-profil', 'updateFotoProfil');
        Route::delete('/hapus-foto-profil', 'destroyFotoProfil');
        Route::get('/pasien-verifikasi', 'createVerifikasi')
            ->name('pasien.verifikasi');
        Route::post('/pasien-verifikasi', 'storeVerifikasi');
        Route::post('/kirim-ulang-kode-otp-update-nomor-handphone', 'storeKirimUlangKodeOtp')
            ->name('kirim.ulang.kode.otp.update.nomor.handphone');
        Route::get('/edit-password', 'editPassword')
            ->name('password.edit');
        Route::put('/edit-password', 'updatePassword');
        Route::delete('/hapus-akun', 'destroyAkun')
            ->name('akun.destroy');
        Route::post('/cancel-ubah-profil', 'cancelUbahProfil')
            ->name('cancel.ubah.profil');
    });

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

Route::middleware(['auth', 'role:dokter'])->group(function(){
    Route::prefix('dokter')->group(function(){
        Route::name('dokter.')->group(function(){
            Route::controller(DokterController::class)->group(function(){
                Route::get('/dashboard', 'showDashboardDokter')->name('dashboard');
            });
        });
    });
});

Route::middleware(['auth', 'role:perawat'])->group(function(){
    Route::prefix('perawat')->group(function(){
        Route::name('perawat.')->group(function(){
            Route::controller(PerawatController::class)->group(function(){
                Route::get('/dashboard', 'showDashboardPerawat')->name('dashboard');
            });
        });
    });
});

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::name('admin.')->group(function(){
            Route::controller(AdminController::class)->group(function(){
                Route::get('/dashboard', 'showDashboardAdmin')
                    ->name('dashboard');
                Route::get('/data-pasien', 'dataPasien')
                    ->name('data.pasien');
                Route::get('/data-karyawan', 'dataKaryawan')
                    ->name('data.karyawan');
                Route::get('/edit-pasien/{nohp}', 'editPasien')
                    ->name('edit.pasien');
                Route::put('/edit-pasien/{nohp}', 'updatePasien');
                Route::post('/ban-pasien/{nomor_handphone}','banPasien')
                    ->name('ban.pasien');
                Route::post('/unban-pasien/{nomor_handphone}','unbanPasien')
                    ->name('unban.pasien');
            });
        });
    });
});

/* Route::middleware('auth')->group(function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */

require __DIR__.'/auth.php';