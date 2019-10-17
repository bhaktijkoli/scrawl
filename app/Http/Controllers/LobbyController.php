<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lobby;
use App\LobbyPlayer;
use Auth;

class LobbyController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    return view('lobby.index');
  }

  public function postIndex(Request $request)
  {
    $code = $request->input('code', '');
    $lobby = Lobby::where('code', $code)->first();
    if($lobby) {
      $player = LobbyPlayer::where('user_id', Auth::user()->id)->where('lobby_id', $lobby->id)->first();
      if(!$player) {
        $player = new LobbyPlayer();
        $player->user_id = Auth::user()->id;
        $player->lobby_id = $lobby->id;
        $player->save();
        event(new \App\Events\NewPlayer($lobby, Auth::user()));
      }
      return redirect()->route('game.index', $code);
    }
    return view('lobby.index');
  }

  public function new()
  {
    return view('lobby.new');
  }

  public function newPost(Request $request)
  {
    $lobby = new Lobby();
    $lobby->code = str_random(5);
    $lobby->max_rounds = $request->input('rounds');
    $lobby->max_time = $request->input('time');
    $lobby->private = '1';
    $lobby->user_id = Auth::user()->id;
    $lobby->save();
    $player = new LobbyPlayer();
    $player->user_id = Auth::user()->id;
    $player->lobby_id = $lobby->id;
    $player->save();
    return redirect()->route('game.index', $lobby->code);
  }


}
