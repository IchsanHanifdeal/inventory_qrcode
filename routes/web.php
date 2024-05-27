<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
<<<<<<< HEAD
Route::get('/auth/register', [LoginController::class, 'register'])->name('register');
=======
Route::get('/register', [LoginController::class, 'register'])->name('register');
>>>>>>> 0c972f6e41b3ec7099adb70a7485e5a3c1f1381e
