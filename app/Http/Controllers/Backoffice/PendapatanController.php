<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Pendapatan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PendapatanController extends Controller
{
  public function index(Request $request)
  {
    $perPage = $request->query('perPage', 10);
    $startDate = $request->query('startDate'); // Ambil tanggal mulai dari input form
    $endDate = $request->query('endDate');     // Ambil tanggal berakhir dari input form

    $query = Pendapatan::orderBy('created_at', 'desc');

    // Tambahkan kriteria tanggal jika tanggal mulai dan berakhir telah diberikan
    if ($startDate && $endDate) {
      // Gunakan Carbon untuk mengubah format tanggal sesuai kebutuhan
      $startDate = Carbon::parse($startDate)->startOfDay();
      $endDate = Carbon::parse($endDate)->endOfDay();

      $query->whereBetween('tanggal', [$startDate, $endDate]);
    }

    $pendapatans = $query->paginate($perPage);

    return view('backoffice.manajemen-keuangan.pendapatan.index', [
      'pendapatans' => $pendapatans,
      'perPage' => $perPage,
      'startDate' => $startDate, // Kirim tanggal mulai ke view
      'endDate' => $endDate     // Kirim tanggal berakhir ke view
    ]);
  }
}
