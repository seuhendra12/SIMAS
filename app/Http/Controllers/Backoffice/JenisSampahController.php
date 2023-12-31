<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use App\Models\KategoriSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JenisSampahController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $perPage = $request->query('perPage', 10);
    $kategoriSampah = KategoriSampah::get();
    return view('backoffice.manajemen-sampah.jenis-sampah.index', [
      'jenisSampahs' => JenisSampah::filter(request(['search']))->paginate($perPage),
      'perPage' => $perPage,
      'kategoriSampahs' => $kategoriSampah,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $kategoriSampahs = KategoriSampah::get();
    return view('backoffice.manajemen-sampah.jenis-sampah.create', [
      'kategoriSampahs' => $kategoriSampahs
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
      'name' => 'required|unique:jenis_sampahs',
      'kategori_sampah' => 'required',
      'point_perkg' => 'required',
      'harga_per_kg' => 'required',
    ], [
      'name.required' => 'Kolom jenis sampah wajib diisi',
      'kategori_sampah.required' => 'Kolom kategori sampah wajib diisi',
      'point_perkg.required' => 'Kolom poin wajib diisi',
      'harga_per_kg.required' => 'Kolom harga jual wajib diisi',
      'name.unique' => 'Jenis sampah tersebut sudah ada',
    ]);

    $jenisSampah = new JenisSampah([
      'name' => $request->input('name'),
      'point_perkg' => $request->input('point_perkg'),
      'harga_per_kg' => $request->input('harga_per_kg'),
      'kategori_sampah_id' => $request->input('kategori_sampah'),
    ]);

    $jenisSampah->save();
    // Set flash message berhasil
    Session::flash('success', 'Data jenis sampah berhasil ditambah');

    return redirect('/jenis-sampah');
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
    $jenisSampah = JenisSampah::findOrFail($id);
    return view('backoffice.manajemen-sampah.jenis-sampah.edit', [
      'jenisSampah' => $jenisSampah,
      'kategoriSampahs' => KategoriSampah::get()
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
    $jenisSampah = JenisSampah::findOrFail($id);
    $request->validate([
      'name' => 'required|unique:jenis_sampahs,name,' . $id,
      'kategori_sampah' => 'required',
      'point_perkg' => 'required',
      'harga_per_kg' => 'required',
    ], [
      'name.required' => 'Kolom jenis sampah wajib diisi',
      'kategori_sampah.required' => 'Kolom kategori sampah wajib diisi',
      'point_perkg.required' => 'Kolom poin wajib diisi',
      'harga_per_kgr.required' => 'Kolom harga jual wajib diisi',
      'name.unique' => 'Jenis sampah tersebut sudah ada',
    ]);

    $jenisSampah->update([
      'name' => $request->input('name'),
      'point_perkg' => $request->input('point_perkg'),
      'harga_per_kg' => $request->input('harga_per_kg'),
      'kategori_sampah_id' => $request->input('kategori_sampah'),
    ]);

    // Set flash message berhasil
    Session::flash('success', 'Data jenis sampah berhasil diubah');

    return redirect('/jenis-sampah');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $jenisSampah = JenisSampah::findOrFail($id);

    // Hapus data Kategori Sampah
    $jenisSampah->delete();

    // Set flash message berhasil
    Session::flash('success', 'Data jenis sampah berhasil dihapus');

    return redirect('/jenis-sampah');
  }
}