<?php

use App\Http\Controllers\Manager\{
    ProfessorController,
    DashboardController,
    ManagerController,
    ProgressStudentController,
};
use App\Http\Controllers\Manager\Auth\{
    AuthenticatedSessionController,
    ConfirmablePasswordController,
    EmailVerificationNotificationController,
    EmailVerificationPromptController,
    NewPasswordController,
    PasswordResetLinkController,
    RegisteredUserController,
    VerifyEmailController,
};
use App\Http\Livewire\Subject;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:professor', 'prevent-back-history'])->prefix('professor')->name('manager.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('manager.login');
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

Route::middleware(['auth:professor', 'prevent-back-history'])->prefix('professor')->name('manager.')->group(function () {
    // Route::get('/', function () {
    //     return redirect()->route('manager.dashboard');
    // });

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



    // Painel de Controle - Gerenciamento de Turmas
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');

        Route::name('subject.')->group(function () {
            Route::get('search', 'search')->name('search');

            Route::post('store', 'store')->name('store');

            Route::post('update', 'update')->name('update');

            // Route::post('destroy', 'destroy')->name('destroy');

            Route::post('close', 'close')->name('close');
        });
    });


    // Perfil
    Route::prefix('profile')->controller(RegisteredUserController::class)->group(function () {
        Route::get('/', 'edit')->name('profile');

        Route::name('profile.')->group(function () {
            Route::post('update_personal_data', 'updatePersonalData')->name('update');

            Route::post('update_password', 'updatePassword')->name('update_password');
        });
    });


    // Turma
    Route::prefix('subjects')->group(function () {
        Route::get('/{subject}', Subject::class)->name('subject');

        // Aluno
            // Route::post('remove', [Subject::class,'remove'])->name('remove');

            Route::get('{subject}/student/{tcc}/show', [ProgressStudentController::class,'show'])->name('show');
    });


    // Orientadores
    Route::prefix('professors')->controller(ProfessorController::class)->group(function () {
        Route::get('/', 'create')->name('professors');

        Route::name('professor.')->group(function () {
            Route::get('search', 'search')->name('search');

            Route::post('store', 'store')->name('store');

            Route::post('update', 'update')->name('update');

            Route::post('destroy', 'destroy')->name('destroy');
        });
    });


    // Professor de disciplina
    // Route::prefix('managers')->controller(ManagerController::class)->group(function () {
    //     Route::get('/', 'create')->name('managers');

    //     Route::name('manager.')->group(function () {
    //         Route::get('search', 'search')->name('search');

    //         Route::post('store', 'store')->name('store');

    //         Route::post('update', 'update')->name('update');

    //         Route::post('destroy', 'destroy')->name('destroy');
    //     });
    // });
});
