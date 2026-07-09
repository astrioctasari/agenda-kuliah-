<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dummy route bernama "login" biar Laravel ga error waktu
// generate URL redirect untuk request yang gagal auth (API-only app,
// jadi ga ada halaman login beneran, cukup ini biar route('login') ga crash).
Route::get('/login', function () {
    return response()->json(['message' => 'Unauthenticated.'], 401);
})->name('login');
