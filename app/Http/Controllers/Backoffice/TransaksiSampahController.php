<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaksi;
use App\Models\JenisSampah;
use App\Models\KategoriSampah;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransaksiSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->query('perPage', 10);

        return view('backoffice.manajemen-sampah.transaksi-sampah.index', [
            'transaksiSampahs' => Transaksi::filter(request(['search']))
                ->orderBy('transaksis.created_at', 'desc') // Menampilkan data terbaru berdasarkan tanggal transaksi di tabel Transaksi
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
        return view('backoffice.manajemen-sampah.transaksi-sampah.create', [
            'jenisSampah' => JenisSampah::get(),
            'nasabah' => User::get(),
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
            'kode_transaksi' => 'required|unique:transaksis',
            'user_id' => 'required',
            'tanggal_transaksi' => 'required',
        ], [
            'kode_transaksi.required' => 'Kolom kode transaksi wajib diisi',
            'user_id.required' => 'Kolom user id wajib diisi',
            'tanggal_transaksi.required' => 'Kolom tanggal wajib diisi',
        ]);

        $transaksiSampah = new Transaksi([
            'kode_transaksi' => $request->input('kode_transaksi'),
            'user_id' => $request->input('user_id'),
            'tanggal_transaksi' => $request->input('tanggal_transaksi'),
        ]);

        $transaksiSampah->save();
        // Set flash message berhasil
        Session::flash('success', 'Data transaksi berhasil ditambah');

        return redirect('/transaksi-sampah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $transaksiSampah = Transaksi::findOrFail($id);
        $perPage = $request->query('perPage', 10);

        // Mengambil hanya item transaksi yang sesuai dengan ID transaksi yang diberikan
        $itemTransaksis = ItemTransaksi::where('transaksi_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('backoffice.manajemen-sampah.item-transaksi.index', [
            'transaksiSampahs' => $transaksiSampah,
            'perPage' => $perPage,
            'itemTransaksis' => $itemTransaksis,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nasabah = User::findOrFail($id);

        return view('backoffice.manajemen-sampah.transaksi-sampah.create', [
            'kategoriSampah' => KategoriSampah::get(),
            'jenisSampah' => JenisSampah::get(),
            'nasabah' => $nasabah
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
