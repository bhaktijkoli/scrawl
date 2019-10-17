<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\NewMessage;

use App\Lobby;
use App\LobbyPlayer;
use Auth;

class ChatApiController extends Controller
{
  public function add(Request $request)
  {
    $lobby = Lobby::find($request->input('lobby', 0));
    if(!$lobby) abort(404);
    $message = $request->input('message');
    if($message == $lobby->current_round->word) {
      $data = [
        'type' => 'notification',
        'user_name' => Auth::user()->name,
        'user_id' => Auth::user()->id,
        'body' => Auth::user()->name . ' has guessed the word correctly.',
      ];
      $player = LobbyPlayer::where('lobby_id', $lobby->id)->where('user_id', Auth::user()->id)->first();
      $player->points = (int) $player->points + (int) $lobby->current_round->getTimeLeft();
      $player->save();
    } else {
      $data = [
        'type' => 'chat',
        'user_name' => Auth::user()->name,
        'user_id' => Auth::user()->id,
        'body' => $message,
      ];
    }
    event(new NewMessage($lobby, $data));
    return "ok";
  }
}
