<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class AuthApiController extends Controller
{
  public function get()
  {
    return Auth::user();
  }
}
