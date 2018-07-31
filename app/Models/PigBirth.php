<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PigBirth extends Model
{
  protected $table = "pig_birth";
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  protected $fillable = [
    "pig_id",
"pig_cycle_id",
"birth_date",
"pig_count",
"life",
"dead",
"mummy",
"deformed",
"pig_weight",
"pig_weight_avg"

];
}
