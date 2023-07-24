<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class SampahDikumpulkanController extends Controller
{
  public function index(Request $request)
  {
    $perPage = $request->query('perPage', 10);
    return view('backoffice.manajemen-sampah.sampah-dikumpulkan.index', [
      'sampahDikumpulkans' => ItemTransaksi::filter(request(['search']))
        ->select('jenis-sampah_id')
        ->selectRaw('SUM(berat) as jumlah_berat')
        ->groupBy('jenis-sampah_id')
        ->paginate($perPage),
      'perPage' => $perPage,
    ]);
  }
}
