<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view("login.index");
    }
}
