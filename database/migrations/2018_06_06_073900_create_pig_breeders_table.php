<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePigBreedersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pig_breeders', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('pig_cycle_id');
            $table->date('breed_date')->nullable();
            $table->integer('breed_week')->nullable();
            $table->string('breeder_id')->nullable();
            $table->date('delivery_date')->nullable();
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
        Schema::dropIfExists('pig_breeders');
    }
}
