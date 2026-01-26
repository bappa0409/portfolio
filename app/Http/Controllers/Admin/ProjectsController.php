<?php

namespace App\Http\Controllers\Admin;

use App\Services\GitHubService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    public function index(Request $request, GitHubService $github)
    {
        $activeFilter = $request->get('filter', 'all');

        // Your local projects (recommended: move to DB later)
        $projects = [
            [
                'type' => 'professional',
                'featured' => true,
                'title' => 'Health Master',
                'subtitle' => 'Healthcare landing + admin concept, responsive UI.',
                'status' => 'Completed',
                'image' => 'healthmaster.jpg',
                'stack' => ['Laravel','Tailwind','MySQL'],
                'slug' => 'health-master',
            ],
            [
                'type' => 'professional',
                'featured' => true,
                'title' => 'Welcome to WeRent',
                'subtitle' => 'Real estate / rental platform UI + modules.',
                'status' => 'In Progress',
                'image' => 'werent.jpg',
                'stack' => ['Laravel','REST API','MySQL'],
                'slug' => 'werent',
            ],
            [
                'type' => 'personal',
                'featured' => false,
                'title' => 'Farming Solutions',
                'subtitle' => 'Business website with admin + content sections.',
                'status' => 'Completed',
                'image' => 'farming.jpg',
                'stack' => ['PHP','Bootstrap','MySQL'],
                'slug' => 'farming-solutions',
            ],
        ];

        $challenges = [
            ['title' => 'Card Generator', 'desc' => 'Component-based UI practice', 'tags' => ['UI','Tailwind'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-1.avif'],
            ['title' => 'Landing Page', 'desc' => 'Hero + pricing layout', 'tags' => ['HTML','CSS'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-2.avif'],
        ];

        $filters = [
            ['id' => 'all', 'label' => 'All'],
            ['id' => 'featured', 'label' => 'Featured'],
            ['id' => 'professional', 'label' => 'Professional'],
            ['id' => 'personal', 'label' => 'Personal'],
            ['id' => 'github', 'label' => 'GitHub'],
            ['id' => 'challenges', 'label' => 'Dev Challenges'],
        ];

        // GitHub repos
        $username = config('services.github.username');
        $token = config('services.github.token');
        $githubRepos = $username ? $github->repos($username, $token) : [];

        // Filter local projects
        $visibleProjects = match ($activeFilter) {
            'featured' => array_values(array_filter($projects, fn($p) => !empty($p['featured']))),
            'professional' => array_values(array_filter($projects, fn($p) => ($p['type'] ?? '') === 'professional')),
            'personal' => array_values(array_filter($projects, fn($p) => ($p['type'] ?? '') === 'personal')),
            default => $projects,
        };

      
        return view('projects', compact(
            'filters',
            'activeFilter',
            'visibleProjects',
            'githubRepos',
            'challenges',
            'username'
        ));
    }
}
