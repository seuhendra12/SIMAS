<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaksi;
use App\Models\JenisSampah;
use App\Models\SampahDimanfaatkan;
use App\Models\SampahDiolahEksternal;
use App\Models\SampahDiolahInternal;
use App\Models\Total_sampah;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $total_berat = ItemTransaksi::where('jenis_sampah_id', 1)->sum('berat');
    return view('backoffice.index', [
      'jenis_sampah' => JenisSampah::get(),
      'transaksi_sampah' => Transaksi::get(),
      'sampah_dimanfaatkan' => SampahDimanfaatkan::get(),
      'sampah_diolah_internal' => SampahDiolahInternal::get(),
      'sampah_diolah_eksternal' => SampahDiolahEksternal::get(),
      'total_sampah' => Total_sampah::get(),
      'total_berat' => $total_berat,
    ]);
  }
}
