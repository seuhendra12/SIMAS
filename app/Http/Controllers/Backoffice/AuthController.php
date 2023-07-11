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
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  public function index_login()
  {
    return view("autentikasi.login");
  }
  public function login(Request $request)
  {
    $messages = [
      'email.required' => 'Email wajib diisi.',
      'password.required' => 'Kata sandi wajib diisi.',
      'password.min' => 'Kata sandi harus terdiri dari minimal :min karakter.',
      'password.regex' => 'Kata sandi harus mengandung setidaknya satu huruf kapital, satu huruf kecil, dan satu angka.',
    ];
    $validator = Validator::make($request->all(), [
      'email' => 'required',
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
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      $user = Auth::user();

      if ($user->role == 'pengelola') {
        return redirect()->intended('/dashboard');
      } elseif ($user->role == 'warga') {
        return redirect()->intended('/');
      }
    }

    $request->session()->put('email', $request->input('email'));
    return back()->with('errorLogin', 'Email atau kata sandi tidak valid');
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
      'nik.size' => 'NIK harus memiliki panjang 16 karakter.',
      'name.required' => 'Nama wajib diisi.',
      'email.required' => 'Email wajib diisi.',
      'email.email' => 'Format email tidak valid.',
      'email.unique' => 'Email sudah digunakan.',
      'password.required' => 'Kata sandi wajib diisi.',
      'password.min' => 'Kata sandi harus terdiri dari minimal :min karakter.',
      'password.regex' => 'Kata sandi harus mengandung setidaknya satu huruf kapital, satu huruf kecil, dan satu angka.',
  ];
  
  $validator = Validator::make($request->all(), [
      'nik' => 'required|size:16',
      'name' => 'required',
      'email' => 'required|email|unique:users',
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
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'password' => Hash::make($request->input('password')),
    ]);

    // Buat profil pengguna dan set user_id
    $profile = new Profile([
      'nik' => $request->input('nik'),
    ]);
    $profile->user_id = $user->id; // Mengisi user_id dengan id user yang baru dibuat
    $profile->save();

    // Set flash message berhasil
    Session::flash('success', 'Akun berhasil dibuat. Silakan login.');

    return redirect('/login');
  }
}
