<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

class LoginController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest');
  }
  public function get()
  {
    return view('login');
  }
  public function post(Request $request)
  {
    $validatedData = $request->validate([
      'nickname' => 'required',
    ]);
    $user = new User();
    $user->name = $request->input('nickname');
    $user->save();
    Auth::login($user);
    return redirect()->route('lobby');
  }
}
