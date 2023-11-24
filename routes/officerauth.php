<?php

use App\Http\Controllers\Officerauth\AuthenticatedSessionController;
use App\Http\Controllers\Officerauth\ConfirmablePasswordController;
use App\Http\Controllers\Officerauth\EmailVerificationNotificationController;
use App\Http\Controllers\Officerauth\EmailVerificationPromptController;
use App\Http\Controllers\Officerauth\NewPasswordController;
use App\Http\Controllers\Officerauth\PasswordController;
use App\Http\Controllers\Officerauth\PasswordResetLinkController;
use App\Http\Controllers\Officerauth\RegisteredUserController;
use App\Http\Controllers\Officerauth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest:doctor'], 'prefix' => 'doctor', 'as' => 'doctor.'], function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::group(['middleware' => ['auth:doctor'], 'prefix'=>'doctor','as'=>'doctor.'], function(){
    Route::get('verify-email', EmailVerificationPromptController::class)
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

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
