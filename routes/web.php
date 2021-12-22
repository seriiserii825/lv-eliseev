<?php

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

//Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/cabinet', [\App\Http\Controllers\Cabinet\HomeController::class, 'index'])->name('cabinet');
Route::get('/register', [\App\Http\Controllers\Auth\RegistrationController::class, 'form'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegistrationController::class, 'register'])->name('register');
Route::get('/verify/{token}', [\App\Http\Controllers\Auth\RegistrationController::class, 'verify'])->name('register.verify');
Route::get('/login', [\App\Http\Controllers\Auth\RegistrationController::class, 'loginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\RegistrationController::class, 'login'])->name('login');
Route::get('/contacts', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
