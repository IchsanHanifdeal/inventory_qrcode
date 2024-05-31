<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'auth'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/auth/register', [LoginController::class, 'register'])->name('register');
Route::post('/auth/register', [LoginController::class, 'store'])->name('store.register');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/user', [UserController::class, 'index'])->name('user');
    Route::post('/dashboard/user', [UserController::class, 'store'])->name('store.user');
    Route::delete('/dashboard/user/{id_user}', [UserController::class, 'destroy'])->name('destroy.user');
    Route::put('/dashboard/user/{id_user}', [UserController::class, 'update'])->name('update.user');

    Route::get('/dashboard/merk', [MerkController::class, 'index'])->name('merk');
    Route::post('/dashboard/merk', [MerkController::class, 'store'])->name('store.merek');
    Route::put('/dashboard/merk/{id_merk}', [MerkController::class, 'update'])->name('update.merek');

    Route::get('/dashboard/jenis', [JenisController::class, 'index'])->name('jenis');
    Route::post('/dashboard/jenis', [JenisController::class, 'store'])->name('store.jenis');
    Route::put('/dashboard/jenis/{id_jenis}', [JenisController::class, 'update'])->name('update.jenis');

    Route::get('/dashboard/barang', [BarangController::class, 'index'])->name('barang');
    Route::post('/dashboard/barang', [BarangController::class, 'store'])->name('store.barang');
    Route::put('/dashboard/barang/update/{id_barang}', [BarangController::class, 'update'])->name('update.barang');

    Route::get('/dashboard/barang_masuk', [BarangMasukController::class, 'index'])->name('barang_masuk');
    Route::post('/dashboard/barang_masuk', [BarangMasukController::class, 'store'])->name('store.barangmasuk');
    Route::put('/dashboard/barang_masuk/{id_masuk}', [BarangMasukController::class, 'update'])->name('update.barangmasuk');

    Route::get('/dashboard/barang_keluar', [BarangKeluarController::class, 'index'])->name('barang_keluar');
    Route::post('/dashboard/barang_keluar', [BarangKeluarController::class, 'store'])->name('store.barangkeluar');
    Route::put('/dashboard/barang_keluar/{id_keluar}', [BarangKeluarController::class, 'update'])->name('update.barangkeluar');
    
    Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/dashboard/profile/{id_user}', [ProfileController::class, 'update'])->name('update.profile');
    Route::put('/dashboard/profile/ubah_password/{id_user}', [ProfileController::class, 'updatePassword'])->name('update.password');
    Route::delete('/delete/{type}/{id}', [DeleteController::class, 'destroy'])->name('dynamic.delete');
});
