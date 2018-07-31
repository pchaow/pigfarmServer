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

    function birth()
    {
        return $this->hasMany(PigBirth::class);
    }

    function milk()
    {
        return $this->hasMany(PigMilk::class);
    }
    function vaccine()
    {
        return $this->hasMany(Vaccine::class);
    }
    function feed()
    {
        return $this->hasMany(PigFeed::class);
    }
    function feedOut()
    {
        return $this->hasMany(PigFeedOut::class);
    }
}
