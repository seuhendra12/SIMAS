<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaksi;
use App\Models\JenisSampah;
use App\Models\NilaiKonversi;
use App\Models\RT;
use App\Models\RW;
use App\Models\SampahDimanfaatkan;
use App\Models\SampahDiolahEksternal;
use App\Models\SampahDiolahInternal;
use App\Models\Transaksi;
use App\Models\TukarPoin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Dompdf\Dompdf;


class FrontendController extends Controller
{
  public function index()
  {
    $total_berat = ItemTransaksi::where('jenis_sampah_id', 1)->sum('berat');
    return view('frontend.index', [
      'jenis_sampah' => JenisSampah::get(),
      'transaksi_sampah' => Transaksi::get(),
      'sampah_dimanfaatkan' => SampahDimanfaatkan::get(),
      'sampah_diolah_internal' => SampahDiolahInternal::get(),
      'sampah_diolah_eksternal' => SampahDiolahEksternal::get(),
      'total_berat' => $total_berat,
    ]);
  }
  public function profile()
  {
    return view('frontend.profile', [
      'rts' => RT::get(),
      'rws' => RW::get(),
    ]);
  }

  public function simpan_profile(Request $request, $id)
  {
    $user = User::find($id);

    $validator = Validator::make($request->all(), [
      'nik' => "required|size:16|unique:profiles,nik,$id",
      'name' => 'required',
      'tempat_lahir' => 'required',
      'tanggal_lahir' => 'required',
      'jenis_kelamin' => 'required',
      'email' => "required|email|unique:users,email,$user->id",
      'no_telepon' => 'required',
      'alamat' => 'required',
      'no_rumah' => 'required',
      'rt' => 'required',
      'rw' => 'required',
    ]);

    // Ambil data RT, RW, dan nomor rumah dari input request
    $rtId = $request->input('rt');
    $rwId = $request->input('rw');
    $nomorRumah = $request->input('no_rumah');

    // Cari data RT dan RW berdasarkan ID-nya
    $rt = RT::find($rtId);
    $rw = RW::find($rwId);

    // Dapatkan nama RT dari data RT yang ditemukan
    $namaRT = $rt->name;
    $namaRW = $rw->name;

    // Gabungkan data RT, RW, dan nomor rumah untuk membentuk kode_transaksi
    $kodeTransaksi = $nomorRumah . $namaRT . $namaRW;

    if ($validator->fails()) {
      return redirect()->back()
      ->withErrors($validator)
      ->withInput();
    }

    $user->update([
      'name' => $request->input('name'),
    ]);

    $profile = $user->profile;
    $profile->update([
      'nik' => $request->input('nik'),
      'tempat_lahir' => $request->input('tempat_lahir'),
      'tanggal_lahir' => $request->input('tanggal_lahir'),
      'jenis_kelamin' => $request->input('jenis_kelamin'),
      'no_telepon' => $request->input('no_telepon'),
      'alamat' => $request->input('alamat'),
      'rt_id' => $request->input('rt'),
      'rw_id' => $request->input('rw'),
      'no_rumah' => $request->input('no_rumah'),
      'kode_simas' => $kodeTransaksi, // Set nilai kode_transaksi
    ]);

    // Set flash message berhasil
    Session::flash('success', 'Profile berhasil disimpan');

    return redirect('/');
  }

  public function tukar_poin()
  {
   $user = Auth::user();

   $tukarPoins = TukarPoin::whereHas('transaksi', function ($query) use ($user) {
    $query->where('user_id', $user->id);
  })
   ->orderBy('updated_at', 'desc')
   ->get();

   return view('frontend.tukar_poin', [
    'konversiPoin' => NilaiKonversi::all(),
    'tukarPoins' => $tukarPoins,
  ]);
 }

 public function simpan_tukar_poin(Request $request, $id)
 {
    // Mendapatkan nilai "konversPoin" dari input form
  $konversiPoinId = $request->input('konversiPoin');

    // Dapatkan nilai dari model KonversiPoin berdasarkan "id" yang dipilih
  $konversiPoin = NilaiKonversi::find($konversiPoinId);

    // Dapatkan data transaksi dari tabel "transaksi" berdasarkan "user_id"
  $transaksi = Transaksi::where('user_id', $id)->first();

  $totalPoinTransaksi = $transaksi->total_point;
  $nilaiPoin = $konversiPoin->nilai_konversi;

    // Validasi apakah total poin pengguna cukup untuk dikonversi
  if ($totalPoinTransaksi < $nilaiPoin) {
    return redirect()->back()->withErrors('Total poin tidak mencukupi untuk dikonversi.');
  }

    // Simpan data baru ke dalam tabel tukar_poin dengan membawa id_transaksi (id_transaksi dari tabel transaksi)
  $tukarPoin = new TukarPoin();
  $tukarPoin->transaksi_id = $transaksi->id;
  $tukarPoin->nilai_konversi_id = $konversiPoinId;
  $tukarPoin->tanggal_transaksi = now();
  $tukarPoin->total_konversi = $konversiPoin->nilai_konversi;
  $tukarPoin->save();

    // Kurangi total_poin dalam transaksi berdasarkan poin yang dikonversi
  $transaksi->total_point -= $nilaiPoin;
  $transaksi->save();

    // Set flash message berhasil
  Session::flash('success', 'Tukar poin berhasil diajukan');

  return redirect()->back();
}

public function histori(Request $request)
{
  $perPage = $request->query('perPage', 10);
    // Ambil data user yang sedang login
  $user = Auth::user();

    // Ambil data item_transaksi berdasarkan user yang login melalui join dengan tabel transaksi
  $historiTransaksi = ItemTransaksi::join('transaksis', 'item_transaksis.transaksi_id', '=', 'transaksis.id')
  ->where('transaksis.user_id', $user->id)
      ->orderBy('item_transaksis.updated_at', 'desc') // Menampilkan data terbaru berdasarkan tanggal transaksi pada tabel item_transaksi
      ->paginate($perPage);

      return view('frontend.histori', [
        'historiTransaksis' => $historiTransaksi,
        'perPage' => $perPage,
      ]);
    }

    public function cetak_struk($id)
    {
      $user = Auth::user(); // Mendapatkan user yang sedang login
    $tukarPoin = TukarPoin::findOrFail($id); // Ambil data tukar poin berdasarkan ID

    // Pastikan bahwa tukar poin yang diakses terkait dengan user yang sedang login
    if ($user->id !== $tukarPoin->transaksi->user_id) {
        abort(403); // Tolak akses jika user tidak berhak mengakses data tukar poin ini
      }
    $pdf = new Dompdf(); // Buat instance baru dari Dompdf

    // Kirim data tukarPoin ke view
    $pdf->loadHtml(view('frontend.cetak_struk',[
      'tukarPoin'=>$tukarPoin
    ]));

    // (Opsional) Set ukuran kertas dan orientasi
    $pdf->setPaper('A4', 'portrait');

    // Render PDF
    $pdf->render();

    // Tampilkan PDF yang dihasilkan langsung di browser
    $pdf->stream('struk_tukar_poin_' . $tukarPoin->transaksi->user->profile->kode_simas . '.pdf');
  }
}
