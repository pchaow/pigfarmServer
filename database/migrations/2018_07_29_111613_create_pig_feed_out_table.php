<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePigFeedOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pig_feed_out', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pig_id');
            $table->integer('pig_cycle_id');
            $table->integer('pig_count');
            $table->string('feed_type');
            $table->string('feed_why_type');
            $table->string('feed_date'); 
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
        Schema::dropIfExists('pig_feed_out');
    }
}
