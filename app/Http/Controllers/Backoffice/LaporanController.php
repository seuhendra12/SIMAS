<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaksi;
use App\Models\SampahDimanfaatkan;
use App\Models\SampahDiolahEksternal;
use App\Models\SampahDiolahInternal;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class LaporanController extends Controller
{
  public function laporan_sampah_dikumpulkan(Request $request)
  {
    $perPage = $request->query('perPage', 10);
    return view('backoffice.report.laporan_sampah_dikumpulkan', [
      'sampahDikumpulkans' => ItemTransaksi::filter(request(['search']))
        ->select('jenis_sampah_id')
        ->selectRaw('SUM(berat) as jumlah_berat')
        ->groupBy('jenis_sampah_id')
        ->paginate($perPage),
      'perPage' => $perPage,
    ]);
  }

  public function laporan_sampah_dimanfaatkan(Request $request)
  {
    $perPage = $request->query('perPage', 10);

    return view('backoffice.report.laporan_sampah_dimanfaatkan', [
      'sampahDimanfaatkans' => SampahDimanfaatkan::filter(request(['search']))
        ->orderBy('sampah_dimanfaatkans.updated_at', 'desc') // Sebutkan tabelnya dengan jelas
        ->paginate($perPage),
      'perPage' => $perPage
    ]);
  }

  public function laporan_sampah_diolah_internal(Request $request)
  {
    $perPage = $request->query('perPage', 10);

    return view('backoffice.report.laporan_sampah_diolah_internal', [
        'sampahDiolahInternals' => SampahDiolahInternal::filter(request(['search']))
            ->orderBy('sampah_diolah_internals.created_at', 'desc') // Sebutkan tabelnya dengan jelas
            ->paginate($perPage),
        'perPage' => $perPage
    ]);
  }

  public function laporan_sampah_diolah_eksternal(Request $request)
  {
    $perPage = $request->query('perPage', 10);

    return view('backoffice.report.laporan_sampah_diolah_eksternal', [
      'sampahDiolahEksternals' => SampahDiolahEksternal::filter(request(['search']))
        ->orderBy('sampah_diolah_eksternals.created_at', 'desc') // Sebutkan tabelnya dengan jelas
        ->paginate($perPage),
      'perPage' => $perPage
    ]);
  }

  public function cetak_sampah_dikumpulkan()
  {
    // Ambil data transaksi berdasarkan RW dan RT serta kolom total_berat
    $dataPerRW = Transaksi::with('user.profile')
      ->get()
      ->groupBy(function ($transaksi) {
        // Mengelompokkan data berdasarkan id RW dan RT yang ada pada profil pengguna
        return $transaksi->user->profile->rw_id;
      })
      ->map(function ($dataRW) {
        // Mengelompokkan data RT yang unik untuk setiap RW
        return $dataRW->groupBy('user.profile.rt_id');
      });


    $pdf = new Dompdf(); // Buat instance baru dari Dompdf

    // Kirim data tukarPoin ke view
    $pdf->loadHtml(view('backoffice.cetak-laporan.cetak_sampah_dikumpulkan', compact('dataPerRW')));

    // (Opsional) Set ukuran kertas dan orientasi
    $pdf->setPaper('A4', 'portrait');

    // Render PDF
    $pdf->render();

    // Tampilkan PDF yang dihasilkan langsung di browser
    $pdf->stream('laporan_sampah_dikumpulkan' . '.pdf');
  }
}
