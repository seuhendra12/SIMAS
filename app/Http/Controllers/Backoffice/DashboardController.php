<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use App\Models\SampahDimanfaatkan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    return view('backoffice.index',[
      'jenis_sampah' => JenisSampah::get(),
      'transaksi_sampah' => Transaksi::get(),
      'sampah_dimanfaatkan' => SampahDimanfaatkan::get(),
    ]);
  }
}
