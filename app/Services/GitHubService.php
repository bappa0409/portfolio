<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GitHubService
{
    public function publicRepos(string $username, ?string $token = null, int $withMetaForTop = 12): array
    {
        $userCacheKey = $this->userCacheKey($username, $token);

        return Cache::remember($userCacheKey, now()->addHours(2), function () use ($username, $token, $withMetaForTop) {

            $res = $this->client($token)->get("https://api.github.com/users/{$username}/repos", [
                'per_page' => 100,
                'sort' => 'updated',
                'direction' => 'desc',
            ]);

            if (!$res->ok()) return [];

            $repos = collect($res->json())
                ->where('fork', false)
                ->map(function ($r) use ($username) {
                    return [
                        'type' => 'github',
                        'name' => $r['name'] ?? '',
                        'desc' => $r['description'] ?? '',
                        'stars' => $r['stargazers_count'] ?? 0,
                        'forks' => $r['forks_count'] ?? 0,
                        'url' => $r['html_url'] ?? '#',
                        'updated_at' => $r['updated_at'] ?? null,
                        'default_branch' => $r['default_branch'] ?? 'main',
                        'owner' => data_get($r, 'owner.login', $username),

                        // optional primary language (nice for badge)
                        'lang' => $r['language'] ?? null,

                        'languages_url' => $r['languages_url'] ?? null,
                    ];
                })
                ->values()
                ->all();

            // Only top N repos get meta
            $limit = min($withMetaForTop, count($repos));

            for ($i = 0; $i < $limit; $i++) {
                $repo = $repos[$i];

                $meta = $this->repoMeta(
                    owner: $repo['owner'],
                    repo: $repo['name'],
                    branch: $repo['default_branch'],
                    languagesUrl: $repo['languages_url'],
                    token: $token
                );

                $repos[$i]['languages'] = $meta['languages'];
                $repos[$i]['commits']   = $meta['commits'];
            }

            return $repos;
        });
    }

    /**
     * Repo meta wrapper: fetch languages + commits with per-repo cache
     */
    private function repoMeta(string $owner, string $repo, string $branch, ?string $languagesUrl, ?string $token = null): array
    {
        $repoCacheKey = $this->repoCacheKey($owner, $repo, $branch, $token);

        return Cache::remember($repoCacheKey, now()->addHours(12), function () use ($owner, $repo, $branch, $languagesUrl, $token) {
            return [
                'languages' => $this->fetchLanguages($languagesUrl, $token),
                'commits'   => $this->fetchCommitCount($owner, $repo, $branch, $token),
            ];
        });
    }

    private function fetchLanguages(?string $languagesUrl, ?string $token = null): array
    {
        if (empty($languagesUrl)) return [];

        $cacheKey = "gh_lang:" . md5(($token ? 't:' : 'p:') . $languagesUrl);

        return Cache::remember($cacheKey, now()->addHours(24), function () use ($languagesUrl, $token) {
            $res = $this->client($token)->get($languagesUrl);

            if (!$res->ok()) return [];

            $json = $res->json();
            return is_array($json) ? $json : [];
        });
    }

    /**
     * Total commit count using Link rel="last" with per_page=1
     */
    private function fetchCommitCount(string $owner, string $repo, string $branch = 'main', ?string $token = null): int
    {
        $cacheKey = "gh_commits:" . md5(($token ? 't:' : 'p:') . "{$owner}/{$repo}@{$branch}");

        return Cache::remember($cacheKey, now()->addHours(12), function () use ($owner, $repo, $branch, $token) {

            $res = $this->client($token)->get("https://api.github.com/repos/{$owner}/{$repo}/commits", [
                'per_page' => 1,
                'sha' => $branch,
            ]);

            if (!$res->ok()) return 0;

            $link = $res->header('Link');

            if (!empty($link)) {
                $parts = array_map('trim', explode(',', $link));

                foreach ($parts as $part) {
                    if (!str_contains($part, 'rel="last"')) continue;

                    if (preg_match('/<([^>]+)>/', $part, $m)) {
                        $lastUrl = $m[1];

                        $query = parse_url($lastUrl, PHP_URL_QUERY) ?: '';
                        parse_str($query, $qs);

                        if (!empty($qs['page'])) {
                            return (int) $qs['page'];
                        }
                    }
                }
            }

            // Link missing => 0 or 1 commit
            $arr = $res->json();
            if (is_array($arr) && count($arr) === 0) return 0;

            return 1;
        });
    }

    /**
     * Shared GitHub HTTP client
     */
    private function client(?string $token = null)
    {
        $req = Http::withHeaders([
            'Accept' => 'application/vnd.github+json',
            'User-Agent' => config('app.name', 'Laravel'),
        ])->timeout(10);

        return !empty($token) ? $req->withToken($token) : $req;
    }

    private function userCacheKey(string $username, ?string $token): string
    {
        // token changes rate limit/visibility sometimes; keep cache separate
        return "gh_repos:" . md5(($token ? 't:' : 'p:') . $username);
    }

    private function repoCacheKey(string $owner, string $repo, string $branch, ?string $token): string
    {
        return "gh_repo_meta:" . md5(($token ? 't:' : 'p:') . "{$owner}/{$repo}@{$branch}");
    }
}
