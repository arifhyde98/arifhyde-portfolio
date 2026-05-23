<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'percentage',
        'category',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'percentage' => 'integer',
        'display_order' => 'integer',
        'is_active' => 'boolean',
    ];
}
