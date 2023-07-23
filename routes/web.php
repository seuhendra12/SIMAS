<?php

use App\Http\Controllers\Backoffice\AuthController;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\HistoriTransaksi;
use App\Http\Controllers\Backoffice\HistoriTransaksiController;
use App\Http\Controllers\Backoffice\ItemTransaksiController;
use App\Http\Controllers\Backoffice\JenisSampahController;
use App\Http\Controllers\Backoffice\KategoriSampahController;
use App\Http\Controllers\Backoffice\NilaiKonversiController;
use App\Http\Controllers\Backoffice\PenggunaController;
use App\Http\Controllers\Backoffice\RoleController;
use App\Http\Controllers\Backoffice\RTController;
use App\Http\Controllers\Backoffice\RWController;
use App\Http\Controllers\Backoffice\TransaksiSampahController;
use App\Http\Controllers\Backoffice\TukarPoinController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Models\TukarPoin;
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

  // Manajemen Transaksi
  Route::resource('/transaksi-sampah', TransaksiSampahController::class);
  Route::get('/item-transaksi/{id}', [ItemTransaksiController::class, 'indexWithId']);
  Route::get('/item-transaksi/{id}/create', [ItemTransaksiController::class, 'create']);
  Route::post('/item-transaksi/store', [ItemTransaksiController::class, 'store']);
  Route::get('/histori-transaksi/{id}', [HistoriTransaksiController::class, 'histori']);
  Route::resource('/konversi-poin', NilaiKonversiController::class);
  Route::resource('/tukar-poin-admin', TukarPoinController::class);
});

Route::get('/', [FrontendController::class, 'index']);
Route::middleware('auth')->group(function () {
  Route::get('/profile/{id}', [FrontendController::class, 'profile']);
  Route::put('/simpan_profile/{id}', [FrontendController::class, 'simpan_profile']);
  Route::get('/tukar-poin/{id}', [FrontendController::class, 'tukar_poin']);
  Route::post('/simpan-tukar-poin/{id}', [FrontendController::class, 'simpan_tukar_poin']);
  Route::get('/histori-transaksi', [FrontendController::class, 'histori']);
  Route::get('/cetak-struk/{id}', [FrontendController::class, 'cetak_struk'])->name('cetak.struk');
});
