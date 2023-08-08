<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\RW;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RWController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->query('perPage', 10);
        return view('backoffice.data-referensi.data-rw.index', [
            'rws' => RW::filter(request(['search']))->paginate($perPage),
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
        return view('backoffice.data-referensi.data-rw.create');
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
            'name' => 'required|unique:rws',
        ], [
            'name.required' => 'Kolom nama wajib diisi',
            'name.unique' => 'RW tersebut sudah ada',
        ]);

        $rw = new RW([
            'name' => $request->input('name'),
        ]);

        $rw->save();
        // Set flash message berhasil
        Session::flash('success', 'Data RW berhasil ditambah');

        return redirect('/data-rw');
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
        $rw = RW::findOrFail($id);
        return view('backoffice.data-referensi.data-rw.edit', [
            'rw' => $rw
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
        $rw = RW::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:rws,name,'.$id,
        ], [
            'name.required' => 'Kolom nama wajib diisi',
            'name.unique' => 'RW tersebut sudah ada',
        ]);

        $rw->update([
            'name' => $request->input('name'),
        ]);

        // Set flash message berhasil
        Session::flash('success', 'Data RW berhasil diubah');

        return redirect('/data-rw');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rw = RW::findOrFail($id);

        // Hapus data RW
        $rw->delete();

        // Set flash message berhasil
        Session::flash('success', 'Data RW berhasil dihapus');

        return redirect('/data-rw');
    }
}
