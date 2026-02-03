<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [

            [
                'slug' => 'inventory-management-system',
                'title' => 'Inventory Management System',
                'subtitle' => 'Role-based dashboard, stock tracking, reports & exports.',
                'image' => 'project_1.avif',
                'gallery' => ['inventory-1.avif', 'inventory-2.avif', 'inventory-3.avif'],
                'stack' => ['Laravel', 'MySQL', 'Tailwind', 'Queues'],
                'status' => Project::STATUS_PRIVATE,
                'visibility' => Project::VIS_INACTIVE,
                'is_featured' => true,
                'type' => 'professional',
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
                'status' => Project::STATUS_LIVE,
                'visibility' => Project::VIS_ACTIVE,
                'type' => 'professional',
                'is_featured' => true,
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
                'status' => Project::STATUS_LIVE,
                'visibility' => Project::VIS_ACTIVE,
                'type' => 'professional',
                'is_featured' => true,
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
                'status' => Project::STATUS_LIVE,
                'visibility' => Project::VIS_ACTIVE,
                'is_featured' => false,
                'type' => 'professional',
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
                'status' => Project::STATUS_LIVE,
                'visibility' => Project::VIS_ACTIVE,
                'is_featured' => false,
                'type' => 'professional',
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
                'status' => Project::STATUS_LIVE,
                'visibility' => Project::VIS_ACTIVE,
                'is_featured' => false,
                'type' => 'professional',
                'overview' => 'A business website built with WordPress theme customization and performance optimization.',
                'features' => [
                    'Custom theme development',
                    'Responsive pages (Home, About, Services, Contact)',
                    'Speed optimization and SEO basics',
                    'Plugin integration and security hardening',
                ],
            ],

        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['slug' => $project['slug']],
                $project
            );
        }
    }
}
