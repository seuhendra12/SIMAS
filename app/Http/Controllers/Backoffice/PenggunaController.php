<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\RT;
use App\Models\RW;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $perPage = $request->query('perPage', 10);
    return view('backoffice.manajemen-pengguna.data-pengguna.index', [
      'datas' => User::filter(request(['search']))->paginate($perPage),
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
    $rts = RT::get();
    $rws = RW::get();

    return view('backoffice.manajemen-pengguna.data-pengguna.create', [
      'rts' => $rts,
      'rws' => $rws,
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
    $messages = [
      'nik.required' => 'NIK wajib diisi.',
      'nik.size' => 'NIK harus memiliki panjang 16 karakter.',
      'nik.unique' => 'Nik sudah digunakan.',
      'name.required' => 'Nama wajib diisi.',
      'email.required' => 'Email wajib diisi.',
      'email.email' => 'Format email tidak valid.',
      'email.unique' => 'Email sudah digunakan.',
      'password.required' => 'Kata sandi wajib diisi.',
      'password.min' => 'Kata sandi harus terdiri dari minimal :min karakter.',
      'password.regex' => 'Kata sandi harus mengandung setidaknya satu huruf kapital, satu huruf kecil, dan satu angka.',
    ];

    $validator = Validator::make($request->all(), [
      'nik' => 'required|size:16|unique:profiles',
      'name' => 'required',
      'tempat_lahir' => 'required',
      'tanggal_lahir' => 'required',
      'jenis_kelamin' => 'required',
      'email' => 'required|email|unique:users',
      'role' => 'required',
      'no_telepon' => 'required',
      'alamat' => 'required',
      'no_rumah' => 'required',
      'rt' => 'required',
      'rw' => 'required',
      'password' => [
        'required',
        'string',
        'min:8',
        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
      ],
    ], $messages);

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
    $kodeTransaksi = $namaRT.$namaRW.$nomorRumah;

    if ($validator->fails()) {
      return redirect('/data-pengguna/create')
        ->withErrors($validator)
        ->withInput();
    }

    // Buat user baru jika NIK dan email unik
    $user = User::firstOrCreate(
      ['email' => $request->input('email')],
      [
        'name' => $request->input('name'),
        'password' => Hash::make($request->input('password')),
      ]
    );

    // Buat profil pengguna dan set user_id
    $profile = Profile::firstOrCreate(
      ['nik' => $request->input('nik')],
      [
        'user_id' => $user->id,
        'tempat_lahir' => $request->input('tempat_lahir'),
        'tanggal_lahir' => $request->input('tanggal_lahir'),
        'jenis_kelamin' => $request->input('jenis_kelamin'),
        'no_telepon' => $request->input('no_telepon'),
        'alamat' => $request->input('alamat'),
        'rt_id' => $request->input('rt'),
        'rw_id' => $request->input('rw'),
        'no_rumah' => $request->input('no_rumah'),
        'kode_simas' => $kodeTransaksi, // Set nilai kode_transaksi
      ]
    );

    // Set flash message berhasil
    Session::flash('success', 'Pengguna berhasil ditambahkan');

    return redirect('/data-pengguna');
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = User::findOrFail($id);
    $rts = RT::get();
    $rws = RW::get();

    return view('backoffice.manajemen-pengguna.data-pengguna.show', [
      'user' => $user,
      'rts' => $rts,
      'rws' => $rws,
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
    $user = User::findOrFail($id);
    $rts = RT::get();
    $rws = RW::get();

    return view('backoffice.manajemen-pengguna.data-pengguna.edit', [
      'user' => $user,
      'rts' => $rts,
      'rws' => $rws,
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
    $user = User::find($id);

    $validator = Validator::make($request->all(), [
      'nik' => "required|size:16|unique:profiles,nik,$id",
      'name' => 'required',
      'tempat_lahir' => 'required',
      'tanggal_lahir' => 'required',
      'jenis_kelamin' => 'required',
      'email' => "required|email|unique:users,email,$user->id",
      'role' => 'required',
      'no_telepon' => 'required',
      'alamat' => 'required',
      'rt' => 'required',
      'rw' => 'required',
      'password' => [
        'required',
        'string',
        'min:8',
        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
      ],
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
     $kodeTransaksi = $namaRT.$namaRW.$nomorRumah;

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    $user->update([
      'name' => $request->input('name'),
      'password' => Hash::make($request->input('password')),
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
      'kode_simas' => $kodeTransaksi, // Set nilai kode_transaksi
    ]);

    // Set flash message berhasil
    Session::flash('success', 'Pengguna berhasil diubah');

    return redirect('/data-pengguna');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $user = User::findOrFail($id);

    // Lakukan aksi penghapusan pengguna

    $user->delete();

    // Set flash message berhasil
    Session::flash('success', 'Pengguna berhasil dihapus');

    return redirect('/data-pengguna');
  }

  public function getUserName(Request $request)
  {
    $userId = $request->input('user_id');
    $user = User::find($userId);

    if ($user) {
      return response()->json(['name' => $user->name]);
    } else {
      return response()->json(['name' => null]);
    }
  }
}
