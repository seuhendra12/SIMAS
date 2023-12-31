<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\NilaiKonversi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NilaiKonversiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->query('perPage', 10);
        return view('backoffice.manajemen-transaksi.konversi-poin.index', [
            'konversiPoins' => NilaiKonversi::filter(request(['search']))->paginate($perPage),
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
        return view('backoffice.manajemen-transaksi.konversi-poin.create');
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
            'angka_konversi' => 'required|unique:nilai_konversis',
            'nilai' => 'required',
        ], [
            'angka_konversi.required' => 'Kolom angka wajib diisi',
            'angka_konversi.unique' => 'Angka konversi sudah ada',
            'nilai.required' => 'Kolom nilai wajib diisi',
        ]);

        $konversiPoin = new NilaiKonversi([
            'angka_konversi' => $request->input('angka'),
            'nilai_konversi' => $request->input('nilai'),
        ]);

        $konversiPoin->save();
        // Set flash message berhasil
        Session::flash('success', 'Data konversi poin berhasil ditambah');

        return redirect('/konversi-poin');
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
        $konversiPoin = NilaiKonversi::findOrFail($id);
        return view('Backoffice.manajemen-transaksi.konversi-poin.edit',[
            'konversiPoin' => $konversiPoin
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
        $konversiPoin = NilaiKonversi::findOrFail($id);
        $request->validate([
            'angka_konversi' => 'required|unique:nilai_konversis,angka_konversi,'.$id,
            'nilai' => 'required',
        ], [
            'angka_konversi.required' => 'Kolom angka wajib diisi',
            'angka_konversi.unique' => 'Angka konversi sudah ada',
            'nilai.required' => 'Kolom nilai wajib diisi',
        ]);

        $konversiPoin->update([
            'angka_konversi' => $request->input('angka_konversi'),
            'nilai_konversi' => $request->input('nilai'),
        ]);

        // Set flash message berhasil
        Session::flash('success', 'Data konversi poin berhasil diubah');

        return redirect('/konversi-poin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Konversi = NilaiKonversi::findOrFail($id);

        // Hapus data Konversi
        $Konversi->delete();

        // Set flash message berhasil
        Session::flash('success', 'Data konversi berhasil dihapus');

        return redirect('/konversi-poin');
    }
}
