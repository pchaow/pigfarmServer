<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
      protected $table = "vaccineuse";
      protected $fillable = [
            "pig_cycle_id",
            "date",
            "name",
            "display",
            "pig_id",
            "cycle_type",
            "cost" 
        ];
}
