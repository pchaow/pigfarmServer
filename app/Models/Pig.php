<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pig extends Model
{
    protected $fillable =
        [
            'pig_id',
            'pig_number',
            'birth_date',
            'entry_date',
            'source',
            'male_breeder_pig_id',
            'female_breeder_pig_id',
            'left_breast',
            'right_breast',
            'blood_line',
            'status',
        ];

}
