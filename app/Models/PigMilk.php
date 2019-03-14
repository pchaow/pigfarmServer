<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PigMilk extends Model
{
  protected $table = "pig_milk";
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  protected $fillable = [
    "pig_id",
    "pig_cycle_id",
    "milk_date",
    "pig_count",
    "pig_weight_avg",
    "pig_weight"
    

];
}
