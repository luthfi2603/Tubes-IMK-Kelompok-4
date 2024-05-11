<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('verifikasi', [RegisteredUserController::class, 'createVerifikasi'])
                ->name('verifikasi');
    Route::post('verifikasi', [RegisteredUserController::class, 'storeVerifikasi']);
    Route::get('kirim-ulang-kode-otp', [RegisteredUserController::class, 'storeKirimUlangKodeOtp'])
                ->name('kirim.ulang.kode.otp');
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('verifikasi-nomor-handphone', [RegisteredUserController::class, 'createVerifikasiNomorHandphone'])
                ->name('verifikasi.nomor.handphone');
    Route::post('verifikasi-nomor-handphone', [RegisteredUserController::class, 'storeVerifikasiNomorHandphone']);
    Route::get('verifikasi-otp-reset-password', [RegisteredUserController::class, 'createVerifikasiOtpResetPassword'])
                ->name('verifikasi.otp.reset.password');
    Route::post('verifikasi-otp-reset-password', [RegisteredUserController::class, 'storeVerifikasiOtpResetPassword']);
    Route::get('reset-password', [RegisteredUserController::class, 'createResetPassword'])
                ->name('reset.password');
    Route::post('reset-password', [RegisteredUserController::class, 'storeResetPassword']);
    /* Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');
    Route::get('reset-password-0/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');
    Route::post('reset-password-0', [NewPasswordController::class, 'store'])
                ->name('password.store'); */
});

Route::middleware('auth')->group(function(){
    /* Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update'); */
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});