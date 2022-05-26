<?php

use App\Http\Controllers\Professor\{
    AdvisorController,
    DashboardController,
    ProfessorController,
    SubjectController,
};
use App\Http\Controllers\ProfessorAuth\{
    AuthenticatedSessionController,
    ConfirmablePasswordController,
    EmailVerificationNotificationController,
    EmailVerificationPromptController,
    NewPasswordController,
    PasswordResetLinkController,
    RegisteredUserController,
    VerifyEmailController,
};
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:professor', 'prevent-back-history'])->prefix('professor')->name('professor.')->group(function () {
    Route::get('/', function () {
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

Route::middleware(['auth:professor', 'prevent-back-history'])->prefix('professor')->name('professor.')->group(function () {
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


        // Alunos
        Route::prefix('students')->name('student.')->group(function () {
            Route::get('search', 'search')->name('search');

            Route::post('remove', 'remove')->name('remove');

            Route::get('show/{student}', 'show')->name('show');
        });
    });


    // Perfil
    Route::prefix('profile')->controller(RegisteredUserController::class)->group(function () {
        Route::get('', 'edit')->name('profile');

        Route::name('profile.')->group(function () {
            Route::post('update_personal_data', 'updatePersonalData')->name('update');

            Route::post('update_password', 'updatePassword')->name('update_password');
        });
    });


    // Turmas
    Route::prefix('subjects')->controller(SubjectController::class)->group(function () {
        Route::get('', 'create')->name('subjects');

        Route::name('subject.')->group(function () {
            Route::get('search', 'search')->name('search');

            Route::post('store', 'store')->name('store');

            Route::post('update', 'update')->name('update');

            Route::post('destroy', 'destroy')->name('destroy');
        });
    });


    // Orientadores
    Route::prefix('advisors')->controller(AdvisorController::class)->group(function () {
        Route::get('', 'create')->name('advisors');

        Route::name('advisor.')->group(function () {
            Route::get('search', 'search')->name('search');

            Route::post('store', 'store')->name('store');

            Route::post('update', 'update')->name('update');

            Route::post('destroy', 'destroy')->name('destroy');
        });
    });


    // Professores
    Route::prefix('professors')->controller(ProfessorController::class)->group(function () {
        Route::get('', 'create')->name('professors');

        Route::name('professor.')->group(function () {
            Route::get('search', 'search')->name('search');

            Route::post('store', 'store')->name('store');

            Route::post('update', 'update')->name('update');

            Route::post('destroy', 'destroy')->name('destroy');
        });
    });
});
