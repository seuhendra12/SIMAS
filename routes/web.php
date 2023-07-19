<?php

use App\Http\Controllers\Backoffice\AuthController;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\ItemTransaksiController;
use App\Http\Controllers\Backoffice\JenisSampahController;
use App\Http\Controllers\Backoffice\KategoriSampahController;
use App\Http\Controllers\Backoffice\PenggunaController;
use App\Http\Controllers\Backoffice\RoleController;
use App\Http\Controllers\Backoffice\RTController;
use App\Http\Controllers\Backoffice\RWController;
use App\Http\Controllers\Backoffice\TransaksiSampahController;
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



Route::middleware(['afterLogin'])->group(function () {
  Route::get('/login', [AuthController::class, 'index_login'])->name('login');
  Route::post('/login', [AuthController::class, 'login']);
  Route::get('/registrasi', [AuthController::class, 'index_registrasi']);
  Route::post('/registrasi', [AuthController::class, 'register']);
});
Route::post('logout', [AuthController::class, 'logout']);



Route::middleware(['role:Pengelola', 'auth'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  // Data Referensi
  Route::resource('/data-rt', RTController::class);
  Route::resource('/data-rw', RWController::class);
  Route::resource('/kategori-sampah', KategoriSampahController::class);

  // Manajemen Pengguna
  Route::get('/get-user-name', [PenggunaController::class, 'getUserName'])->name('getUserName');
  Route::resource('/data-pengguna', PenggunaController::class);
  Route::get('/data-role', [RoleController::class, 'index']);

  // Manajemen Sampah
  Route::resource('/jenis-sampah', JenisSampahController::class);
  Route::resource('/transaksi-sampah', TransaksiSampahController::class);
  Route::get('/item-transaksi/{id}', [ItemTransaksiController::class, 'indexWithId']);
  Route::get('/item-transaksi/{id}/create', [ItemTransaksiController::class, 'create']);
  Route::post('/item-transaksi/store', [ItemTransaksiController::class, 'store']);
});

Route::get('/', [FrontendController::class, 'index']);
Route::get('/profile/{id}', [FrontendController::class, 'profile'])->middleware('auth');
Route::put('/simpan_profile/{id}', [FrontendController::class, 'simpan_profile'])->middleware('auth');
