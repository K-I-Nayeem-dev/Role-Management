<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
});


//Permissions Routes
Route::middleware('auth')->controller(PermissionController::class)->group(function () {
    Route::get('/permissions', 'index')->name('permission.index');
    Route::get('/permissions/create', 'create')->name('permission.create');
    Route::post('/permissions/store', 'store')->name('permission.store');
    Route::get('/permissions/{id}/edit', 'edit')->name('permission.edit');
    Route::put('/permissions/{id}', 'update')->name('permission.update');
    Route::delete('/permissions/{id}', 'destroy')->name('permission.destroy');
});

//Roles Routes
Route::middleware('auth')->controller(RoleController::class)->group(function () {
    Route::get('/roles', 'index')->name('roles.index');
    Route::get('/roles/create', 'create')->name('roles.create');
    Route::post('/roles/store', 'store')->name('roles.store');
    Route::get('/roles/{id}/edit', 'edit')->name('roles.edit');
    Route::put('/roles/{id}', 'update')->name('roles.update');
    Route::delete('/roles/{id}', 'destroy')->name('roles.destroy');
});

//Articles Routes
Route::middleware('auth')->controller(ArticleController::class)->group(function () {
    Route::get('/articles', 'index')->name('articles.index');
    Route::get('/articles/create', 'create')->name('articles.create');
    Route::post('/articles/store', 'store')->name('articles.store');
    Route::get('/articles/{id}/edit', 'edit')->name('articles.edit');
    Route::put('/articles/{id}', 'update')->name('articles.update');
    Route::delete('/articles/{id}', 'destroy')->name('articles.destroy');
});

//Users Routes
Route::middleware('auth')->controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('users.index');
    Route::get('/users/create', 'create')->name('users.create');
    Route::post('/users/store', 'store')->name('users.store');
    Route::get('/users/{id}/edit', 'edit')->name('users.edit');
    Route::put('/users/{id}', 'update')->name('users.update');
    Route::delete('/users/{id}', 'destroy')->name('users.destroy');
});

require __DIR__ . '/auth.php';