<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $fillable = [
        'page_meta',
        'contact_cards',
        'social_links',
        'system_status',
        'availability',
    ];

    protected $casts = [
        'page_meta'      => 'array',
        'contact_cards'  => 'array',
        'social_links'   => 'array',
        'system_status'  => 'array',
        'availability'   => 'array',
    ];
}
