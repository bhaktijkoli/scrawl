<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\NewMessage;

use App\Lobby;
use Auth;

class ChatApiController extends Controller
{
  public function add(Request $request)
  {
    $lobby = Lobby::find($request->input('lobby', 0));
    if(!$lobby) abort(404);
    $message = $request->input('message');
    $data = [
      'type' => 'chat',
      'user_name' => Auth::user()->name,
      'user_id' => Auth::user()->id,
      'body' => $message,
    ];
    event(new NewMessage($lobby, $data));
    return "ok";
  }
}
