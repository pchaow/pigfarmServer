<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PigCycle extends Model
{
    protected $table = "PigCycles";

    protected $fillable = [
        'cycle_sequencce', 'pig_id', 'complete', "remark"
    ];

    function pig()
    {
        return $this->belongsTo(Pig::class, "pig_id");
    }

    function breeders()
    {
        return $this->hasMany(PigBreeder::class);
    }
}
