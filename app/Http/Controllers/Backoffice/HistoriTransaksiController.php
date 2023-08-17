<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HistoriTransaksiController extends Controller
{
  public function histori(Request $request, $id)
  {
    $transaksiSampah = Transaksi::findOrFail($id);
    $perPage = $request->query('perPage', 10);
    // Mengambil item transaksi dan melakukan agregasi berat berdasarkan jenis sampah
    $itemTransaksis = ItemTransaksi::with('jenisSampah')
      ->where('transaksi_id', $id) // Urutkan berdasarkan jenis_sampah_id
      ->orderBy('updated_at', 'desc')
      ->paginate($perPage);

    return view('backoffice.manajemen-transaksi.transaksi-sampah.histori', [
      'transaksiSampahs' => $transaksiSampah,
      'itemTransaksis' => $itemTransaksis,
      'perPage' => $perPage
    ]);
  }
}
