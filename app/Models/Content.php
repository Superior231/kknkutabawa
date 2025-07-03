<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'label',
        'hero_image',
        'hero_title',
        'hero_description',
        'profile_population',
        'profile_profession',
        'profile_area',
        'profile_description',
    ];
}
