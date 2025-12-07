<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\SupllierController;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

//login routes
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Dashboard — semua role bisa
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //admin+superadmin routes
    Route::middleware(['role:admin,superadmin'])->group(function () {

        Route::resource('barang', BarangController::class);
        Route::resource('kategori', KategoriBarangController::class);
        Route::resource('supplier', SupllierController::class);
        Route::resource('pembelian', PembelianController::class);
    });

    //superadmin only routes
    Route::middleware(['role:superadmin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});