<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\StudentController;


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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/categories', \App\Http\Controllers\CategoryController::class);
Route::resource('/events', \App\Http\Controllers\EventController::class);
Route::get('/viewYourEvents', [\App\Http\Controllers\EventController::class, 'viewYourEvents'])->name('viewYourEvents');
Route::get('/viewExploreEvents', [\App\Http\Controllers\EventController::class, 'viewExploreEvents'])->name('viewExploreEvents');

Route::get('/destroy/{id}', [\App\Http\Controllers\CategoryController::class, 'destroyCategory'])->name('categories.destroy');
Route::post('/send', [\App\Http\Controllers\EmailController::class, 'send'])->name('send');
Route::put('joinEvent/{id}', [\App\Http\Controllers\EventController::class, 'joinEvent'])->name('joinEvent');
Route::get('quitEvent/{id}', [\App\Http\Controllers\EventController::class, 'quitEvent'])->name('quitEvent');
Route::get('change_password', [\App\Http\Controllers\PasswordController::class, 'viewFormChangePassword'])->name('change_password');
Route::post('changePassword', [\App\Http\Controllers\PasswordController::class, 'changePassword'])->name('changePassword');
Route::get('viewCalendar', [\App\Http\Controllers\EventController::class, 'viewCalendar'])->name('viewCalendar');
