<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaksi;
use Illuminate\Http\Request;

class SampahDibuangKeTPAController extends Controller
{
  public function index(Request $request)
  {
    return view('backoffice.manajemen-sampah.sampah-dibuang.index', [
      'sampahDibuangs' => ItemTransaksi::selectRaw('jenis_sampah_id, SUM(berat) as jumlah_berat')
        ->where('jenis_sampah_id', 1)
        ->groupBy('jenis_sampah_id')
        ->get()
    ]);
  }
}
