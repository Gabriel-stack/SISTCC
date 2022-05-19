<?php

use Illuminate\Support\Facades\Redirect;
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

Route::get('/', function () {
    return redirect()->route('student.login');
});



Route::get('/student/dashboard', function () {
    return view('student.dashboard');
})->middleware(['auth'])->name('student.dashboard');

require __DIR__.'/student_auth.php';



Route::get('/professor/dashboard', function () {
    return view('professor.dashboard');
})->middleware(['auth:professor'])->name('professor.dashboard');

require __DIR__.'/professor_auth.php';
