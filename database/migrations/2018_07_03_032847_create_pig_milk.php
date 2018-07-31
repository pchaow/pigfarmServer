<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePigMilk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pig_Milk', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('pig_id');
          $table->integer('pig_cycle_id');
          $table->string('milk_date');
          $table->integer('pig_count');
          $table->string('pig_weight_avg');
          $table->string('pig_weight');
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
        Schema::dropIfExists('pig_Milk');

    }
}
