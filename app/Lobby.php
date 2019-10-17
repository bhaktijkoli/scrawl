<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lobby extends Model
{
  protected $dates = [
    'current_endtime',
  ];

  public function players()
  {
    return $this->belongsToMany('App\User', 'lobby_players');
  }
}
