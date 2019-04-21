<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportGoal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_goal',function(Blueprint $table){
            $table->increments('id');
            $table->enum('report_type',['month','quater1','quater2','quater3','quater4','year']);
            $table->date('report_date');
            $table->float('active_breeder');
            $table->float('breeded_breeder');
            $table->float('delivery_breeder');

            $table->float('delivery_ratio');
            $table->float('pig_delivered_rate');
            $table->float('pig_delivered_died_percent');
            $table->float('pig_delivered_success_avg');

            $table->float('pig_delivered_weight');
            $table->float('pig_raising_failed_perent');

            $table->float('ween_breeder');
            $table->float('pig_ween_number');
            $table->float('pig_ween_rate');
            $table->float('pig_ween_weight_avg');

            $table->float('delivered_breeder_rate');
            $table->float('pig_ween_breeder_rate');

            $table->float('breeder_replace_number');
            $table->float('breeder_drop_percent');
            $table->float('breeder_replace_drop_sum');

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
        Schema::dropIfExists('report_goal');
    }
}
