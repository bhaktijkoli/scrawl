<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\LobbyPlayer;
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
    $players = [];
    $lobbyPlayers = LobbyPlayer::where('lobby_id', $this->id)->orderBy('points', 'DESC')->get();
    foreach ($lobbyPlayers as $player) {
      $data = [
        'name' => $player->user->name,
        'avatar' => $player->user->avatar,
        'points' => $player->points,
        'correct' => $player->correct,
      ];
      array_push($players, $data);
    }
    return [
      'id' => $this->id,
      'code' => $this->code,
      'private' => $this->private,
      'max_rounds' => $this->max_rounds,
      'max_time' => $this->max_time,
      'status' => $this->status,
      'players' => $players,
      'total_rounds' => $this->rounds->count(),
      'current_round' => new Round($this->current_round),
    ];
  }
}
