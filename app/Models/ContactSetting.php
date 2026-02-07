<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $fillable = [
        'page_meta',
        'contact_cards',
        'social_links',
    ];

    protected $casts = [
        'page_meta'      => 'array',
        'contact_cards'  => 'array',
        'social_links'   => 'array',
    ];
}
