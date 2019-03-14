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
            $table->integer('pig_cycle_id'); //รอบ
            $table->string('pig_id')->nullable(); //ไอดีหมู
            $table->string('breeder_a')->nullable();//พ่อพันธ์ุ
            $table->string('breeder_b')->nullable();//พ่อพันธ์ุ
            $table->string('breeder_c')->nullable();//พ่อพันธ์ุ
            $table->date('breed_date')->nullable();//วันผสม
            $table->date('delivery_date')->nullable();//วันคลอด
            $table->integer('breed_week')->nullable();
            $table->integer('gravid')->nullable()->default(0);
            $table->date('gravid_date')->nullable();
            $table->string('gravid_out')->nullable();
            $table->string('gravid_out_remark')->nullable();
            $table->string('gravid_remark')->nullable();
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
