<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GithubSetting extends Model
{
    protected $fillable = [
        'username',
        'token',
        'repo_visibility',
        'sync_enabled',
    ];

    protected $casts = [
        'sync_enabled' => 'boolean',
    ];
}
