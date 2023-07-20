<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaksi;
use App\Models\JenisSampah;
use App\Models\KategoriSampah;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'user_id' => 'required|unique:transaksis',
            'tanggal_transaksi' => 'required',
        ], [
            'kode_transaksi.required' => 'Kolom kode transaksi wajib diisi',
            'user_id.required' => 'Kolom user id wajib diisi',
            'user_id.unique' => 'Data tersebut sudah ada',
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
        // Mengambil item transaksi dan melakukan agregasi berat berdasarkan jenis sampah
        $itemTransaksis = ItemTransaksi::with('jenisSampah')
            ->where('transaksi_id', $id)
            ->select('jenis-sampah_id')
            ->selectRaw('SUM(berat) as jumlah_berat')
            ->selectRaw('SUM(point) as jumlah_point')
            ->groupBy('jenis-sampah_id')
            ->orderBy('jenis-sampah_id') // Urutkan berdasarkan jenis_sampah_id
            ->paginate($perPage);

        return view('backoffice.manajemen-sampah.item-transaksi.index', [
            'transaksiSampahs' => $transaksiSampah,
            'itemTransaksis' => $itemTransaksis,
            'perPage' => $perPage
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
