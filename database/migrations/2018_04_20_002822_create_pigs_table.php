<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pigs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pig_id')->unique();
            $table->integer('pig_number')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('entry_date')->nullable();
            $table->string('source')->nullable();
            $table->string('male_breeder_pig_id')->nullable();
            $table->string('female_breeder_pig_id')->nullable();
            $table->integer('left_breast')->nullable();
            $table->integer('right_breast')->nullable();
            $table->string('blood_line')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('pigs');
    }
}
