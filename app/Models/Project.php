<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public const STATUS_LIVE = 'Live';
    public const STATUS_PRIVATE = 'Private';
    public const STATUS_IN_PROGRESS = 'In Progress';

    public const VIS_ACTIVE = true;
    public const VIS_INACTIVE = false;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'image',
        'gallery',
        'stack',
        'features',
        'impact',
        'overview',
        'status',
        'visibility',
        'is_featured',
        'type',
        'sort_order',
    ];

    protected $casts = [
        'gallery'     => 'array',
        'stack'       => 'array',
        'features'    => 'array',
        'is_featured' => 'boolean',
        'sort_order'  => 'integer',
    ];

    public function scopeActive($q)
    {
        return $q->where('visibility', self::VIS_ACTIVE);
    }

    public function scopeFeatured($q)
    {
        return $q->where('is_featured', true);
    }
}
