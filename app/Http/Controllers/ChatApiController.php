<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\NewMessage;

use App\Lobby;

class ChatApiController extends Controller
{
  public function add(Request $request)
  {
    $lobby = Lobby::find($request->input('lobby', 0));
    if(!$lobby) abort(404);
    $message = $request->input('message');
    event(new NewMessage($lobby, $message));
    return "ok";
  }
}
