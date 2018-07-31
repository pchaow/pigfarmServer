<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePigFeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pig_feed', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pig_id');
            $table->integer('pig_cycle_id');
            $table->integer('feed_type');
            $table->string('feed_date');
            $table->string('pig_id_old')->nullable(); 
            $table->string('pig_id_new')->nullable(); 
            $table->string('pig_count');
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
        Schema::dropIfExists('pig_feed');
    }
}
