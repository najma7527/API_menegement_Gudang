<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KatagoriController; 
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Storage;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Test connection
Route::get('/test-connection', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API Laravel terhubung dengan Flutter!',
        'timestamp' => now(),
    ]);
});

Route::post('/test-post', function (Request $request) {
    return response()->json([
        'status' => 'success', 
        'message' => 'POST request berhasil!',
        'received_data' => $request->all()
    ]);
});

// 🔥 PERBAIKI: Group semua route yang butuh auth dalam SATU group
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto']);

    // Contoh endpoint protected
    Route::get('/profil', function (Request $request) {
        return $request->user();
    });

    // 🔥 PERBAIKI: Konsistensi penulisan "katagori" (dengan A)
    // Route untuk barang
    Route::get('/barang', [BarangController::class, 'index']);
    Route::get('/barang/user/{userId}', [BarangController::class, 'getByUser']);
    Route::post('/barang', [BarangController::class, 'store']);
    Route::put('/barang/{id}', [BarangController::class, 'update']);
    Route::delete('/barang/{id}', [BarangController::class, 'destroy']);

    // 🔥 PERBAIKI: Gunakan "katagori" secara konsisten (sesuai dengan yang diakses Flutter)
    Route::get('/katagori', [KatagoriController::class, 'index']);
    Route::get('/katagori/user/{userId}', [KatagoriController::class, 'getByUser']);
    Route::post('/katagori', [KatagoriController::class, 'store']);
    Route::put('/katagori/{id}', [KatagoriController::class, 'update']);
    Route::delete('/katagori/{id}', [KatagoriController::class, 'destroy']);
    // Route untuk transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::get('/transaksi/user/{userId}', [TransaksiController::class, 'getByUser']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);
});