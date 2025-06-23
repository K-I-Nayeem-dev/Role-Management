<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
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

require __DIR__ . '/auth.php';