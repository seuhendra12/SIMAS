<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
  public function index()
  {
    return view('frontend.index',[
      'jenis_sampah' => JenisSampah::get()
    ]);
  }
  public function profile()
  {
    return view('frontend.profile', []);
  }
}
