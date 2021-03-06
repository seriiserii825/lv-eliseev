<?php

use App\Http\Controllers\Admin\AdvertsCategoryController;
use Illuminate\Support\Facades\Route;
Route::get('/', 'HomeController@index')->name('home');
Route::get('/cabinet', [\App\Http\Controllers\Cabinet\HomeController::class, 'index'])->name('cabinet');
Route::get('/register', [\App\Http\Controllers\Auth\RegistrationController::class, 'form'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegistrationController::class, 'register'])->name('register');
Route::get('/verify/{token}', [\App\Http\Controllers\Auth\RegistrationController::class, 'verify'])->name('register.verify');
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/contacts', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'can:admin-panel']
], function () {
    Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('index');
    Route::post('/users/verify', [\App\Http\Controllers\Admin\UserController::class, 'verify'])->name('users.verify');
    Route::resource('users', '\App\Http\Controllers\Admin\UserController');
    Route::resource('regions', '\App\Http\Controllers\Admin\RegionController');
    Route::resource('adverts_categories', '\App\Http\Controllers\Admin\AdvertsCategoryController');
    Route::post('/adverts_categories/{adverts_category}/first', [AdvertsCategoryController::class, 'first'])->name('adverts_categories.first');
    Route::post('/adverts_categories/{adverts_category}/up', [AdvertsCategoryController::class, 'up'])->name('adverts_categories.up');
    Route::post('/adverts_categories/{adverts_category}/down', [AdvertsCategoryController::class, 'down'])->name('adverts_categories.down');
    Route::post('/adverts_categories/{adverts_category}/last', [AdvertsCategoryController::class, 'last'])->name('adverts_categories.last');
    Route::resource('adverts_attributes', '\App\Http\Controllers\Admin\Adverts\AttributeController');
});
