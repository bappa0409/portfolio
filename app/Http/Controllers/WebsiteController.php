<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Services\GitHubService;

class WebsiteController extends Controller
{

    private function projectsData(): array
    {
        return [
            [
                'slug' => 'inventory-management-system',
                'title' => 'Inventory Management System',
                'subtitle' => 'Role-based dashboard, stock tracking, reports & exports.',
                'image' => 'project_1.avif',
                'gallery' => ['inventory-1.avif', 'inventory-2.avif', 'inventory-3.avif'],
                'stack' => ['Laravel', 'MySQL', 'Tailwind', 'Queues'],
                'status' => 'Private',
                'impact' => 'Reduced manual inventory work by ~60% with automation and reports.',
                'overview' => 'A full inventory system with suppliers, products, purchase/sales, stock alerts, and reporting.',
                'features' => [
                    'Role-based access (Admin/Manager/Staff)',
                    'Stock in/out and low-stock alerts',
                    'Reports with CSV export',
                    'Activity logs and audit trail',
                ],
            ],
            [
                'slug' => 'ecommerce-platform',
                'title' => 'Ecommerce Platform',
                'subtitle' => 'Cart, checkout, orders, admin panel, payment integration.',
                'image' => 'project_2.avif',
                'gallery' => ['inventory-1.avif', 'inventory-2.avif', 'inventory-3.avif'],
                'stack' => ['Laravel', 'MySQL', 'Stripe', 'Tailwind'],
                'status' => 'Live',
                'impact' => 'Improved checkout conversion with streamlined UX and faster load time.',
                'overview' => 'An ecommerce site with product catalog, cart, checkout, and admin order management.',
                'features' => [
                    'Product catalog & search',
                    'Cart and checkout flow',
                    'Payment integration (Stripe)',
                    'Order tracking and email notifications',
                ],
            ],
            [
                'slug' => 'booking-api',
                'title' => 'Booking API Development',
                'subtitle' => 'REST API with auth, rate limiting, logs, and clean docs.',
                'image' => 'project_3.avif',
                'gallery' => ['inventory-1.avif', 'inventory-2.avif', 'inventory-3.avif'],
                'stack' => ['Laravel', 'REST API', 'Sanctum', 'Redis'],
                'status' => 'Live',
                'impact' => 'Enabled mobile app integration with secure, documented endpoints.',
                'overview' => 'A booking API with authentication, slots, bookings, cancellations, and admin endpoints.',
                'features' => [
                    'Token auth (Sanctum)',
                    'Rate limiting and request validation',
                    'Structured logging and error handling',
                    'API docs-ready structure',
                ],
            ],
            [
                'slug' => 'erp-solution',
                'title' => 'ERP Solution',
                'subtitle' => 'ERP system with modules like HR, inventory, accounts, and reports.',
                'image' => 'project_4.avif',
                'gallery' => ['inventory-1.avif', 'inventory-2.avif', 'inventory-3.avif'],
                'stack' => ['Laravel', 'MySQL', 'Tailwind', 'RBAC'],
                'status' => 'Live',
                'impact' => 'Streamlined business operations with centralized modules and reporting.',
                'overview' => 'An ERP solution built for managing core business operations with role-based access.',
                'features' => [
                    'HR & employee management',
                    'Inventory & stock management',
                    'Accounting & transaction records',
                    'Reports and exports',
                ],
            ],
            [
                'slug' => 'news-portal-cms',
                'title' => 'News Portal & CMS',
                'subtitle' => 'SEO-friendly news portal with category, tag, and editor workflows.',
                'image' => 'project_5.avif',
                'gallery' => ['inventory-1.avif', 'inventory-2.avif', 'inventory-3.avif'],
                'stack' => ['Laravel', 'MySQL', 'Tailwind', 'SEO'],
                'status' => 'Live',
                'impact' => 'Improved content publishing flow with role-based editors and optimized SEO structure.',
                'overview' => 'A news portal CMS with admin panel, editor roles, and publishing workflow.',
                'features' => [
                    'Category, tag, and post management',
                    'Editor & admin roles',
                    'SEO-friendly URLs and metadata',
                    'Media library and scheduled publishing',
                ],
            ],
            [
                'slug' => 'business-website-wordpress',
                'title' => 'Business Website (WordPress)',
                'subtitle' => 'Custom WordPress theme development and business website customization.',
                'image' => 'project_6.avif',
                'gallery' => ['inventory-1.avif', 'inventory-2.avif', 'inventory-3.avif'],
                'stack' => ['WordPress', 'PHP', 'Custom Theme', 'Elementor'],
                'status' => 'Live',
                'impact' => 'Delivered a fast, responsive business website with easy content management.',
                'overview' => 'A business website built with WordPress theme customization and performance optimization.',
                'features' => [
                    'Custom theme development',
                    'Responsive pages (Home, About, Services, Contact)',
                    'Speed optimization and SEO basics',
                    'Plugin integration and security hardening',
                ],
            ],
        ];
    }

    public function home()
    {
        $projects = Project::get()->take(6);

        $services = [
            ['Laravel Web Apps', 'Custom dashboards, RBAC, business modules.'],
            ['REST API Development', 'Secure APIs for mobile apps & integrations.'],
            ['Admin Panels', 'Filament/Nova CRUD, reports, exports.'],
            ['Payment Integration', 'Stripe/PayPal/SSLCommerz, checkout flows.'],
            ['Bug Fixing', 'Fix errors, refactor, upgrade Laravel versions.'],
            ['Performance Optimization', 'Query tuning, caching, speed improvements.'],
        ];

        return view('pages.home', compact('projects', 'services'));
    }

    public function projects(Request $request, GitHubService $github)
    {
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
            'githubUsername'
        ));
    }

    public function projectShow(Request $request, GitHubService $github, $slug)
    {
        // $project = collect($this->projectsData())->firstWhere('slug', $slug);
        // abort_if(!$project, 404);

        // $project = Cache::remember("projects.slug.{$slug}", 60 * 60, function () use ($slug) {
        //     return Project::where('slug', $slug)->first();
        // });

        // abort_if(!$project, 404);


        // $activeFilter = $request->get('filter', 'all');

        // // Your local projects (recommended: move to DB later)
        // $projects = [
        //     [
        //         'type' => 'professional',
        //         'featured' => true,
        //         'title' => 'Health Master',
        //         'subtitle' => 'Healthcare landing + admin concept, responsive UI.',
        //         'status' => 'Completed',
        //         'image' => 'healthmaster.jpg',
        //         'stack' => ['Laravel','Tailwind','MySQL'],
        //         'slug' => 'health-master',
        //     ],
        //     [
        //         'type' => 'professional',
        //         'featured' => true,
        //         'title' => 'Welcome to WeRent',
        //         'subtitle' => 'Real estate / rental platform UI + modules.',
        //         'status' => 'In Progress',
        //         'image' => 'werent.jpg',
        //         'stack' => ['Laravel','REST API','MySQL'],
        //         'slug' => 'werent',
        //     ],
        //     [
        //         'type' => 'personal',
        //         'featured' => false,
        //         'title' => 'Farming Solutions',
        //         'subtitle' => 'Business website with admin + content sections.',
        //         'status' => 'Completed',
        //         'image' => 'farming.jpg',
        //         'stack' => ['PHP','Bootstrap','MySQL'],
        //         'slug' => 'farming-solutions',
        //     ],
        // ];

        // $challenges = [
        //     ['title' => 'Card Generator', 'desc' => 'Component-based UI practice', 'tags' => ['UI','Tailwind'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-1.avif'],
        //     ['title' => 'Landing Page', 'desc' => 'Hero + pricing layout', 'tags' => ['HTML','CSS'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-2.avif'],
        // ];

        // $filters = [
        //     ['id' => 'all', 'label' => 'All'],
        //     ['id' => 'featured', 'label' => 'Featured'],
        //     ['id' => 'professional', 'label' => 'Professional'],
        //     ['id' => 'personal', 'label' => 'Personal'],
        //     ['id' => 'github', 'label' => 'GitHub'],
        //     ['id' => 'challenges', 'label' => 'Dev Challenges'],
        // ];

        // // GitHub repos
        // $username = config('services.github.username');
        // $token = config('services.github.token');
        // $githubRepos = $username ? $github->repos($username, $token) : [];

        // // Filter local projects
        // $visibleProjects = match ($activeFilter) {
        //     'featured' => array_values(array_filter($projects, fn($p) => !empty($p['featured']))),
        //     'professional' => array_values(array_filter($projects, fn($p) => ($p['type'] ?? '') === 'professional')),
        //     'personal' => array_values(array_filter($projects, fn($p) => ($p['type'] ?? '') === 'personal')),
        //     default => $projects,
        // };


        $activeFilter = $request->get('filter', 'all');

    $filters = [
        ['id' => 'all',          'label' => 'All'],
        ['id' => 'featured',     'label' => 'Featured'],
        ['id' => 'professional', 'label' => 'Professional'],
        ['id' => 'personal',     'label' => 'Personal'],
        ['id' => 'github',       'label' => 'GitHub'],
        ['id' => 'challenges',   'label' => 'Dev Challenges'],
    ];

    // ✅ DB Projects (Project model)
    $projectsQuery = Project::query()->orderByDesc('id');

    $dbProjects = match ($activeFilter) {
        'featured' => $projectsQuery->where('featured', true)->get(),
        'professional' => $projectsQuery->where('type', 'professional')->get(),
        'personal' => $projectsQuery->where('type', 'personal')->get(),
        default => $projectsQuery->get(),
    };

    // ✅ Convert Eloquent -> array (Blade uses $p['title'])
    $visibleProjects = $dbProjects->map(fn ($p) => [
        'type' => $p->type,
        'featured' => (bool) $p->featured,
        'title' => $p->title,
        'subtitle' => $p->subtitle,
        'status' => $p->status,
        'image' => $p->image,
        'stack' => is_array($p->stack) ? $p->stack : (json_decode($p->stack ?? '[]', true) ?: []),
        'slug' => $p->slug,
        'url' => $p->url ?? null, // optional column থাকলে
    ])->toArray();

    // ✅ GitHub repos (YOUR service)
    $username = config('services.github.username');
    $token    = config('services.github.token');
    $githubRepos = $username ? $github->publicRepos($username, $token) : [];

    // ✅ Challenges
    $challenges = [
        ['title' => 'Card Generator', 'desc' => 'Component-based UI practice', 'tags' => ['UI','Tailwind'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-1.avif'],
        ['title' => 'Landing Page', 'desc' => 'Hero + pricing layout', 'tags' => ['HTML','CSS'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-2.avif'],
        ['title' => 'Dashboard UI', 'desc' => 'Grid layout & stats cards', 'tags' => ['UI','Grid'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-3.avif'],
        ['title' => 'Form UI', 'desc' => 'Validation + spacing', 'tags' => ['Forms'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-4.avif'],
    ];

    // ✅ Section flags (exactly like your Blade expects)
    $showLocal      = in_array($activeFilter, ['all','featured','professional','personal'], true);
    $showGithub     = in_array($activeFilter, ['all','github'], true);
    $showChallenges = in_array($activeFilter, ['all','challenges'], true);

    // ✅ Stats
    $stats = [
        [Project::count(), 'Projects'],
        [count($githubRepos), 'GitHub Repos'],
        ['24h', 'Response'],
        ['100%', 'Quality'],
    ];

    // ✅ GitHub username for link (Blade expects $githubUsername)
    $githubUsername = $username;

   


        return view('pages.project-show', compact( 'filters',
            'activeFilter',
            'stats',
            'githubRepos',
            'visibleProjects',
            'challenges',
            'showLocal',
            'showGithub',
            'showChallenges',
            'githubUsername'
        ));
    }

    public function about()
    {
        $skills = [
            'Backend' => ['Laravel', 'PHP', 'MySQL', 'Redis', 'Queues', 'Auth/RBAC'],
            'Frontend' => ['Blade', 'Tailwind', 'Alpine.js', 'Livewire (optional)'],
            'Tools' => ['Git', 'Postman', 'Docker (basic)', 'Linux', 'Nginx (basic)'],
            'Deployment' => ['cPanel', 'VPS', 'SSL', 'Basic CI/CD'],
        ];

        return view('pages.about', compact('skills'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
