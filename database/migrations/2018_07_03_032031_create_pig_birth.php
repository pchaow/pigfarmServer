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
          $table->integer('pig_sequence');
          $table->string('date');
          $table->integer('all');
          $table->integer('life');
          $table->integer('dead');
          $table->integer('mummy');255
          $table->integer('deformed');
          $table->string('weight');
          $table->string('avg');
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
        //
    }
}
