<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaksi;
use App\Models\Total_sampah;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class SampahDikumpulkanController extends Controller
{
  public function index(Request $request)
  {
    $perPage = $request->query('perPage', 10);
    return view('backoffice.manajemen-sampah.sampah-dikumpulkan.index', [
      'sampahDikumpulkans' => Total_sampah::paginate($perPage),
      'perPage' => $perPage,
    ]);
  }
}
