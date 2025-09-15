<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

/* <---------- Auth Routes ----------> */

Route::get('/register', [\App\Http\Controllers\RegisteredUserController::class, 'create'])->name('register')->middleware('guest');
Route::post('/register', [\App\Http\Controllers\RegisteredUserController::class, 'store'])->middleware('guest');
Route::get('/login', [\App\Http\Controllers\AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [\App\Http\Controllers\AuthenticatedSessionController::class, 'store'])->middleware('guest');

Route::delete('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');
/* <---------- User Routes ----------> */

Route::get('/user/index', [UserProfileController::class, 'index'])->name('user.index');
Route::get('/user', [UserProfileController::class, 'show'])
    ->middleware('auth')
    ->name('user.show');

Route::put('user/profile', [UserProfileController::class, 'updateProfile'])->middleware('auth')->name('user.profile');
Route::put('user/profile/photo/', [UserProfileController::class, 'updateProfilePhoto'])->middleware('auth')->name('user.profile.photo');
Route::put('user/profile/password', [UserProfileController::class, 'updatePassword'])->middleware('auth')->name('user.profile.password');
/*
* As Only admin who has perimission should be able to deactivate||delete a user, it's a perfect use case of policy
*/
Route::patch('/user/{id}/deactivate', [UserProfileController::class, 'deactivate'])->middleware('auth')->name('user.deactivate');
Route::delete('/user/{id}/delete', [UserProfileController::class, 'destory'])->middleware('auth')->name('user.destroy');
