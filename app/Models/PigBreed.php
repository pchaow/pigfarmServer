<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PigBreed extends Model
{
    protected $table = "pig_breeders";

    protected $fillable = [
        'cycle_sequence', 'pig_id', 'complete', "remark"
    ];
}
