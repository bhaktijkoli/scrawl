<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLobbyPlayersTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('lobby_players', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer('rounds')->default('0');
      $table->integer('points')->default('0');
      $table->enum('chat', [0, 1])->default('0');
      $table->unsignedInteger('user_id')->nullable();
      $table->unsignedInteger('lobby_id')->nullable();
      $table->timestamps();
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('lobby_players');
  }
}
