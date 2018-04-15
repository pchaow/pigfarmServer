<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = ['name', 'display_name', 'description', 'parent_id', 'children_fields', 'values'];

    protected $casts = [
        'children_fields' => 'json',
        'values' => 'json',
    ];

    public function children()
    {
        return $this->hasMany(Choice::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Choice::class, 'parent_id');
    }
}
