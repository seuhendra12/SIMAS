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
    $credentials = $request->only('nik', 'password');
    if (Auth::attempt($credentials)) {
      $user = Auth::user();

      // dd($user->role);

      if ($user->role == 'SuperAdmin' || $user->role == 'Admin' || $user->role == 'Kelurahan' ) {
        return redirect()->intended('/dashboard');
      } elseif ($user->role == 'User') {
        return redirect()->intended('/');
      }
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

    // Proses selanjutnya jika validasi berhasil

    // Buat user baru
    $user = User::create([
      'nik' => $request->input('nik'),
      'name' => $request->input('name'),
      'password' => Hash::make($request->input('password')),
    ]);

    // Buat profil pengguna dan set user_id
    $profile = new Profile([
      'user_id' => $user->id
    ]);
    
    $profile->save();

    // Set flash message berhasil
    Session::flash('success', 'Akun berhasil dibuat. Silakan login.');

    return redirect('/login');
  }
}
