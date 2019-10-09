<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LobbyPlayer extends Model
{
  public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function lobby()
  {
    return $this->belongsTo('App\Lobby');
  }
}
