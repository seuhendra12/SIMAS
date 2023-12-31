<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
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
    $loggedInUser = auth()->user();

    // Jika pengguna dengan peran 'admin' yang login
    if ($loggedInUser->role === 'Admin') {
      // Ambil data pengguna dengan peran 'admin' dan peran lain (tidak termasuk 'superadmin')
      $datas = User::filter(request(['search']))
        ->where('role', '<>', 'SuperAdmin')
        ->where('role', 'Admin')
        ->where('is_active', 1)
        ->paginate($perPage);
    } else {
      // Jika pengguna dengan peran 'superadmin' atau peran lain yang login
      // Ambil semua data tanpa filter
      $datas = User::filter(request(['search']))
        ->where('role', 'Admin')
        ->where('is_active', 1)
        ->paginate($perPage);
    }

    return view('backoffice.manajemen-pengguna.data-pengguna.index', [
      'datas' => $datas,
      'loginHistory' => LoginHistory::latest(),
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
      'nik.required' => 'Kolom NIK wajib diisi.',
      'nik.size' => 'NIK harus memiliki panjang 16 karakter.',
      'nik.unique' => 'Nik sudah digunakan.',
      'name.required' => 'Kolom nama lengkap wajib diisi.',
      'role.required' => 'Kolom role wajib diisi.',
      'password.required' => 'Kolom kata sandi wajib diisi.',
      'password.min' => 'Kata sandi harus terdiri dari minimal :min karakter.',
      'password.regex' => 'Kata sandi harus mengandung setidaknya satu huruf kapital, satu huruf kecil, dan satu angka.',
      'tempat_lahir.required' => 'Kolom tempat lahir wajib diisi.',
      'tanggal_lahir.required' => 'Kolom tanggal lahir wajib diisi.',
      'no_telepon.required' => 'Kolom no telepon wajib diisi.',
      'alamat.required' => 'Kolom alamat wajib diisi.',
      'no_rumah.required' => 'Kolom no rumah wajib diisi.',
    ];

    $validator = Validator::make($request->all(), [
      'nik' => 'required|size:16|unique:users',
      'name' => 'required',
      'tempat_lahir' => 'required',
      'tanggal_lahir' => 'required',
      'jenis_kelamin' => 'required',
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
      'is_active' => 'nullable'
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
    $kodeTransaksi = $nomorRumah . $namaRT . $namaRW;
    if ($validator->fails()) {
      return redirect('/data-pengguna/create')
        ->withErrors($validator)
        ->withInput();
    }
    // Buat user baru jika NIK dan email unik
    $user = User::firstOrCreate(
      ['nik' => $request->input('nik')],
      [
        'name' => $request->input('name'),
        'role' => $request->input('role'),
        'password' => Hash::make($request->input('password')),
        'is_active' => $request->input('is_active', 0)
        // Pastikan tidak ada kolom 'nik' di sini, karena sudah disertakan di bagian atas
      ]
    );

    // Buat profil pengguna dan set user_id
    Profile::firstOrCreate(
      [
        'user_id' => $user->id,
        'tempat_lahir' => $request->input('tempat_lahir'),
        'tanggal_lahir' => $request->input('tanggal_lahir'),
        'jenis_kelamin' => $request->input('jenis_kelamin'),
        'no_wa' => $request->input('no_telepon'),
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
    $messages = [
      'nik.required' => 'Kolom NIK wajib diisi.',
      'nik.size' => 'NIK harus memiliki panjang 16 karakter.',
      'nik.unique' => 'Nik sudah digunakan.',
      'name.required' => 'Kolom nama lengkap wajib diisi.',
      'role.required' => 'Kolom role wajib diisi.',
      'password.required' => 'Kolom kata sandi wajib diisi.',
      'password.min' => 'Kata sandi harus terdiri dari minimal :min karakter.',
      'password.regex' => 'Kata sandi harus mengandung setidaknya satu huruf kapital, satu huruf kecil, dan satu angka.',
      'tempat_lahir.required' => 'Kolom tempat lahir wajib diisi.',
      'tanggal_lahir.required' => 'Kolom tanggal lahir wajib diisi.',
      'no_telepon.required' => 'Kolom no telepon wajib diisi.',
      'alamat.required' => 'Kolom alamat wajib diisi.',
      'no_rumah.required' => 'Kolom no rumah wajib diisi.',
    ];

    $validator = Validator::make($request->all(), [
      'nik' => "required|size:16|unique:users,nik,$id",
      'name' => 'required',
      'tempat_lahir' => 'required',
      'tanggal_lahir' => 'required',
      'jenis_kelamin' => 'required',
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
      'is_active' => 'nullable'
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
    $kodeTransaksi = $nomorRumah . $namaRT . $namaRW;

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    $user->update([
      'nik' => $request->input('nik'),
      'name' => $request->input('name'),
      'role' => $request->input('role'),
      'is_active' => $request->input('is_active', 0),
      'password' => Hash::make($request->input('password')),
    ]);

    $profile = $user->profile;
    $profile->update([
      'tempat_lahir' => $request->input('tempat_lahir'),
      'tanggal_lahir' => $request->input('tanggal_lahir'),
      'jenis_kelamin' => $request->input('jenis_kelamin'),
      'no_wa' => $request->input('no_telepon'),
      'alamat' => $request->input('alamat'),
      'rt_id' => $request->input('rt'),
      'rw_id' => $request->input('rw'),
      'no_rumah' => $request->input('no_rumah'),
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
    $kodeSimas = $request->query('kode_simas');

    // Lakukan query ke database untuk mencari data profil berdasarkan kode_simas
    $profile = Profile::where('kode_simas', $kodeSimas)->first();

    if ($profile) {
      // Ambil data pengguna (nama) melalui relasi "user"
      $name = $profile->user ? $profile->user->name : null;
      $user_id = $profile->user ? $profile->user->id : null;
      return response()->json([
        'name' => $name,
        'user_id' => $user_id
      ]);
    }
    return response()->json(['name' => null]);
  }

  public function getDataPengguna(Request $req)
  {
    $perPage = $req->query('perPage', 10);
    $datas = User::filter(request(['search']))
      ->where('role', 'User')
      // ->with('loginHistory') // Memuat relasi loginHistory
      // ->join('login_histories', 'users.id', '=', 'login_histories.user_id')
      // ->join('profiles', 'users.id', '=', 'profiles.user_id')
      // ->orderByDesc('login_histories.login_time')
      ->paginate($perPage);
    return view('backoffice.manajemen-pengguna.data-pengguna.getDataUser', [
      'datas' => $datas,
      'perPage' => $perPage,
    ]);
  }

  public function getDataPetugas(Request $req)
  {
    $perPage = $req->query('perPage', 10);
    $datas = User::filter(request(['search']))
      ->where('role', 'Petugas')
      ->paginate($perPage);
    return view('backoffice.manajemen-pengguna.data-pengguna.getDataPetugas', [
      'datas' => $datas,
      'perPage' => $perPage,
      'loginHistory' => LoginHistory::latest(),
    ]);
  }

  public function getDataRT(Request $req)
  {
    $perPage = $req->query('perPage', 10);
    $datas = User::filter(request(['search']))
      ->where('role', 'RT')
      ->paginate($perPage);
    return view('backoffice.manajemen-pengguna.data-pengguna.getDataRT', [
      'datas' => $datas,
      'perPage' => $perPage,
      'loginHistory' => LoginHistory::latest(),
    ]);
  }

  public function getDataRW(Request $req)
  {
    $perPage = $req->query('perPage', 10);
    $datas = User::filter(request(['search']))
      ->where('role', 'RW')
      ->paginate($perPage);
    return view('backoffice.manajemen-pengguna.data-pengguna.getDataRW', [
      'datas' => $datas,
      'perPage' => $perPage,
      'loginHistory' => LoginHistory::latest(),
    ]);
  }

  public function getDataKelurahan(Request $req)
  {
    $perPage = $req->query('perPage', 10);
    $datas = User::filter(request(['search']))
      ->where('role', 'Kelurahan')
      ->paginate($perPage);
    return view('backoffice.manajemen-pengguna.data-pengguna.getDataKelurahan', [
      'datas' => $datas,
      'perPage' => $perPage,
      'loginHistory' => LoginHistory::latest(),
    ]);
  }
}
