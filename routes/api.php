<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// route yang butuh auth
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // contoh endpoint protected
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
});


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

// Route CRUD Anda
Route::apiResource('barang', \App\Http\Controllers\BarangController::class);
Route::apiResource('katagori', \App\Http\Controllers\KatagoriController::class);
Route::apiResource('transaksi', \App\Http\Controllers\TransaksiController::class);
Route::apiResource('user', \App\Http\Controllers\UserController::class);