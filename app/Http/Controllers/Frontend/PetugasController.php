<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PetugasController extends Controller
{
  public function index(Request $request)
  {
    $perPage = $request->query('perPage', 10);
    return view('frontend.petugas', [
      'transaksiSampahs' => Transaksi::filter(request(['search']))
        ->orderBy('transaksis.updated_at', 'desc') // Menampilkan data terbaru berdasarkan tanggal transaksi di tabel Transaksi
        ->paginate($perPage),
      'perPage' => $perPage,
    ]);
  }

  public function store(Request $request) {
    $request->validate([
      'user_id' => 'unique:transaksis',
      'tanggal_transaksi' => 'required',
    ], [
      'user_id.unique' => 'Data tersebut sudah ada',
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

    $transaksiSampah = new Transaksi([
      'kode_transaksi' => $kode_transaksi,
      'user_id' => $request->input('user_id'),
      'tanggal_transaksi' => $request->input('tanggal_transaksi'),
      'petugas_id' => Auth::user()->id
    ]);

    $transaksiSampah->save();
    // Set flash message berhasil
    Session::flash('success', 'Data transaksi berhasil ditambah');

    return redirect()->back();
  }
}
