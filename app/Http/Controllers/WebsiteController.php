<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    private function projectsData(): array
    {
        return [
            [
                'slug' => 'inventory-management-system',
                'title' => 'Inventory Management System',
                'subtitle' => 'Role-based dashboard, stock tracking, reports & exports.',
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
        $projects = array_slice($this->projectsData(), 0, 6);

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

    public function projects()
    {
        $projects = $this->projectsData();
        return view('pages.projects', compact('projects'));
    }

    public function projectShow(string $slug)
    {
        $project = collect($this->projectsData())->firstWhere('slug', $slug);

        abort_if(!$project, 404);

        return view('pages.project-show', compact('project'));
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
