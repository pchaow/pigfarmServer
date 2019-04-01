<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportQuaterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_quater', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_quater');
            $table->string('report_year');
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

            $table->float('delivered_breeder_rate'); //จำนวนครอกต่อแม่ต่อปี
            $table->float('pig_ween_breeder_rate'); //จำนวนลูกลูกหย่านม/แม่/ปี (PSY)
            $table->float('pig_khun_breeder_rate'); //จำนวนสุกรขุนต่อแม่ต่อปี(9%) (MSY)

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
        Schema::dropIfExists('report_quater');
    }
}
