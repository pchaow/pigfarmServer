<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaccineuseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccineuse', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->string('name');
            $table->string('display');
            $table->string('pig_id');
            $table->string('cycle_sequence');
            $table->integer('cycle_type');
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
        Schema::dropIfExists('vaccineuse');
    }
}
