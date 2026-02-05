<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePageSetting extends Model
{
    protected $fillable = [
        'sections_meta',
        'hero',
        'services',
        'cta_top',
        'why_choose_me',
        'process',
        'tech_stack',
        'stats',
        'cta_bottom',
        'testimonials',
        'faq',
        'featured_projects',
    ];

    protected $casts = [
        'sections_meta' => 'array',
        'hero' => 'array',
        'services' => 'array',
        'cta_top' => 'array',
        'why_choose_me' => 'array',
        'process' => 'array',
        'tech_stack' => 'array',
        'stats' => 'array',
        'cta_bottom' => 'array',
        'testimonials' => 'array',
        'faq' => 'array',
        'featured_projects' => 'array',
    ];
}
