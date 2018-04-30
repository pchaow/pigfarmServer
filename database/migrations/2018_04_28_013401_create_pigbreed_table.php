<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePigbreedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pigbreeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('breed_sequence');
            $table->integer('pig_id');
            $table->date('breed_date');
            $table->integer('breed_week');
            $table->date('delivery_date');
            $table->string('breeder_1_id')->nullable();
            $table->string('breeder_2_id')->nullable();
            $table->string('breeder_3_id')->nullable();
            $table->string('breed_status')->nullable();
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
        Schema::dropIfExists('pigbreeds');
    }
}
