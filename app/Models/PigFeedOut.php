<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PigFeedOut extends Model
{
    //
    protected $table = "pig_feed_out";
    protected $fillable = [
        "pig_id",
        "pig_cycle_id",
        "pig_count",
        "feed_type",
        "feed_why_type",
        "feed_date"
        
    ];
}
