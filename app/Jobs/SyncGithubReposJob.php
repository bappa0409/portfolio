<?php

namespace App\Jobs;

use App\Models\GithubSetting;
use App\Services\GitHubService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;

class SyncGithubReposJob implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(GitHubService $github): void
    {
        $settings = Cache::rememberForever('github_settings', function () {
            return GithubSetting::firstOrCreate(['id' => 1]);
        });

        if (!$settings->username) {
            return;
        }

        // cache warm
        $github->publicRepos(
            $settings->username,
            $settings->token
        );

        Cache::forget('github_sync_running');
    }
}
