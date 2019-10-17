<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewRound;

use App\Lobby;
use App\Http\Resources\Lobby as LobbyResource;
use Carbon\Carbon;

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
    $lobby->status = 1;
    // $lobby->current_endtime = Carbon::now()->addSeconds($lobby->time)->format('Y-m-d H:i:s');
    $lobby->save();
    event(new NewRound($lobby));
    return new LobbyResource($lobby);
  }
}
