<?php

use App\Http\Controllers\Backoffice\AuthController;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\PenggunaController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/login', [AuthController::class, 'index_login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('logout', [AuthController::class,'logout'])->middleware('auth');
Route::get('/registrasi', [AuthController::class, 'index_registrasi']);

// Manajemen Pengguna
Route::resource('/data-pengguna', PenggunaController::class)->middleware('auth');

// FRONTEND
Route::get('/sistem-informasi-manajemen-sampah', [FrontendController::class, 'index']);