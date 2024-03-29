<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Carbon\Carbon;

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
      if($this->end_at->isFuture()) {
        $timeleft = $this->end_at->diffInSeconds(Carbon::now(), true);
      } else {
        $timeleft = 0;
      }
    }
    return [
      'id' => $this->id,
      'status' => $this->status,
      'drawer' => $this->drawer,
      'timeleft' => $this->getTimeLeft(),
    ];
  }
}
