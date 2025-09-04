<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

// Auth Routes

Route::get('/login', fn () => view('login'))->name('login');
Route::get('/register', fn () => view('register'))->name('register');
Route::get('/register', [\App\Http\Controllers\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [\App\Http\Controllers\RegisteredUserController::class, 'store']);

