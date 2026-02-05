<?php

namespace App\Http\Controllers;

use App\Models\AboutSetting;
use App\Models\HomePageSetting;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Services\GitHubService;

class WebsiteController extends Controller
{
    public function home()
    {
        $home = HomePageSetting::firstOrFail();
        $limit = (int) data_get($home->featured_projects, 'limit', 6);

        $projects = Project::query()
            ->where('visibility', true)
            ->where('is_featured', true)
            ->latest()
            ->take($limit)
            ->get();
        $meta = $home->sections_meta ?? [];
        return view('pages.home', compact('home', 'projects', 'meta'));
    }

    public function projects(Request $request, GitHubService $github)
    {
        $home = HomePageSetting::firstOrFail();
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
            'featured' => (bool) $p->featured,
            'title' => $p->title,
            'subtitle' => $p->subtitle,
            'status' => $p->status,
            'image' => $p->image,
            'stack' => is_array($p->stack) ? $p->stack : (json_decode($p->stack ?? '[]', true) ?: []),
            'slug' => $p->slug,
            'url' => $p->url ?? null, 
        ])->toArray();

        $username = config('services.github.username');
        $token    = config('services.github.token');

        $githubRepos = $username ? $github->publicRepos($username, $token) : [];

        $challenges = [
            ['title' => 'Card Generator', 'desc' => 'Component-based UI practice', 'tags' => ['UI','Tailwind'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-1.avif'],
            ['title' => 'Landing Page', 'desc' => 'Hero + pricing layout', 'tags' => ['HTML','CSS'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-2.avif'],
            ['title' => 'Dashboard UI', 'desc' => 'Grid layout & stats cards', 'tags' => ['UI','Grid'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-3.avif'],
            ['title' => 'Form UI', 'desc' => 'Validation + spacing', 'tags' => ['Forms'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-4.avif'],
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

    /**
     * Single Project page
     * URL: /projects/{slug}
     */
    public function projectShow(string $slug)
    {
        $p = Project::where('slug', $slug)->firstOrFail();

        $project = [
            'type'     => $p->type,
            'featured' => (bool) $p->featured,
            'title'    => $p->title,
            'subtitle' => $p->subtitle,
            'status'   => $p->status,
            'image'    => $p->image,
            'slug'     => $p->slug,
            'url'      => $p->url ?? null,

            'gallery'  => is_array($p->gallery)
                            ? $p->gallery
                            : (json_decode($p->gallery ?? '[]', true) ?: []),

            'stack'    => is_array($p->stack)
                            ? $p->stack
                            : (json_decode($p->stack ?? '[]', true) ?: []),

            'features' => is_array($p->features)
                            ? $p->features
                            : (json_decode($p->features ?? '[]', true) ?: []),

            'overview' => $p->overview ?? '',
        ];

        return view('pages.project-show', compact('project'));
    }

    public function about()
    {
        // $skills = [
        //     'Backend' => ['Laravel', 'PHP', 'MySQL', 'Redis', 'Queues', 'Auth/RBAC'],
        //     'Frontend' => ['Blade', 'Tailwind', 'Alpine.js', 'Livewire (optional)'],
        //     'Tools' => ['Git', 'Postman', 'Docker (basic)', 'Linux', 'Nginx (basic)'],
        //     'Deployment' => ['cPanel', 'VPS', 'SSL', 'Basic CI/CD'],
        // ];

        // return view('pages.about', compact('skills'));

        $settings = AboutSetting::firstOrCreate([]);
        return view('pages.about', compact('settings'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
