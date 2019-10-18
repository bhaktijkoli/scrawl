<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Round;
use App\Events\NewRound;
use Auth;

class RoundNewJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $lobby;

  /**
  * Create a new job instance.
  *
  * @return void
  */
  public function __construct($lobby)
  {
    $this->connection = 'database';
    $this->lobby = $lobby;
  }

  /**
  * Execute the job.
  *
  * @return void
  */
  public function handle()
  {
    $this->lobby->setCorrect();
    $round = new Round();
    $round->lobby_id = $this->lobby->id;
    $round->drawer_id = $this->lobby->players->random(1)->first()->id;
    $round->save();
    $this->lobby->current_round_id = $round->id;
    $this->lobby->save();
    event(new NewRound($this->lobby));
  }
}
