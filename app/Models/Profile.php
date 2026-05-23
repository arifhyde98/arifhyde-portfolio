<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'title',
        'short_bio',
        'about_description',
        'profile_photo',
        'resume_url',
        'email',
        'whatsapp',
        'github',
        'linkedin',
    ];
}
