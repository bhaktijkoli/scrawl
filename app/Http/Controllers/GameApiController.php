<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewRound;

use App\Lobby;
use App\Round;
use App\Http\Resources\Lobby as LobbyResource;
use Carbon\Carbon;

use Auth;

class GameApiController extends Controller
{
  public function get($code)
  {
    $lobby = Lobby::where('code', $code)->first();
    return new LobbyResource($lobby);
  }
  public function start($code)
  {
    $lobby = Lobby::where('code', $code)->first();
    $lobby->status = '1';
    $round = new Round();
    $round->lobby_id = $lobby->id;
    $round->drawer_id = Auth::user()->id;
    $round->save();
    $lobby->current_round_id = $round->id;
    $lobby->save();
    event(new NewRound($lobby));
  }
}
