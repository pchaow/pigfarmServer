<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportGoal extends Model
{
    protected $table = "report_goal";

    protected $fillable = [
        'report_type'
        , 'report_date',
        'report_year'
        , 'active_breeder'
        , 'breeded_breeder'
        , 'delivery_breeder'
        , 'delivery_ratio'
        , 'pig_delivered_rate'
        , 'pig_delivered_died_percent'
        , 'pig_delivered_success_avg'

        , 'pig_delivered_weight'
        , 'pig_raising_failed_perent'

        , 'ween_breeder'
        , 'pig_ween_number'
        , 'pig_ween_rate'
        , 'pig_ween_weight_avg'

        , 'delivered_breeder_rate'
        , 'pig_ween_breeder_rate'

        , 'breeder_replace_number'
        , 'breeder_drop_percent'
        , 'breeder_replace_drop_sum'
    ];

}
