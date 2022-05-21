<?php

use App\Http\Controllers\Professor\SubjectController;
use App\Http\Controllers\ProfessorAuth\AuthenticatedSessionController;
use App\Http\Controllers\ProfessorAuth\ConfirmablePasswordController;
use App\Http\Controllers\ProfessorAuth\EmailVerificationNotificationController;
use App\Http\Controllers\ProfessorAuth\EmailVerificationPromptController;
use App\Http\Controllers\ProfessorAuth\NewPasswordController;
use App\Http\Controllers\ProfessorAuth\PasswordResetLinkController;
use App\Http\Controllers\ProfessorAuth\RegisteredUserController;
use App\Http\Controllers\ProfessorAuth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:professor')->prefix('professor')->name('professor.')->group(function () {
    Route::get('/', function(){
        return redirect()->route('professor.login');
    });
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

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
->name('password.reset');

Route::middleware('auth:professor')->prefix('professor')->name('professor.')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');


    // Perfil

    Route::get('profile', [RegisteredUserController::class, 'edit'])
                ->name('profile');

    Route::post('profile/update', [RegisteredUserController::class, 'update'])
                ->name('profile.update');


    // Turmas

    Route::get('subjects', [SubjectController::class, 'create'])
                ->name('subject');

    Route::get('subjects/search', [SubjectController::class, 'search'])
                ->name('subject.search');

    Route::post('subjects/store', [SubjectController::class, 'store'])
                ->name('subject.store');

    Route::post('subjects/update', [SubjectController::class, 'update'])
                ->name('subject.update');

    Route::post('subjects/destroy', [SubjectController::class, 'destroy'])
                ->name('subject.destroy');
});
