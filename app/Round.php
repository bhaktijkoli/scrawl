<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
  protected $dates = [
    'end_at',
  ];
  public function lobby()
  {
    return $this->belongsTo('App\Lobby', 'lobby_id');
  }
  public function drawer()
  {
    return $this->belongsTo('App\User', 'drawer_id');
  }
}
