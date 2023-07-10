<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index_login(){
        return view("autentikasi.login");
    }
    public function index_registrasi(){
        return view("autentikasi.registrasi");
    }
}
