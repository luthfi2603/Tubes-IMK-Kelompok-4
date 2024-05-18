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
    Route::get('/register0', function(){
        return view('register0');
    });
    Route::get('/login-as-page', function(){
        return view('login-as-page');
    });

    
});

Route::middleware(['auth', 'role:pasien'])->group(function(){
    Route::controller(PasienController::class)->group(function(){
        Route::get('/dashboard', 'showDashboardPasien')
            ->name('pasien.dashboard');
        Route::get('/profil', 'editProfil')
            ->name('pasien.profil');
        Route::put('/profil', 'updateProfil');
        Route::put('/foto-profil', 'updateFotoProfil');
        Route::delete('/hapus-foto-profil', 'hapusFotoProfil');
        Route::get('/pasien-verifikasi', 'createVerifikasi')
            ->name('pasien.verifikasi');
        Route::post('/pasien-verifikasi', 'storeVerifikasi');
        Route::post('/kirim-ulang-kode-otp-update-nomor-handphone', 'storeKirimUlangKodeOtp')
            ->name('kirim.ulang.kode.otp.update.nomor.handphone');
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
                Route::get('/dashboard', 'showDashboardAdmin')->name('dashboard');
            });
        });
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