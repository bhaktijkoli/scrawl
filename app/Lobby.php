<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\LobbyPlayer;

class Lobby extends Model
{
  public function players()
  {
    return $this->belongsToMany('App\User', 'lobby_players');
  }

  public function current_round()
  {
    return $this->belongsTo('App\Round', 'current_round_id');
  }

  public function rounds()
  {
    return $this->hasMany('App\Round', 'lobby_id');
  }

  public function setCorrect()
  {
    $lobbyPlayers = LobbyPlayer::where('lobby_id', $this->id)->get();
    foreach ($lobbyPlayers as $player) {
      $player->correct = '0';
      $player->save();
    }
  }
}
