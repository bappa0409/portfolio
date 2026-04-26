<?php

namespace Database\Seeders;

use App\Models\GithubSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GithubSettingSeeder extends Seeder
{
    public function run(): void
    {
        GithubSetting::updateOrCreate(
            ['id' => 1],
            [
                'username' => 'bappa0409',
                'token' => null, 
                'repo_visibility' => 'public',
                'sync_enabled' => true,
            ]
        );
    }
}
