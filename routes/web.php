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
Route::group(['middleware' => 'prevent-back-history'],function (){
    Route::get('/', function () {
        return redirect()->route('student.login');
    });
});

require __DIR__.'/student_auth.php';

require __DIR__.'/professor_auth.php';
