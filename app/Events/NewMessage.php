<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessage implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $lobby;
  public $message;

  /**
  * Create a new event instance.
  *
  * @return void
  */
  public function __construct($lobby, $message)
  {
    $this->lobby = $lobby;
    $this->message = $message;
  }

  /**
  * Get the channels the event should broadcast on.
  *
  * @return \Illuminate\Broadcasting\Channel|array
  */
  public function broadcastOn()
  {
    $code = $this->lobby->code;
    return new PrivateChannel("game.$code");
  }

  /**
  * Get the data to broadcast.
  *
  * @return array
  */
  public function broadcastWith()
  {
    return ['message' => $this->message];
  }
}
