<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\GithubSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GitHubController extends Controller
{
   private function settings(): GithubSetting
    {
        return GithubSetting::firstOrCreate(['id' => 1]);
    }

    private function clearCache(?string $username = null, ?string $token = null): void
    {
        // settings cache clear
        Cache::forget('github_settings');

        // repos cache clear (important)
        if ($username) {
            $cacheKey = "gh_repos:" . md5(($token ? 't:' : 'p:') . $username);
            Cache::forget($cacheKey);
        }
    }

    public function edit()
    {
        $settings = $this->settings();

        return view(
            'backend.pages.settings.github',
            compact('settings')
        );
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'username'        => ['nullable','string','max:255'],
            'token'           => ['nullable','string','max:500'],
            'repo_visibility' => ['nullable','string','in:all,public,private'],
            'sync_enabled'    => ['nullable','boolean'],
        ]);

        $settings = $this->settings();

        $oldUsername = $settings->username;
        $oldToken    = $settings->token;

        $settings->update([
            'username'        => $data['username'] ?? null,
            'token'           => $data['token'] ?? null,
            'repo_visibility' => $data['repo_visibility'] ?? 'public',
            'sync_enabled'    => $request->boolean('sync_enabled'),
        ]);

        // clear old cache + new cache
        $this->clearCache($oldUsername, $oldToken);
        $this->clearCache($settings->username, $settings->token);

        return response()->json([
            'message' => 'GitHub settings updated successfully!'
        ]);
    }
}
