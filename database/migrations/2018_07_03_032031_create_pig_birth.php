<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePigBirth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pig_birth', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('pig_id');
          $table->integer('pig_cycle_id');
          $table->date('birth_date');
          $table->integer('pig_count');
          $table->integer('life');
          $table->integer('dead');
          $table->integer('mummy');
          $table->integer('deformed');
          $table->string('pig_weight');
          $table->string('pig_weight_avg');
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
        Schema::dropIfExists('pig_birth');

    }
}
