<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
  public function lobby()
  {
    return $this->belongsTo('App\Lobby', 'lobby_id');
  }
}
