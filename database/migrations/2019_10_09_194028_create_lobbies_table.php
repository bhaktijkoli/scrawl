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
      $table->integer('rounds')->nullable();
      $table->integer('status')->default(0);
      $table->integer('time')->nullable();
      $table->string('current_word')->nullable();
      $table->integer('current_word_player')->nullable();
      $table->integer('current_word_status')->nullable();
      $table->timestamp('current_endtime')->nullable();
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
