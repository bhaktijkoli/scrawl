<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Events\EndRound;

use App\Jobs\RoundNewJob;

class RoundEndJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $round;

  /**
  * Create a new job instance.
  *
  * @return void
  */
  public function __construct($round)
  {
    $this->connection = 'database';
    $this->round = $round;
  }

  /**
  * Execute the job.
  *
  * @return void
  */
  public function handle()
  {
    if($this->round->lobby->current_round_id != $this->round->id) return;
    $this->round->status = '2';
    $this->round->save();
    $lobby = App\Lobby::find($this->round->lobby_id);
    event(new EndRound($lobby));
    if($lobby->rounds->count() == $lobby->max_rounds) {
      return;
    }
    RoundNewJob::dispatch($lobby)->delay(now()->addSeconds(5));
  }
}
