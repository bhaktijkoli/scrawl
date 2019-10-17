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
    return [
      'id' => $this->id,
      'code' => $this->code,
      'private' => $this->private,
      'max_rounds' => $this->max_rounds,
      'max_time' => $this->max_time,
      'status' => $this->status,
      'players' => $this->players,
      'current_round' => new Round($this->current_round),
    ];
  }
}
