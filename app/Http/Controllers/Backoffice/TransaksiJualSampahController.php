<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use App\Models\Pendapatan;
use App\Models\Total_sampah;
use App\Models\Transaksi;
use App\Models\TransaksiJualSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TransaksiJualSampahController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $perPage = $request->query('perPage', 10);
    $transaksi = TransaksiJualSampah::orderBy('created_at', 'desc')
      ->paginate($perPage);
    return view('backoffice.manajemen-transaksi.transaksi-jual-sampah.index', [
      'transaksis' => $transaksi,
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
    $jenis_sampah = JenisSampah::where('id', '<>', 1)->get();
    return view('backoffice.manajemen-transaksi.transaksi-jual-sampah.create', [
      'jenisSampahs' => $jenis_sampah
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
      'jenis_sampah' => 'required',
      'nama' => 'required',
      'berat' => 'required'
    ], [
      'jenis_sampah.required' => "Silahkan pilih jenis sampah",
      'nama.required' => "Kolom nama wajib diisi",
      'berat.required' => "Kolom berat wajib diisi",
    ]);

    // Dapatkan data jenis sampah berdasarkan ID
    $jenisSampah = JenisSampah::find($request->input('jenis_sampah'));

    if (!$jenisSampah) {
      // Jenis sampah tidak ditemukan, berikan respon atau tindakan sesuai kebutuhan
      return redirect()->back()->with('error', 'Jenis sampah tidak ditemukan. Silakan pilih jenis sampah yang valid.');
    }

    // Hitung poin berdasarkan berat dan point pada tabel jenis sampah
    $harga = $jenisSampah->harga_per_kg * $request->input('berat');
    // dd($harga);

    $transaksiJualSampah = new TransaksiJualSampah([
      'tanggal' => now(),
      'jenis_sampah_id' => $request->input('jenis_sampah'),
      'nama' => $request->input('nama'),
      'berat' => $request->input('berat'),
      'harga' => $harga
    ]);
    // Ambil total sampah yang ada berdasarkan jenis
    $jenisSampah = $request->input('jenis_sampah');
    $beratSampahDiJual = $request->input('berat');
    $tanggal = now()->format('Y-m-d');

    $totalSampah = Total_sampah::where('jenis_sampah_id', $jenisSampah)->first();

    Pendapatan::updateOrCreate(
      ['jenis_sampah_id' => $jenisSampah, 'tanggal' => $tanggal],
      [
        'total_pendapatan' => DB::raw('total_pendapatan + ' . $harga)
      ]
    );

    if ($totalSampah) {
      // Periksa apakah berat yang dimanfaatkan tidak melebihi total berat sampah yang tersedia
      if ($beratSampahDiJual < $totalSampah->total_berat) {
        $transaksiJualSampah->save();

        // Kurangi total sampah berdasarkan jenisnya di tabel total_sampah
        $totalSampah->total_berat -= $beratSampahDiJual;
        $totalSampah->save();


        // Set flash message berhasil
        Session::flash('success', 'Data ini berhasil ditambah');
        return redirect('transaksi-jual-sampah');
      } else {
        // Jika berat yang dimanfaatkan melebihi total berat sampah yang tersedia
        return redirect()->back()->withErrors(['error' => 'Berat sampah yang dijual melebihi total berat sampah yang tersedia'])->withInput();
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
    $transaksiJualSampah = TransaksiJualSampah::findOrFail($id);
    $jenis_sampah = JenisSampah::where('id', '<>', 1)->get();
    return view('backoffice.manajemen-transaksi.transaksi-jual-sampah.edit', [
      'transaksi' => $transaksiJualSampah,
      'jenisSampahs' => $jenis_sampah,
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
    $transaksiJualSampah = TransaksiJualSampah::findOrFail($id);
    $request->validate([
      'jenis_sampah' => 'required',
      'nama' => 'required',
      'berat' => 'required'
    ], [
      'jenis_sampah.required' => "Silahkan pilih jenis sampah",
      'nama.required' => "Kolom nama wajib diisi",
      'berat.required' => "Kolom berat wajib diisi",
    ]);
    // Dapatkan data jenis sampah berdasarkan ID
    $jenisSampah = JenisSampah::find($request->input('jenis_sampah'));

    if (!$jenisSampah) {
      // Jenis sampah tidak ditemukan, berikan respon atau tindakan sesuai kebutuhan
      return redirect()->back()->with('error', 'Jenis sampah tidak ditemukan. Silakan pilih jenis sampah yang valid.');
    }

    // Hitung poin berdasarkan berat dan point pada tabel jenis sampah
    $harga = $jenisSampah->harga_per_kg * $request->input('berat');
    // dd($harga);

    $transaksiJualSampah->update([
      'tanggal' => now(),
      'jenis_sampah_id' => $request->input('jenis_sampah'),
      'nama' => $request->input('nama'),
      'berat' => $request->input('berat'),
      'harga' => $harga
    ]);
    // Ambil total sampah yang ada berdasarkan jenis
    $jenisSampah = $request->input('jenis_sampah');
    $beratSampahDiJual = $request->input('berat');

    $totalSampah = Total_sampah::where('jenis_sampah_id', $jenisSampah)->first();
    if ($totalSampah) {
      // Periksa apakah berat yang dimanfaatkan tidak melebihi total berat sampah yang tersedia
      if ($beratSampahDiJual < $totalSampah->total_berat) {
        $transaksiJualSampah->save();

        // Kurangi total sampah berdasarkan jenisnya di tabel total_sampah
        $totalSampah->total_berat -= $beratSampahDiJual;
        $totalSampah->save();

        // Set flash message berhasil
        Session::flash('success', 'Data ini berhasil diubah');
        return redirect('transaksi-jual-sampah');
      } else {
        // Jika berat yang dimanfaatkan melebihi total berat sampah yang tersedia
        return redirect()->back()->withErrors(['error' => 'Berat sampah yang dijual melebihi total berat sampah yang tersedia'])->withInput();
      }
    } else {
      return redirect()->back()->withErrors(['error' => 'Jenis sampah tidak ditemukan. Silakan pilih jenis sampah yang valid.'])->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $transaksiJualSampah = TransaksiJualSampah::findOrFail($id);

    // Hapus data RW
    $transaksiJualSampah->delete();

    // Set flash message berhasil
    Session::flash('success', 'Data ini berhasil dihapus');

    return redirect('/transaksi-jual-sampah');
  }
}
