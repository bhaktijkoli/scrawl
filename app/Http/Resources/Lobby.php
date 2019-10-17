<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Carbon\Carbon;

class Lobby extends JsonResource
{
  /**
  * Transform the resource into an array.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return array
  */
  public function toArray($request)
  {
    $current_timeleft = 0;
    if($this->current_endtime) {
      $current_timeleft = $this->current_endtime->diffInSeconds(Carbon::now(), true);
    }
    return [
      'id' => $this->id,
      'code' => $this->code,
      'private' => $this->private,
      'rounds' => $this->rounds,
      'time' => $this->time,
      'status' => $this->status,
      'current_timeleft' => $current_timeleft,
      'players' => $this->players,
    ];
  }
}
