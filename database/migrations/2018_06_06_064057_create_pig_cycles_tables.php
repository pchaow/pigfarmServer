<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePigCyclesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pigcycles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cycle_sequence');
            $table->integer('pig_id');
            $table->boolean('complete')->nullable();
            $table->text("remark")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pigcycles');
    }
}
