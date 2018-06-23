<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PigBreeder extends Model
{
    protected $table = "pig_breeders";
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'cycle_sequence', 'pig_id', 'complete', "remark"
    ];
}
