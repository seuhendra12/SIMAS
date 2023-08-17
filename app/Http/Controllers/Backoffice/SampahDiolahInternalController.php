<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use App\Models\SampahDiolahInternal;
use App\Models\Total_sampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SampahDiolahInternalController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $perPage = $request->query('perPage', 10);

    return view('backoffice.manajemen-sampah.sampah-diolah-internal.index', [
      'sampahDiolahInternals' => SampahDiolahInternal::filter(request(['search']))
        ->orderBy('sampah_diolah_internals.created_at', 'desc') // Sebutkan tabelnya dengan jelas
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
    return view('backoffice.manajemen-sampah.sampah-diolah-internal.create', [
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
      'tanggal_diolah' => 'required',
      'lokasi' => 'required',
      'keterangan' => 'required',
    ], [
      'jenis_sampah.required' => 'Kolom jenis sampah wajib diisi',
      'berat.required' => 'Kolom berat wajib diisi',
      'tanggal_diolah.required' => 'Kolom tanggal wajib diisi',
      'keterangan.required' => 'Kolom keterangan wajib diisi',
      'lokasi.required' => 'Kolom lokasi wajib diisi',
    ]);

    $sampahDiolahInternal = new SampahDiolahInternal([
      'petugas_id' => $request->input('petugas'),
      'jenis_sampah_id' => $request->input('jenis_sampah'),
      'berat' => $request->input('berat'),
      'tanggal_diolah' => $request->input('tanggal_diolah'),
      'keterangan' => $request->input('keterangan'),
      'lokasi_diolah' => $request->input('lokasi'),
    ]);

    // Ambil total sampah yang ada berdasarkan jenis
    $jenisSampah = $request->input('jenis_sampah');
    $beratSampahDiolahInternal = $request->input('berat');

    $totalSampah = Total_sampah::where('jenis_sampah_id', $jenisSampah)->first();
    if ($totalSampah) {
      // Periksa apakah berat yang dimanfaatkan tidak melebihi total berat sampah yang tersedia
      if ($beratSampahDiolahInternal < $totalSampah->total_berat) {
        $sampahDiolahInternal->save();

        // Kurangi total sampah berdasarkan jenisnya di tabel total_sampah
        $totalSampah->total_berat -= $beratSampahDiolahInternal;
        $totalSampah->save();

        // Set flash message berhasil
        Session::flash('success', 'Data ini berhasil ditambah');
        return redirect('sampah-diolah-internal');
      } else {
        // Jika berat yang diolah melebihi total berat sampah yang tersedia
        return redirect()->back()->withErrors(['error' => 'Berat sampah yang diolah melebihi total berat sampah yang tersedia'])->withInput();
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
    $sampahDiolahInternal = SampahDiolahInternal::findOrFail($id);
    return view('backoffice.manajemen-sampah.sampah-diolah-internal.edit', [
      'sampahDiolahInternal' => $sampahDiolahInternal,
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
    $sampahDiolahInternal = SampahDiolahInternal::findOrFail($id);

    $request->validate([
      'petugas' => 'required',
      'jenis_sampah' => 'required',
      'berat' => 'required',
      'tanggal_diolah' => 'required',
      'keterangan' => 'required',
      'lokasi' => 'required',
      'status' => 'required',
    ], [
      'jenis_sampah.required' => 'Kolom jenis sampah wajib diisi',
      'berat.required' => 'Kolom berat wajib diisi',
      'tanggal_diolah.required' => 'Kolom tanggal wajib diisi',
      'keterangan.required' => 'Kolom keterangan wajib diisi',
      'lokasi.required' => 'Kolom lokasi wajib diisi',
      'status.required' => 'Kolom status wajib diisi',
    ]);

    $sampahDiolahInternal->update([
      'petugas_id' => $request->input('petugas'),
      'jenis_sampah_id' => $request->input('jenis_sampah'),
      'berat' => $request->input('berat'),
      'tanggal_diolah' => $request->input('tanggal_diolah'),
      'lokasi_diolah' => $request->input('lokasi'),
      'keterangan' => $request->input('keterangan'),
      'status' => $request->input('status'),
    ]);

    // Set flash message berhasil
    Session::flash('success', 'Data ini berhasil diubah');

    return redirect('sampah-diolah-internal');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $sampahDiolahInternal = SampahDiolahInternal::findOrFail($id);

    // Hapus data RW
    $sampahDiolahInternal->delete();

    // Set flash message berhasil
    Session::flash('success', 'Data ini berhasil dihapus');

    return redirect('/sampah-diolah-internal');
  }
}
