<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\TukarPoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TukarPoinController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $perPage = $request->query('perPage', 10);

    return view('backoffice.manajemen-transaksi.tukar-poin.index', [
      'tukarPoins' => TukarPoin::filter(request(['search']))
        ->orderBy('tukar_poins.updated_at', 'desc') // Menampilkan data terbaru berdasarkan tanggal transaksi di tabel Transaksi
        ->paginate($perPage),
      'perPage' => $perPage,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
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
    $tukarPoin = TukarPoin::findOrFail($id);
    return view('backoffice.manajemen-transaksi.tukar-poin.edit', [
      'tukarPoin' => $tukarPoin
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
    $tukarPoin = TukarPoin::findOrFail($id);

    $request->validate([
      'status' => 'required',
    ]);

    $tukarPoin->update([
      'status' => $request->input('status'),
    ]);

    // Set flash message berhasil
    Session::flash('success', 'Status berhasil diubah');

    return redirect('/tukar-poin-admin');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $tukarPoin = TukarPoin::findOrFail($id);

      // Hapus data tukar poin
      $tukarPoin->delete();

      // Set flash message berhasil
      Session::flash('success', 'Data berhasil dihapus');

      return redirect('/tukar-poin-admin');
  }
}
