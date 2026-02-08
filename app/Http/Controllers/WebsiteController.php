<?php

namespace App\Http\Controllers;

use App\Models\AboutSetting;
use App\Models\ContactSetting;
use App\Models\HomePageSetting;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Services\GitHubService;

class WebsiteController extends Controller
{
    public function home()
    {
        $home = HomePageSetting::firstOrCreate(['id' => 1], []);

        $featuredLimit = (int) data_get($home->featured_projects, 'limit', 6);
        $featuredBtnText = (string) data_get($home->featured_projects, 'button_text', 'See all');

        $projects = Project::query()
            ->where('visibility', true)
            ->where('is_featured', true)
            ->latest()
            ->take($featuredLimit)
            ->get();

        $meta = $home->sections_meta ?? [];
        $miniStats = collect(data_get($home->hero, 'mini_stats', []))
            ->filter(fn ($item) =>
                !empty($item['value']) &&
                !empty($item['label'])
            )
            ->values()
            ->all();
        
        return view('pages.home', compact('home', 'projects', 'meta', 'featuredBtnText','miniStats'));
    }

    public function projects(Request $request, GitHubService $github)
    {
        $home = HomePageSetting::firstOrCreate(['id' => 1], []);
        $meta = $home->sections_meta ?? [];
        $activeFilter = $request->get('filter', 'all');

        $filters = [
            ['id' => 'all',          'label' => 'All'],
            ['id' => 'featured',     'label' => 'Featured'],
            ['id' => 'professional', 'label' => 'Professional'],
            ['id' => 'personal',     'label' => 'Personal'],
            ['id' => 'github',       'label' => 'GitHub'],
            ['id' => 'challenges',   'label' => 'Dev Challenges'],
        ];

        $projectsQuery = Project::query()->orderByDesc('id');

        $dbProjects = match ($activeFilter) {
            'featured' => $projectsQuery->where('is_featured', true)->get(),
            'professional' => $projectsQuery->where('type', 'professional')->get(),
            'personal' => $projectsQuery->where('type', 'personal')->get(),
            default => $projectsQuery->get(),
        };

        $visibleProjects = $dbProjects->map(fn ($p) => [
            'type' => $p->type,
            'featured' => (bool) $p->is_featured,
            'title' => $p->title,
            'subtitle' => $p->subtitle,
            'status' => $p->status,
            'image' => $p->image,
            'image' => $p->image ? asset('images/projects/'.$p->image) : null,
            'stack' => is_array($p->stack) ? $p->stack : (json_decode($p->stack ?? '[]', true) ?: []),
            'slug' => $p->slug,
            'url' => $p->url ?? null, 
        ])->toArray();
        
        $username = config('services.github.username');
        $token    = config('services.github.token');

        $githubRepos = $username ? $github->publicRepos($username, $token) : [];

        $challenges = [
            ['title' => 'Card Generator', 'desc' => 'Component-based UI practice', 'tags' => ['UI','Tailwind'], 'url' => '#', 'thumb' => 'upload/images/projects/frontend/frontend-1.avif'],
            ['title' => 'Landing Page', 'desc' => 'Hero + pricing layout', 'tags' => ['HTML','CSS'], 'url' => '#', 'thumb' => 'upload/images/projects/frontend/frontend-2.avif'],
            ['title' => 'Dashboard UI', 'desc' => 'Grid layout & stats cards', 'tags' => ['UI','Grid'], 'url' => '#', 'thumb' => 'upload/images/projects/frontend/frontend-3.avif'],
            ['title' => 'Form UI', 'desc' => 'Validation + spacing', 'tags' => ['Forms'], 'url' => '#', 'thumb' => 'upload/images/projects/frontend/frontend-4.avif'],
        ];

        $showLocal      = in_array($activeFilter, ['all','featured','professional','personal'], true);
        $showGithub     = in_array($activeFilter, ['all','github'], true);
        $showChallenges = in_array($activeFilter, ['all','challenges'], true);

        $stats = [
            [Project::count(), 'Projects'],
            [count($githubRepos), 'GitHub Repos'],
            ['24h', 'Response'],
            ['100%', 'Quality'],
        ];

        $githubUsername = $username;
        
         return view('pages.projects', compact(
            'filters',
            'activeFilter',
            'stats',
            'githubRepos',
            'visibleProjects',
            'challenges',
            'showLocal',
            'showGithub',
            'showChallenges',
            'githubUsername', 'meta'
        ));
    }

    public function projectShow(string $slug)
    {
        $p = Project::active()->where('slug', $slug)->firstOrCreate(['id' => 1], []);

        // ---------- normalize helpers ----------
        $arr = fn ($v) => is_array($v)
            ? array_values(array_filter($v, fn($x) => !is_null($x) && $x !== ''))
            : (json_decode($v ?? '[]', true) ?: []);

        // ---------- core ----------
        $mainImage = $p->image ?: null;

        $gallery = $arr($p->gallery);
        if ($mainImage) {
            $gallery = array_values(array_filter($gallery, fn ($g) => $g !== $mainImage));
        }

        // gallery thumbnails (main image first)
        $galleryThumbs = array_values(array_filter(array_merge([$mainImage], $gallery)));

        // ✅ process normalize (array of {title, desc})
        $process = collect($arr($p->process ?? '[]'))
            ->map(function ($row) {
                if (!is_array($row)) return null;
                $title = trim((string)($row['title'] ?? ''));
                $desc  = trim((string)($row['desc'] ?? ''));
                if ($title === '' && $desc === '') return null;
                return ['title' => $title, 'desc' => $desc];
            })
            ->filter()
            ->values()
            ->all();

        $project = [
            'id'          => $p->id,
            'slug'        => $p->slug,
            'type'        => $p->type,
            'is_featured' => (bool) $p->is_featured,
            'title'       => (string) $p->title,
            'subtitle'    => (string) ($p->subtitle ?? ''),
            'overview'    => (string) ($p->overview ?? ''),
            'status'      => (string) $p->status,
            'image'       => $mainImage,
            'gallery'     => $gallery,
            'thumbnails'  => $galleryThumbs,
            'stack'       => $arr($p->stack),
            'features'    => $arr($p->features),

            // ✅ add
            'process'     => $process,
        ];

        return view('pages.project-show', compact('project'));
    }

    public function about()
    {
        $settings = AboutSetting::firstOrCreate(['id' => 1], []);
        $contactSettings = ContactSetting::firstOrCreate(['id' => 1], []);
        return view('pages.about', compact('settings', 'contactSettings'));
    }

    public function contact()
    {
        $settings = ContactSetting::firstOrCreate(['id' => 1], []); 
        return view('pages.contact', compact('settings'));
    }
}
