<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PigFeed extends Model
{

    protected $table = "pig_feed";
    protected $fillable = [
        "pig_id",
        "pig_cycle_id",
        "feed_type",
        "feed_date",
        "pig_id_old",
        "pig_id_new",
        "pig_count",
        "pig_weight",
        "pig_remark",
        "pig_weight_avg"
        

    ];
}
