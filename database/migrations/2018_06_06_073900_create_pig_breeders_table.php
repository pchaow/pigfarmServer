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
            $table->bigInteger('pig_cycle_id'); //รอบ
            $table->string('pig_id')->nullable(); //ไอดีหมู
              $table->string('breeder_id')->nullable();//พ่อพันธ์ุ
            $table->string('breed_date')->nullable();//วันผสม
            $table->string('delivery_date')->nullable();//วันคลอด
            $table->integer('breed_week')->nullable();
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
