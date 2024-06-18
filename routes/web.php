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

Route::middleware(['auth', 'role:Pasien'])->group(function(){
    Route::controller(PasienController::class)->group(function(){
        Route::get('/dashboard', 'showDashboardPasien')
            ->name('pasien.dashboard');
        Route::get('/tentang-kami', function(){
            return view('tentang-kami');
        })->name('pasien.tentang-kami');
        Route::get('/notifikasi', 'showNotifikasi')
            ->name('pasien.notifikasi');
        Route::get('/profil', 'editProfil')
            ->name('pasien.profil');
        Route::put('/profil', 'updateProfil');
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

        Route::get('/reservasi', 'indexReservasi')
            ->name('reservasi');
        Route::get('/reservasi/buat', 'createReservasi')
            ->name('buat.reservasi');
        Route::post('/reservasi/buat', 'storeReservasi');
        Route::delete('/reservasi/destroy', 'destroyReservasi')
            ->name('destroy.reservasi');
        Route::get('/reservasi/edit/{pk}', 'editReservasi')
            ->name('reservasi.edit');
        Route::put('/reservasi/edit/{pk}', 'updateReservasi');

        Route::get('/dokter', 'indexDokter')
            ->name('dokter');
        
        Route::get('/rekam-medis', 'indexRekamMedis')
            ->name('rekam.medis');
        Route::get('/rekam-medis/detail/{pk}', 'showRekamMedis')
            ->name('rekam.medis.detail');
    });
});

Route::middleware(['auth', 'role:Dokter'])->group(function(){
    Route::prefix('dokter')->group(function(){
        Route::name('dokter.')->group(function(){
            Route::controller(DokterController::class)->group(function(){
                Route::get('/dashboard', 'showDashboardDokter')
                    ->name('dashboard');
                Route::get('/rekam-medis', 'indexRekamMedis')
                    ->name('rekam.medis');
                Route::post('/rekam-medis/tanggal', 'indexRekamMedisTanggal');
                Route::get('/rekam-medis/detail/{id}', 'showRekamMedis')
                    ->name('rekam.medis.show');
                Route::get('/janji-temu-dokter/rekam-medis/create/{pk}', 'createRekamMedis')
                    ->name('rekam.medis.create');
                Route::post('/janji-temu-dokter/rekam-medis/create/{pk}', 'storeRekamMedis');
                Route::get('/rekam-medis/edit/{pk}', 'editRekamMedis')
                    ->name('rekam.medis.edit');
                Route::put('/rekam-medis/edit/{pk}', 'updateRekamMedis');
                Route::delete('/rekam-medis/destroy/{pk}', 'destroyRekamMedis')
                    ->name('rekam.medis.destroy');
                Route::post('/antrian/tanggal', 'indexAntrianTanggal');
                Route::get('/janji-temu-dokter', 'indexAntrian')
                    ->name('janji.temu');
                Route::get('/profil', 'showProfil')
                    ->name('profil');
                Route::get('/dokter-kami', 'indexDokter')
                    ->name('dokter.kami');
            });
        });
    });
});

Route::middleware(['auth', 'role:Perawat'])->group(function(){
    Route::prefix('perawat')->group(function(){
        Route::name('perawat.')->group(function(){
            Route::controller(PerawatController::class)->group(function(){
                Route::get('/dashboard', 'showDashboardPerawat')
                    ->name('dashboard');
                Route::get('/pasien', 'indexPasien')
                    ->name('data.pasien');
                Route::get('/dokter', 'indexDokter')
                    ->name('index.dokter');
                Route::get('/profil', 'showProfil')
                    ->name('profil');
             });
        });
    });
});

Route::middleware(['auth', 'role:Admin'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::name('admin.')->group(function(){
            Route::controller(AdminController::class)->group(function(){
                Route::get('/dashboard', 'showDashboardAdmin')
                    ->name('dashboard');

                Route::get('/pasien', 'indexPasien')
                    ->name('data.pasien');
                /* Route::get('/data-karyawan', 'dataKaryawan')
                    ->name('data.karyawan'); */
                Route::get('/pasien/edit/{pk}', 'editPasien')
                    ->name('edit.pasien');
                Route::put('/pasien/edit/{pk}', 'updatePasien');
                Route::post('/pasien/ban/{pk}', 'banPasien')
                    ->name('ban.pasien');
                Route::post('/pasien/unban/{pk}', 'unbanPasien')
                    ->name('unban.pasien');
                Route::get('/pasien/input', 'createPasien')
                    ->name('tambah.pasien');
                Route::post('/pasien/input', 'storePasien');
                Route::get('/pasien/reservasi/{pk}', 'createPasienReservasi')
                    ->name('pasien.reservasi');
                Route::post('/pasien/reservasi/{pk}', 'storePasienReservasi');

                Route::get('/perawat', 'indexPerawat')
                    ->name('perawat.index');
                Route::get('/perawat/input', 'createPerawat')
                    ->name('perawat.input');
                Route::post('/perawat/input', 'storePerawat');
                Route::get('/perawat/edit/{pk}', 'editPerawat')
                    ->name('perawat.edit');
                Route::put('/perawat/edit/{pk}', 'updatePerawat');
                Route::delete('/perawat/destroy/{pk}', 'destroyPerawat')
                    ->name('perawat.destroy');
                Route::post('/cari/perawat', 'cariPerawat');

                Route::get('/dokter', 'indexDokter')
                    ->name('index.dokter');
                Route::get('/dokter/input', 'createDokter')
                    ->name('dokter.input');
                Route::post('/dokter/input', 'storeDokter');
                Route::get('/dokter/edit/{pk}', 'editDokter')
                    ->name('dokter.edit');
                Route::put('/dokter/edit/{pk}', 'updateDokter');
                Route::delete('/dokter/destroy/{pk}', 'destroyDokter')
                    ->name('dokter.destroy');
                Route::post('/cari/dokter', 'cariDokter');
                Route::get('/dokter/edit-jadwal/{pk}', 'editDokterJadwal')
                    ->name('dokter.edit.jadwal');
                Route::put('/dokter/edit-jadwal/{pk}', 'updateDokterJadwal');

                Route::get('/jadwal-dokter', 'indexJadwalDokter')
                    ->name('jadwal.dokter.index');
                Route::get('/jadwal-dokter/input', 'createJadwalDokter')
                    ->name('jadwal.dokter.input');
                Route::post('/jadwal-dokter/input', 'storeJadwalDokter');
                Route::get('/jadwal-dokter/edit/{pk}', 'editJadwalDokter')
                    ->name('jadwal.dokter.edit');
                Route::put('/jadwal-dokter/edit/{pk}', 'updateJadwalDokter');
                Route::delete('/jadwal-dokter/{pk}', 'destroyJadwalDokter')
                    ->name('jadwal.dokter.destroy');
                Route::post('/jadwal-dokter/cari', 'storeCariJadwalDokter');

                Route::get('/profil', 'editProfil')
                    ->name('profil');
                Route::put('/profil', 'updateProfil');
            });
        });
    });
});

Route::middleware(['auth', 'role:Pasien,Admin,Perawat,Dokter'])->group(function(){
    Route::controller(PasienController::class)->group(function(){
        Route::post('/daftar-dokter', 'storeDaftarDokter');
        Route::put('/foto-profil', 'updateFotoProfil');
        Route::delete('/hapus-foto-profil', 'destroyFotoProfil');
        Route::get('/edit-password', 'editPassword')
            ->name('password.edit');
        Route::put('/edit-password', 'updatePassword');
    });
});

Route::middleware(['auth', 'role:Admin,Perawat'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/antrian', 'indexAntrian')
            ->name('index.antrian');
        Route::post('/antrian/tanggal', 'indexAntrianTanggal');
        Route::put('/antrian/update', 'updateStatusAntrian');
        Route::post('/pasien/cari', 'storeCariPasien');
    });
});

/* Route::middleware('auth')->group(function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */

require __DIR__.'/auth.php';