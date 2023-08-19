<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  public function index_login()
  {
    return view("autentikasi.login");
  }

  public function login(Request $request)
  {
    $messages = [
      'nik.required' => 'NIK wajib diisi.',
      'password.required' => 'Kata sandi wajib diisi.',
      'password.min' => 'Kata sandi harus terdiri dari minimal :min karakter.',
      'password.regex' => 'Kata sandi harus mengandung setidaknya satu huruf kapital, satu huruf kecil, dan satu angka.',
    ];
    $validator = Validator::make($request->all(), [
      'nik' => 'required',
      'password' => [
        'required',
        'string',
        'min:8',
        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
      ],
    ], $messages);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $credentials = [
      'nik' => $request->nik,
      'password' => $request->password,
    ];

    $user = User::where('nik', $credentials['nik'])->first();

    if ($user && $user->is_active == 1 && Auth::attempt($credentials)) {
      $user = Auth::user();

      if ($user->role == 'SuperAdmin' || $user->role == 'Admin' || $user->role == 'Kelurahan') {
        return redirect()->intended('/dashboard');
      } elseif ($user->role == 'User') {
        return redirect()->intended('/');
      } elseif ($user->role == 'Petugas') {
        return redirect()->intended('/petugas');
      }
      
    } else if ($user && $user->is_active == 0) {
      $request->session()->put('nik', $request->input('nik'));
      return back()->with('errorLogin', 'Akun kamu belum aktif !');
    }

    $request->session()->put('nik', $request->input('nik'));
    return back()->with('errorLogin', 'NIK atau kata sandi tidak valid');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
  }
  public function index_registrasi()
  {
    return view("autentikasi.registrasi");
  }

  public function register(Request $request)
  {
    $messages = [
      'nik.required' => 'NIK wajib diisi.',
      'nik.unique' => 'NIK sudah digunakan.',
      'nik.size' => 'NIK harus memiliki panjang 16 karakter.',
      'name.required' => 'Nama wajib diisi.',
      'password.required' => 'Kata sandi wajib diisi.',
      'password.min' => 'Kata sandi harus terdiri dari minimal :min karakter.',
      'password.regex' => 'Kata sandi harus mengandung setidaknya satu huruf kapital, satu huruf kecil, dan satu angka.',
    ];

    $validator = Validator::make($request->all(), [
      'nik' => 'required|size:16|unique:users',
      'name' => 'required',
      'no_wa' => 'required',
      'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
      'password' => [
        'required',
        'string',
        'min:8',
        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
      ],
    ], $messages);

    if ($validator->fails()) {
      return redirect('/registrasi')
        ->withErrors($validator)
        ->withInput();
    }

    if ($request->hasFile('foto_ktp')) {
      $image = $request->file('foto_ktp');
      $imageName = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('img/foto_ktp'), $imageName);
    }

    // Proses selanjutnya jika validasi berhasil

    // Buat user baru
    $user = User::create([
      'nik' => $request->input('nik'),
      'name' => $request->input('name'),
      'is_active' => 0,
      'password' => Hash::make($request->input('password')),
    ]);

    // Buat profil pengguna dan set user_id
    $profile = new Profile([
      'user_id' => $user->id,
      'foto_ktp' => $imageName,
      'no_wa' => $request->input('no_wa')
    ]);

    $profile->save();

    // Set flash message berhasil
    Session::flash('success', 'Akun berhasil dibuat. Tunggu konfirmasi dari admin, agar bisa login.');

    return redirect('/login');
  }
}
