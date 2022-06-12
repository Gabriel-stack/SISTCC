<?php

use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/', function () {
        return redirect()->route('student.login');
    });
});

// Route::middleware(['auth:professor', 'prevent-back-history'], function () {
    // Route::get('file/{file}', FilesController::class)->name('file');
    Route::get('file/{file}', FilesController::class)->name('file');
// });

require __DIR__ . '/student.php';

require __DIR__ . '/manager.php';
