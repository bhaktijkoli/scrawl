<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Round extends Model
{
  protected $dates = [
    'end_at',
  ];
  public function getTimeLeft() {
    $timeleft = $this->lobby->max_time;
    if($this->end_at) {
      if($this->end_at->isFuture()) {
        $timeleft = $this->end_at->diffInSeconds(Carbon::now(), true);
      } else {
        $timeleft = 0;
      }
    }
    return $timeleft;
  }
  public function lobby()
  {
    return $this->belongsTo('App\Lobby', 'lobby_id');
  }
  public function drawer()
  {
    return $this->belongsTo('App\User', 'drawer_id');
  }
}
