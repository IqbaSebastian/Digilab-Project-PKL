<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\WishlistController;

Route::get('/', function () {
    return view('dashboard');
});

// --- AUTHENTICATION ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- GRUP MIDDLEWARE LOGIN ---
Route::middleware('auth.login')->group(function () {

    // DAFTAR BUKU
    Route::get('/buku', [BukuController::class, 'index']);

    // CRUD BUKU (Hanya Petugas)
    Route::middleware('auth.petugas')->group(function () {
        Route::get('/buku/create', [BukuController::class, 'create']); 
        Route::post('/buku', [BukuController::class, 'store']);
        Route::get('/buku/{buku}/edit', [BukuController::class, 'edit']);
        Route::put('/buku/{buku}', [BukuController::class, 'update']);
        Route::delete('/buku/{buku}', [BukuController::class, 'destroy']);
    });

    Route::get('/buku/{buku}', [BukuController::class, 'show']);

    // PEMINJAMAN
    Route::get('/pinjam', [PinjamController::class, 'index']);
    Route::get('/pinjam/create', [PinjamController::class, 'create']);
    Route::post('/pinjam', [PinjamController::class, 'store']);

    // KONFIRMASI PENGEMBALIAN (Hanya Petugas)
    Route::middleware('auth.petugas')->group(function () {
        Route::put('/pinjam/{pinjam}/kembalikan', [PinjamController::class, 'kembalikan']);
    });

    // --- FITUR WISHLIST ---
    // Gunakan auth.login, bukan auth bawaan Laravel
    Route::post('/wishlist/toggle/{idBuku}', [WishlistController::class, 'toggle'])->middleware('auth.login');
    Route::get('/wishlist', [WishlistController::class, 'index'])->middleware('auth.login');
});