<?php

use App\Http\Controllers\Student\Auth\{
    AuthenticatedSessionController,
    ConfirmablePasswordController,
    EmailVerificationNotificationController,
    EmailVerificationPromptController,
    NewPasswordController,
    PasswordResetLinkController,
    RegisteredUserController,
    VerifyEmailController,
};
use App\Http\Controllers\Student\{
    DashboardController,
    TccController,
};

use Illuminate\Support\Facades\Route;

Route::middleware(['guest', 'prevent-back-history'])->prefix('student')->name('student.')->group(function () {
    route::get('/', function () {
        return redirect()->route('student.login');
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


Route::middleware(['auth', 'prevent-back-history'])->prefix('student')->name('student.')->group(function () {
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



    // Painel de Controle
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
        Route::post('store', 'enrollInClass')->name('enroll');
    });

    // painel de Progresso
    Route::prefix('subject')->controller(TccController::class)->group(function () {
        Route::get('{subject}', 'index')->name('progress')->middleware('prevent-subject-access');

        Route::name('progress.')->middleware('prevent-subject-access')->group(function () {
            Route::get('{subject}/tcc', 'createTcc')->name('tcc');
            Route::post('{subject}/tcc', 'storeTcc')->name('tcc.store');
            Route::get('{subject}/requirement', 'createRequirement')->name('requirement');
            Route::post('{subject}/requirement', 'storeRequirement')->name('requirement.store');
            Route::get('{subject}/finish', 'createFinish')->name('finish');
            Route::post('{subject}/finish', 'storeFinish')->name('finish.store');
        });

        // Acompanhamento
        Route::name('accompaniment.')->middleware('prevent-accompaniment-access')->group(function () {
            Route::get('{tcc}/accompaniment/tcc', 'accompanimentTcc')->name('tcc');
            Route::get('{tcc}/accompaniment/requirement', 'accompanimentRequirement')->name('requirement');
            Route::get('{tcc}/accompaniment/finish', 'accompanimentFinish')->name('finish');
        });
    });


    // Perfil
    Route::prefix('profile')->controller(RegisteredUserController::class)->group(function () {
        Route::get('/', 'edit')->name('profile');

        Route::name('profile.')->group(function () {
            Route::post('update_personal_data', 'updatePersonalData')->name('update');

            Route::post('update_address', 'updateAddress')->name('update_address');

            Route::post('update_tcc', 'updateTcc')->name('update_tcc');

            Route::post('update_password', 'updatePassword')->name('update_password');
        });
    });
});
