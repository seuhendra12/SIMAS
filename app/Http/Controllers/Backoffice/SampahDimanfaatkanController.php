<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaksi;
use App\Models\JenisSampah;
use App\Models\SampahDimanfaatkan;
use App\Models\Total_sampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SampahDimanfaatkanController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $perPage = $request->query('perPage', 10);

    return view('backoffice.manajemen-sampah.sampah-dimanfaatkan.index', [
      'sampahDimanfaatkans' => SampahDimanfaatkan::filter(request(['search']))
        ->orderBy('sampah_dimanfaatkans.updated_at', 'desc') // Sebutkan tabelnya dengan jelas
        ->paginate($perPage),
      'perPage' => $perPage
    ]);
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('backoffice.manajemen-sampah.sampah-dimanfaatkan.create', [
      'jenisSampahs' => JenisSampah::get(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'petugas' => 'required',
      'jenis_sampah' => 'required',
      'berat' => 'required',
      'tanggal_dimanfaatkan' => 'required',
      'keterangan' => 'required',
    ], [
      'jenis_sampah.required' => 'Kolom jenis sampah wajib diisi',
      'berat.required' => 'Kolom berat wajib diisi',
      'tanggal_dimanfaatkan.required' => 'Kolom tanggal wajib diisi',
      'keterangan.required' => 'Kolom keterangan wajib diisi',
    ]);

    $sampahDimanfaatkan = new SampahDimanfaatkan([
      'petugas_id' => $request->input('petugas'),
      'jenis_sampah_id' => $request->input('jenis_sampah'),
      'berat' => $request->input('berat'),
      'tanggal_dimanfaatkan' => $request->input('tanggal_dimanfaatkan'),
      'keterangan' => $request->input('keterangan'),
    ]);
    // Ambil total sampah yang ada berdasarkan jenis
    $jenisSampah = $request->input('jenis_sampah');
    $beratSampahDimanfaatkan = $request->input('berat');

    $totalSampah = Total_sampah::where('jenis_sampah_id', $jenisSampah)->first();
    if ($totalSampah) {
      // Periksa apakah berat yang dimanfaatkan tidak melebihi total berat sampah yang tersedia
      if ($beratSampahDimanfaatkan < $totalSampah->total_berat) {
        $sampahDimanfaatkan->save();

        // Kurangi total sampah berdasarkan jenisnya di tabel total_sampah
        $totalSampah->total_berat -= $beratSampahDimanfaatkan;
        $totalSampah->save();

        // Set flash message berhasil
        Session::flash('success', 'Data ini berhasil ditambah');
        return redirect('sampah-dimanfaatkan');
      } else {
        // Jika berat yang dimanfaatkan melebihi total berat sampah yang tersedia
        return redirect()->back()->withErrors(['error' => 'Berat sampah yang dimanfaatkan melebihi total berat sampah yang tersedia'])->withInput();
      }
    } else {
      return redirect()->back()->withErrors(['error' => 'Jenis sampah tidak ditemukan. Silakan pilih jenis sampah yang valid.'])->withInput();
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $sampahDimanfaatkan = SampahDimanfaatkan::findOrFail($id);
    return view('backoffice.manajemen-sampah.sampah-dimanfaatkan.edit', [
      'sampahDimanfaatkan' => $sampahDimanfaatkan,
      'jenisSampahs' => JenisSampah::get()
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $sampahDimanfaatkan = SampahDimanfaatkan::findOrFail($id);

    $request->validate([
      'petugas' => 'required',
      'jenis_sampah' => 'required',
      'berat' => 'required',
      'tanggal_dimanfaatkan' => 'required',
      'keterangan' => 'required',
      'status' => 'required',
    ], [
      'jenis_sampah.required' => 'Kolom jenis sampah wajib diisi',
      'berat.required' => 'Kolom berat wajib diisi',
      'tanggal_dimanfaatkan.required' => 'Kolom tanggal wajib diisi',
      'keterangan.required' => 'Kolom keterangan wajib diisi',
      'status.required' => 'Kolom status wajib diisi',
    ]);

    $sampahDimanfaatkan->update([
      'petugas_id' => $request->input('petugas'),
      'jenis_sampah_id' => $request->input('jenis_sampah'),
      'berat' => $request->input('berat'),
      'tanggal_dimanfaatkan' => $request->input('tanggal_dimanfaatkan'),
      'keterangan' => $request->input('keterangan'),
      'status' => $request->input('status'),
    ]);

    // Set flash message berhasil
    Session::flash('success', 'Data ini berhasil diubah');

    return redirect('sampah-dimanfaatkan');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $sampahDimanfaatkan = SampahDimanfaatkan::findOrFail($id);

    // Hapus data RW
    $sampahDimanfaatkan->delete();

    // Set flash message berhasil
    Session::flash('success', 'Data ini berhasil dihapus');

    return redirect('/sampah-dimanfaatkan');
  }
}
