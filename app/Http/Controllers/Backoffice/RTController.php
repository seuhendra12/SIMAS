<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\RT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->query('perPage', 10);
        return view('backoffice.data-referensi.data-rt.index', [
            'rts' => RT::filter(request(['search']))->paginate($perPage),
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
        return view('backoffice.data-referensi.data-rt.create');
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
            'name' => 'required|unique:rts',
        ], [
            'name.required' => 'Kolom nama wajib diisi',
            'name.unique' => 'RT tersebut sudah ada',
        ]);

        $rt = new RT([
            'name' => $request->input('name'),
        ]);

        $rt->save();
        // Set flash message berhasil
        Session::flash('success', 'Data RT berhasil ditambah');

        return redirect('/data-rt');
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
        $rt = RT::findOrFail($id);
        return view('backoffice.data-referensi.data-rt.edit', [
            'rt' => $rt
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
        $rt = RT::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:rts,name,'.$id,
        ], [
            'name.required' => 'Kolom nama wajib diisi',
            'name.unique' => 'RT tersebut sudah ada',
        ]);

        $rt->update([
            'name' => $request->input('name'),
        ]);

        // Set flash message berhasil
        Session::flash('success', 'Data RT berhasil diubah');

        return redirect('/data-rt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rt = RT::findOrFail($id);

        // Hapus data RT
        $rt->delete();

        // Set flash message berhasil
        Session::flash('success', 'Data RT berhasil dihapus');

        return redirect('/data-rt');
    }
}
