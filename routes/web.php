<?php

use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

// Auth Routes
Route::get('/register', [\App\Http\Controllers\RegisteredUserController::class, 'create'])->name('register')->middleware('guest');
Route::post('/register', [\App\Http\Controllers\RegisteredUserController::class, 'store'])->middleware('guest');
Route::get('/login', [\App\Http\Controllers\AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [\App\Http\Controllers\AuthenticatedSessionController::class, 'store'])->middleware('guest');

Route::get('/user/index', [UserProfileController::class, 'index'])->name('user.index');
// User Profile Routes
Route::get('/user', [UserProfileController::class, 'show'])
    ->middleware('auth')
    ->name('user.show');

Route::put('user/profile', [UserProfileController::class, 'updateProfile'])->middleware('auth')->name('user.profile');
Route::put('user/profile/photo/', [UserProfileController::class, 'updateProfilePhoto'])->middleware('auth')->name('user.profile.photo');
Route::put('user/profile/password', [UserProfileController::class, 'updatePassword'])->middleware('auth')->name('user.profile.password');
