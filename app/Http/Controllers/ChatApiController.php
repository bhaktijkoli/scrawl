<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\NewMessage;

use App\Lobby;
use App\LobbyPlayer;
use App\Events\UpdateRound;
use Auth;

class ChatApiController extends Controller
{
  public function add(Request $request)
  {
    $lobby = Lobby::find($request->input('lobby', 0));
    if(!$lobby) abort(404);
    $message = $request->input('message');
    if($message == $lobby->current_round->word) {
      $player = LobbyPlayer::where('lobby_id', $lobby->id)->where('user_id', Auth::user()->id)->first();
      if($player->correct == 1) return "Ok";
      $data = [
        'type' => 'notification',
        'user_name' => Auth::user()->name,
        'user_id' => Auth::user()->id,
        'body' => Auth::user()->name . ' has guessed the word correctly.',
      ];
      $player->points = (int) $player->points + (int) $lobby->current_round->getTimeLeft();
      $player->correct = '1';
      $player->save();
      event(new UpdateRound($lobby));
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
