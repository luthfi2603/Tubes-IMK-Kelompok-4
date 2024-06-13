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
        Route::get('/rekam-medis', function(){
                return view('rekam-medis');
             })->name('pasien.rekam-medis');
        Route::get('/detail-rekam-medis', function(){
                return view('detail-rekam-medis');
             })->name('pasien.detail-rekam-medis');
        Route::get('/notifikasi', function(){
                return view('notifikasi');
             })->name('pasien.notifikasi-pasien');
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
        Route::get('/reservasi', 'indexReservasi')
            ->name('reservasi');
        Route::get('/reservasi/buat', 'createReservasi')
            ->name('buat.reservasi');
        Route::post('/daftar-dokter', 'storeDaftarDokter');
        Route::post('/reservasi/buat', 'storeReservasi');
        Route::delete('/reservasi/destroy', 'destroyReservasi')
            ->name('destroy.reservasi');
        Route::get('/dokter', 'indexDokter')
            ->name('dokter');
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
                Route::post('/antrian/tanggal', 'indexAntrianTanggal');
                Route::get('/janji-temu-dokter', 'indexAntrian')
                    ->name('janji.temu');
                
                Route::get('/doctors-dokter', function(){
                    return view('dokter.doctors-dokter');
                })->name('doctors-dokter');
                
                Route::get('/detail-dokter', function(){
                    return view('dokter.detail-dokter');
                })->name('detail-dokter');
                
                Route::get('/setting-dokter', function(){
                    return view('dokter.setting-dokter');
                })->name('setting-dokter');
            });
        });
    });
});

Route::middleware(['auth', 'role:Perawat'])->group(function(){
    Route::prefix('perawat')->group(function(){
        Route::name('perawat.')->group(function(){
            Route::controller(PerawatController::class)->group(function(){
                Route::get('/dashboard', 'showDashboardPerawat')->name('dashboard');

                Route::get('/pasien', 'indexPasien')
                ->name('data.pasien');
                
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
                Route::post('/pasien/cari', 'storeCariPasien');

                Route::get('/antrian', 'indexAntrian')
                    ->name('index.antrian');
                Route::post('/antrian/tanggal', 'indexAntrianTanggal');
                Route::put('/antrian/update', 'updateStatusAntrian');

                Route::get('/dokter', 'indexDokter')
                    ->name('index.dokter');
                Route::post('/cari/dokter', 'cariDokter');

                Route::get('/jadwal-dokter', 'indexJadwalDokter')
                    ->name('jadwal.dokter.index');
                Route::post('/jadwal-dokter/cari', 'storeCariJadwalDokter');
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
                Route::post('/pasien/cari', 'storeCariPasien');

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

                Route::get('/antrian', 'indexAntrian')
                    ->name('index.antrian');
                Route::post('/antrian/tanggal', 'indexAntrianTanggal');
                Route::put('/antrian/update', 'updateStatusAntrian');

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