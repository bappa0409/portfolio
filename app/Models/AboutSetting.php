<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSetting extends Model
{
    protected $fillable = [
        'header',
        'terminal',
        'tags',
        'profile',
        'journey',
        'education',
        'training',
        'experience',
        'skills',
        'philosophy',
        'passions',
        'footer'
    ];

    protected $casts = [
        'header'     => 'array',
        'terminal'   => 'array',
        'tags'       => 'array',
        'profile'    => 'array',
        'education'  => 'array',
        'training'   => 'array',
        'experience' => 'array',
        'skills'     => 'array',
        'philosophy' => 'array',
        'passions'   => 'array',
        'footer' => 'array',
    ];
}
