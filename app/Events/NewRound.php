<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewRound implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $lobby;

  /**
  * Create a new event instance.
  *
  * @return void
  */
  public function __construct($lobby)
  {
    $this->lobby = $lobby;
  }

  /**
  * Get the channels the event should broadcast on.
  *
  * @return \Illuminate\Broadcasting\Channel|array
  */
  public function broadcastOn()
  {
    $code = $this->lobby->code;
    return new Channel("game.$code");
  }

  /**
  * Get the data to broadcast.
  *
  * @return array
  */
  public function broadcastWith()
  {
    return ['round' => $this->lobby->status];
  }
}
