<?php

use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    $words = [
      'bottle',
      'building',
      'hamburger',
      'pizza',
      'umbrella',
    ];
    foreach ($words as $word) {
      $w = new \App\Word;
      $w->word = $word;
      $w->save();
    }
  }
}
