<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Round extends JsonResource
{
  /**
  * Transform the resource into an array.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return array
  */
  public function toArray($request)
  {
    $timeleft = $this->lobby->max_time;
    if($this->end_at) {
      $timeleft = $this->end_at->diffInSeconds(Carbon::now(), true);
    }
    return [
      'status' => $this->status,
      'timeleft' => $timeleft
    ];
  }
}
