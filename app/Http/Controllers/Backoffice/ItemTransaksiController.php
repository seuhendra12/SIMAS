<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaksi;
use App\Models\JenisSampah;
use App\Models\Transaksi;
use App\Models\TukarPoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ItemTransaksiController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  public function indexWithId(Request $request, $id)
  {
    $transaksiSampah = Transaksi::find($id);
    $perPage = $request->query('perPage', 10);
    return view('backoffice.manajemen-transaksi.item-transaksi.index', [
      'itemTransaksis' => ItemTransaksi::filter(request(['search']))->paginate($perPage),
      'perPage' => $perPage,
      'transakasiSampah' => $transaksiSampah,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($id)
  {
    $transaksiId = Transaksi::findOrFail($id);
    return view('backoffice.manajemen-transaksi.item-transaksi.create', [
      'jenisSampahs' => JenisSampah::get(),
      'transaksiId' => $transaksiId
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
          'transaksi_id' => 'required',
          'jenis_sampah' => 'required',
          'berat' => 'required',
      ], [
          'berat.required' => 'Kolom berat wajib diisi',
      ]);
  
      // Dapatkan data jenis sampah berdasarkan ID
      $jenisSampah = JenisSampah::find($request->input('jenis_sampah'));
  
      if (!$jenisSampah) {
          // Jenis sampah tidak ditemukan, berikan respon atau tindakan sesuai kebutuhan
          return redirect()->back()->with('error', 'Jenis sampah tidak ditemukan. Silakan pilih jenis sampah yang valid.');
      }
  
      // Hitung poin berdasarkan berat dan point pada tabel jenis sampah
      $poin = $jenisSampah->point_perkg * $request->input('berat');
  
      $itemTransaksi = new ItemTransaksi([
          'transaksi_id' => $request->input('transaksi_id'),
          'jenis_sampah_id' => $request->input('jenis_sampah'), // Simpan ID jenis sampah yang terkait
          'berat' => $request->input('berat'),
          'point' => $poin, // Simpan hasil perhitungan poin ke kolom jumlah_point
      ]);
  
      $itemTransaksi->save();
  
      $transaksi = Transaksi::find($request->input('transaksi_id'));
      $transaksi->total_berat = $transaksi->items()->sum('berat');

      $totalPointSebelumnya = $transaksi->items()->sum('point');
  
      // Dapatkan total poin yang telah dikonversikan berdasarkan id_transaksi pada tabel TukarPoin
      $totalPoinDitukarkan = TukarPoin::where('transaksi_id', $request->input('transaksi_id'))->sum('total_konversi');
  
      // Hitung total poin yang tersisa (total_poin - total_poin yang sudah dikonversikan)
      $sisaTotalPoin  = $totalPointSebelumnya - $totalPoinDitukarkan;
  
      // Simpan total poin yang tersisa ke dalam kolom total_point pada tabel Transaksi
      $transaksi->total_point = $sisaTotalPoin;
      $transaksi->tanggal_transaksi = now();
      $transaksi->save();
  
      // Set flash message berhasil
      Session::flash('success', 'Data item berhasil ditambah');
  
      return redirect('/transaksi-sampah');
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
    //
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
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
