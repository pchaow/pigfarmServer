<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = ['name', 'display_name', 'description', 'parent_name', 'children_fields', 'values'];

    protected $casts = [
        'children_fields' => 'object',
        'values' => 'object',
    ];

    public function children()
    {
        return $this->hasMany(Choice::class, 'parent_name', 'name');
    }

    public function parent()
    {
        return $this->belongsTo(Choice::class, 'parent_name', 'name');
    }


}
