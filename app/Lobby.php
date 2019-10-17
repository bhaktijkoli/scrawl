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

  public function current_round()
  {
    return $this->belongsTo('App\Round', 'current_round_id');
  }

  public function rounds()
  {
    return $this->hasMany('App\Round', 'lobby_id');
  }
}
