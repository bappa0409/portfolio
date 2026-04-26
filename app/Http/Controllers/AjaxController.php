<?php

namespace App\Http\Controllers;

use App\Models\GithubSetting;
use App\Services\GitHubService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AjaxController extends Controller
{
    public function githubRepos(Request $request, GitHubService $github)
    {
        $settings = Cache::rememberForever('github_settings', function () {
            return GithubSetting::firstOrCreate(['id' => 1]);
        });

        $username = $settings->username;
        $token    = $settings->token;

        if (!$username) {
            return response()->json([
                'html' => '<div class="text-white/60">GitHub username not set.</div>'
            ]);
        }

        $repos = $github->publicRepos($username, $token);

        $html = view('partials.github-repos', [
            'githubRepos' => $repos,
            'githubUsername' => $username
        ])->render();

        return response()->json([
            'html' => $html
        ]);
    }
}
