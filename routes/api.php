<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CatatanController;
use App\Http\Controllers\Api\GaleriController;
use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\Api\TugasController;
use Illuminate\Support\Facades\Route;

// Auth (publik)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Butuh login (kirim header: Authorization: Bearer <token>)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('jadwal', JadwalController::class)->except(['show']);
    Route::apiResource('catatan', CatatanController::class)->except(['show']);
    Route::apiResource('tugas', TugasController::class)->except(['show']);
    Route::apiResource('galeri', GaleriController::class)->except(['show', 'update']);
});
