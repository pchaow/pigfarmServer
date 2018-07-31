<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pig extends Model
{

    use SoftDeletes;

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
            'status',
        ];

    public function bloodLine()
    {
        return $this->belongsTo(Choice::class, "blood_line", "name");
    }

    public function status()
    {
        return $this->belongsTo(Choice::class, "status", "name");
    }

    public function cycles()
    {
        return $this->hasMany(PigCycle::class, "pig_id", "id");
    }

}
