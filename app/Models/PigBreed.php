<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PigBreed extends Model
{
    protected $table = "pigbreeds";

    protected $fillable = [
        'breed_sequence',
        'pig_id',
        'breed_week',
        'breed_date',
        'delivery_date',
        'breeder_1_id',
        'breeder_2_id',
        'breeder_3_id',
        'breed_status',
    ];


    public function pig()
    {
        return $this->belongsTo(Pig::class, "pig_id");
    }

    public function breedStatus(){
        return $this->belongsTo(Choice::class, "breed_status", "name");
    }
}
