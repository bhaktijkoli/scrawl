<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoundsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('rounds', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('word')->nullable();
      $table->integer('drawer_id');
      $table->enum('status', ['0', '1', '2'])->default('0');
      $table->timestamp('end_at')->nullable();
      $table->integer('lobby_id');
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
    Schema::dropIfExists('rounds');
  }
}
