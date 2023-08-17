<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\KategoriSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KategoriSampahController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $perPage = $request->query('perPage', 10);
    return view('backoffice.data-referensi.kategori-sampah.index', [
      'kategoriSampahs' => KategoriSampah::filter(request(['search']))->paginate($perPage),
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
    return view('backoffice.data-referensi.kategori-sampah.create');
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
      'name' => 'required|unique:kategori_sampahs',
      'deskripsi' => 'required',
    ], [
      'name.required' => 'Kolom kategori wajib diisi',
      'name.unique' => 'Kategori tersebut sudah ada',
      'deskripsi.required' => 'Kolom deskripsi wajib diisi',
    ]);

    $kategoriSampah = new KategoriSampah([
      'name' => $request->input('name'),
      'deskripsi' => $request->input('deskripsi'),
    ]);

    $kategoriSampah->save();
    // Set flash message berhasil
    Session::flash('success', 'Data kategori sampah berhasil ditambah');

    return redirect('/kategori-sampah');
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
    $kategoriSampah = KategoriSampah::findOrFail($id);
    return view('backoffice.data-referensi.kategori-sampah.edit', [
      'kategoriSampah' => $kategoriSampah
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
    $kategoriSampah = KategoriSampah::findOrFail($id);

    $request->validate([
      'name' => 'required|unique:kategori_sampahs,name,'.$id,
      'deskripsi' => 'required',
    ], [
      'name.required' => 'Kolom kategori wajib diisi',
      'name.unique' => 'Kategori tersebut sudah ada',
      'deskripsi.required' => 'Kolom deskripsi wajib diisi',
    ]);

    $kategoriSampah->update([
      'name' => $request->input('name'),
      'deskripsi' => $request->input('deskripsi'),
    ]);

    // Set flash message berhasil
    Session::flash('success', 'Data kategori sampah berhasil diubah');

    return redirect('/kategori-sampah');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $kategoriSampah = KategoriSampah::findOrFail($id);

    // Hapus data Kategori Sampah
    $kategoriSampah->delete();

    // Set flash message berhasil
    Session::flash('success', 'Data kategori sampah berhasil dihapus');

    return redirect('/kategori-sampah');
  }
}