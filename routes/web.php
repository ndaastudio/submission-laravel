<?php

use App\Http\Controllers\AboutMeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\ArticleController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\TagController;
use App\Http\Controllers\Home\ArticleController as HomeArticleController;
use App\Http\Controllers\Home\ProfileController;
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

Route::get('/about-me', [AboutMeController::class, 'index'])->name('about');
Route::get('/auth/logout', [LoginController::class, 'logout'])->name('logout');

Route::controller(HomeArticleController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::middleware('auth')->group(function () {
        Route::get('/article/{uid}/{slug}', 'show')->name('article.uid.slug');
        Route::get('/category/{category}', 'showByCategory')->name('article.category');
        Route::get('/article/all', 'showAll')->name('article.all');
    });
});

Route::middleware('isNotAdmin')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile');
        Route::put('/profile', 'update');
        Route::get('/profile/edit', 'edit')->name('profile.edit');
    });
});

Route::middleware('isNotLogin')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/auth/login', 'index')->name('login');
        Route::post('/auth/login', 'authenticate');
    });
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/auth/register', 'index')->name('register');
        Route::post('/auth/register', 'store');
    });
});

Route::middleware('isAdmin')->group(function () {
    Route::controller(TagController::class)->group(function () {
        Route::get('/dashboard/tag', 'index')->name('tag');
        Route::post('/dashboard/tag', 'store');
        Route::delete('/dashboard/tag/{id}', 'destroy')->name('tag.id');
        Route::put('/dashboard/tag/{id}', 'update');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/dashboard/category', 'index')->name('category');
        Route::post('/dashboard/category', 'store');
        Route::delete('/dashboard/category/{id}', 'destroy')->name('category.id');
        Route::put('/dashboard/category/{id}', 'update');
    });
});

Route::controller(ArticleController::class)->group(function () {
    Route::middleware('isNotPembaca')->group(function () {
        Route::get('/dashboard/article', 'index')->name('article');
        Route::delete('/dashboard/article/{id}', 'destroy');
    });
    Route::middleware('isPenulis')->group(function () {
        Route::get('/dashboard/article/create', 'create')->name('article.create');
        Route::post('/dashboard/article', 'store');
        Route::get('/dashboard/article/{id}', 'edit')->name('article.id');
        Route::put('/dashboard/article/{id}', 'update');
    });
});
