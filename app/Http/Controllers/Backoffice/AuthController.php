<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

      if ($user->role == 'Admin') {
        return redirect()->intended('/');
      } elseif ($user->role == 'User') {
        return redirect()->intended('/sistem-informasi-manajemen-sampah');
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
    return redirect('/login');
  }
  public function index_registrasi()
  {
    return view("autentikasi.registrasi");
  }
}
