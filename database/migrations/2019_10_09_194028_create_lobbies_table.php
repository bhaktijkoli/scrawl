<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLobbiesTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('lobbies', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name')->nullable();
      $table->string('code')->nullable();
      $table->integer('max_rounds')->nullable();
      $table->integer('max_time')->nullable();
      $table->integer('current_round_id')->nullable();
      $table->enum('status', ['0', '1', '2'])->default('0');
      $table->enum('private', ['0', '1'])->default('0');
      $table->unsignedInteger('user_id')->nullable();
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
    Schema::dropIfExists('lobbies');
  }
}
