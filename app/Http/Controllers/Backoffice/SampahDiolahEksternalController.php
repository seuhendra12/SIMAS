<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use App\Models\SampahDiolahEksternal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SampahDiolahEksternalController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $perPage = $request->query('perPage', 10);

    return view('backoffice.manajemen-sampah.sampah-diolah-eksternal.index', [
      'sampahDiolahEksternals' => SampahDiolahEksternal::filter(request(['search']))
        ->orderBy('sampah_diolah_eksternals.created_at', 'desc') // Sebutkan tabelnya dengan jelas
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
    return view('backoffice.manajemen-sampah.sampah-diolah-eksternal.create', [
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

    $sampahDiolahEksternal = new SampahDiolahEksternal([
      'petugas_id' => $request->input('petugas'),
      'jenis_sampah_id' => $request->input('jenis_sampah'),
      'berat' => $request->input('berat'),
      'tanggal_diolah' => $request->input('tanggal_diolah'),
      'keterangan' => $request->input('keterangan'),
      'lokasi_diolah' => $request->input('lokasi'),
    ]);

    $sampahDiolahEksternal->save();
    // Set flash message berhasil
    Session::flash('success', 'Data berhasil ditambah');

    return redirect('sampah-diolah-eksternal');
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
    $sampahDiolahEksternal = SampahDiolahEksternal::findOrFail($id);
    return view('backoffice.manajemen-sampah.sampah-diolah-eksternal.edit', [
      'sampahDiolahEksternal' => $sampahDiolahEksternal,
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
    $sampahDiolahEksternal = SampahDiolahEksternal::findOrFail($id);

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

    $sampahDiolahEksternal->update([
      'petugas_id' => $request->input('petugas'),
      'jenis_sampah_id' => $request->input('jenis_sampah'),
      'berat' => $request->input('berat'),
      'tanggal_diolah' => $request->input('tanggal_diolah'),
      'lokasi_diolah' => $request->input('lokasi'),
      'keterangan' => $request->input('keterangan'),
      'status' => $request->input('status'),
    ]);

    // Set flash message berhasil
    Session::flash('success', 'Data berhasil diubah');

    return redirect('sampah-diolah-eksternal');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $sampahDiolahEksternal = SampahDiolahEksternal::findOrFail($id);

    // Hapus data RW
    $sampahDiolahEksternal->delete();

    // Set flash message berhasil
    Session::flash('success', 'Data berhasil dihapus');

    return redirect('/sampah-diolah-eksternal');
  }
}
