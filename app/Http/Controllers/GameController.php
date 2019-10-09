<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lobby;
use Auth;

class GameController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index($code)
  {
    $lobby = Lobby::where('code', $code)->first();
    return view('game.index')->with(['lobby'=>$lobby]);
  }
}
