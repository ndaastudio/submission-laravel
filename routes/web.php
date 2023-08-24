<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\ArtikelController;
use App\Http\Controllers\Dashboard\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::controller(LoginController::class)->group(function () {
    Route::get('/auth/login', 'index')->name('login');
    Route::post('/auth/login', 'authenticate');
    Route::get('/auth/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/auth/register', 'index')->name('register');
    Route::post('/auth/register', 'store');
});

Route::controller(TagController::class)->group(function () {
    Route::get('/dashboard/tag', 'index')->name('tag');
    Route::post('/dashboard/tag', 'store');
    Route::delete('/dashboard/tag/{id}', 'destroy')->name('tag.id');
    Route::put('/dashboard/tag/{id}', 'update');
});
