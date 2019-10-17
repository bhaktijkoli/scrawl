<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Events\EndRound;

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
    $this->round->status = '2';
    $this->round->save();
    event(new EndRound($this->round->lobby));
  }
}
