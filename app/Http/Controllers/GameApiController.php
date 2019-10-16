<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lobby;
use App\Http\Resources\Lobby as LobbyResource;

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
    $lobby->save();
    return new LobbyResource($lobby);
  }
}
