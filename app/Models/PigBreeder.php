<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PigBreeder extends Model
{
    protected $table = "pig_breeders";
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        "pig_cycle_id","pig_id","breeder_a","breeder_b","breeder_c","breed_date","delivery_date","breed_week"
    ];
}
