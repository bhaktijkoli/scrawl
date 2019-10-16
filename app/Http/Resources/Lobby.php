<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
      'rounds' => $this->rounds,
      'time' => $this->time,
      'status' => $this->status,
      'players' => $this->players,
    ];
  }
}
