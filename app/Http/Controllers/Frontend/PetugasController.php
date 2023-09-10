<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaksi;
use App\Models\JenisSampah;
use App\Models\SampahDimanfaatkan;
use App\Models\SampahDiolahEksternal;
use App\Models\SampahDiolahInternal;
use App\Models\Total_sampah;
use App\Models\Transaksi;
use App\Models\TukarPoin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PetugasController extends Controller
{
  public function index(Request $request)
  {
    $perPage = $request->query('perPage', 10);
    $jenisSampah = JenisSampah::get();
    return view('frontend.petugas', [
      'transaksiSampahs' => Transaksi::filter(request(['search']))
        ->where('petugas_id', Auth::user()->id)
        ->orderBy('transaksis.updated_at', 'desc') // Menampilkan data terbaru berdasarkan tanggal transaksi di tabel Transaksi
        ->paginate($perPage),
      'jenisSampahs' => $jenisSampah,
      'perPage' => $perPage,
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      // 'user_id' => 'unique:transaksis',
      'tanggal_transaksi' => 'required',
    ], [
      // 'user_id.unique' => 'Data tersebut sudah ada',
      'tanggal_transaksi.required' => 'Kolom tanggal wajib diisi',
    ]);

    // Ambil kode_aplikasi dari tabel Profile berdasarkan user_id
    $user = User::find($request->input('user_id'));

    if (!$user) {
      return redirect('/transaksi-sampah')->withErrors(['user_id' => 'User tidak ditemukan']);
    }

    $profile = $user->profile;
    if (!$profile) {
      return redirect('/transaksi-sampah')->withErrors(['user_id' => 'Profile tidak ditemukan']);
    }

    $kode_simas = $profile->kode_simas;
    $kode_transaksi = 'TRA' . $kode_simas;

    $existingTransaction = Transaksi::where('kode_transaksi', $kode_transaksi)
      ->first();

    if ($existingTransaction) {
      $existingTransaction->update([
        'user_id' => $request->input('user_id'),
        'tanggal_transaksi' => $request->input('tanggal_transaksi'),
        'petugas_id' => Auth::user()->id,
        'status' => 0,
      ]);
    } else {
      $newTransaction = Transaksi::create([
        'kode_transaksi' => $kode_transaksi,
        'user_id' => $request->input('user_id'),
        'tanggal_transaksi' => $request->input('tanggal_transaksi'),
        'petugas_id' => Auth::user()->id,
        'status' => 0,
      ]);
    }
    // Set flash message berhasil
    Session::flash('success', 'Data transaksi berhasil ditambah');

    return redirect()->back();
  }

  public function tambahItem(Request $request)
  {
    $request->validate([
      'transaksi_id' => 'required',
      'jenis_sampah' => 'required',
      'berat' => 'required',
    ], [
      'jenis_sampah.required' => 'Kolom jenis sampah wajib diisi',
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
    if (Auth::user()->role === 'Admin' && Auth::user()->role === 'Superadmin') {
      $status = 1;
    } else {
      $status = 0;
    }

    $transaksi->total_point = $sisaTotalPoin;
    $transaksi->tanggal_transaksi = now();
    $transaksi->petugas_id = Auth::user()->id;
    $transaksi->status = $status;
    $transaksi->save();

    $jenisSampahList = ItemTransaksi::select('jenis_sampah_id', DB::raw('SUM(berat) as total_berats'))
      ->groupBy('jenis_sampah_id')
      ->get();

    foreach ($jenisSampahList as $jenisSampah) {
      $sampahDimanfaatkan = SampahDimanfaatkan::where('jenis_sampah_id', $jenisSampah->jenis_sampah_id)->sum('berat');
      $sampahDiolahInternal = SampahDiolahInternal::where('jenis_sampah_id', $jenisSampah->jenis_sampah_id)->sum('berat');
      $sampahDiolahEksternal = SampahDiolahEksternal::where('jenis_sampah_id', $jenisSampah->jenis_sampah_id)->sum('berat');

      $totalSampah = $jenisSampah->total_berats;
      $sisaSampah = $totalSampah - $sampahDimanfaatkan - $sampahDiolahInternal - $sampahDiolahEksternal;

      Total_sampah::updateOrCreate(
        ['jenis_sampah_id' => $jenisSampah->jenis_sampah_id],
        ['total_berat' => $sisaSampah]
      );
    }

    // Set flash message berhasil
    Session::flash('success', 'Data item berhasil ditambah');

    return redirect('/petugas');
  }

  public function detailItem(Request $request, $id)
  {
    $perPage = $request->query('perPage', 10);
    $itemTransaksi = ItemTransaksi::where('transaksi_id', $id)
      ->orderBy('updated_at', 'desc')
      ->paginate($perPage);
    return view('frontend.detail_item', [
      'itemTransaksis' => $itemTransaksi,
      'perPage' => $perPage
    ]);
  }
}
