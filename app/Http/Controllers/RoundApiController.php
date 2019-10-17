<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Round;
use App\Word;
use App\Events\UpdateRound;
use Carbon\Carbon;
use Auth;

class RoundApiController extends Controller
{
  public function word(Request $request)
  {
    $round = Round::find($request->input('round', '-1'));
    if(!$round) abort(404);
    if($round->drawer_id != Auth::user()->id) abort(401);
    $word = Word::find($request->input('word', '-1'));
    if(!$word) abort(404);
    $round->word = $word->word;
    $round->status = '1';
    $round->end_at = Carbon::now()->addSeconds($round->lobby->max_time)->format('Y-m-d H:i:s');
    $round->save();
    event(new UpdateRound($round->lobby));
    return "Ok";
  }
}
