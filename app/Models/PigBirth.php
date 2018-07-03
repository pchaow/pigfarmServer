<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PigBirth extends Model
{
  protected $table = "pig_birth";
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
}
