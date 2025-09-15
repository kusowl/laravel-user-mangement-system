<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

/* <---------- Auth Routes ----------> */
Route::middleware('guest')->group(function () {
    Route::get('/register', [\App\Http\Controllers\RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [\App\Http\Controllers\RegisteredUserController::class, 'store']);

    Route::get('/login', [\App\Http\Controllers\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    /* <---------- User Routes ----------> */

    Route::get('/user', [UserProfileController::class, 'show'])->name('user.show');

    Route::put('user/profile', [UserProfileController::class, 'updateProfile'])->name('user.profile');
    Route::put('user/profile/photo/', [UserProfileController::class, 'updateProfilePhoto'])->name('user.profile.photo');
    Route::put('user/profile/password', [UserProfileController::class, 'updatePassword'])->name('user.profile.password');
});

Route::middleware(['auth', isAdmin::class])->group(function () {
    Route::get('/user/index', [UserProfileController::class, 'index'])->name('user.index');
    /*
     * As Only admin who has perimission should be able to deactivate||delete a user, it's a perfect use case of policy
     */
    Route::patch('/user/{id}/deactivate', [UserProfileController::class, 'deactivate'])->middleware('auth')->name('user.deactivate');
    Route::delete('/user/{id}/delete', [UserProfileController::class, 'destory'])->middleware('auth')->name('user.destroy');
});
