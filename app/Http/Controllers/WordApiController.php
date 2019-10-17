<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Word;

class WordApiController extends Controller
{
  public function get()
  {
    return Word::all()->random(3);
  }
}
