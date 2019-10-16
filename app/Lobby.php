<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lobby extends Model
{
  public function players()
  {
    return $this->belongsToMany('App\User', 'lobby_players');
  }
}
