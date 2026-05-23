<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppearanceSetting extends Model
{
    protected $fillable = [
        'hero_headline',
        'hero_subtitle',
        'primary_color',
        'secondary_color',
        'bg_style',
        'cta_text',
        'cta_link',
    ];
}
