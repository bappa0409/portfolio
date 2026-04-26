<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomePageSetting;

class HomePageSettingSeeder extends Seeder
{
    public function run(): void
    {
        HomePageSetting::updateOrCreate(
            ['id' => 1],
            [
                'sections_meta' => [
                    'services' => [
                        'title' => 'Services',
                        'subtitle' => 'I provide complete web development and quality assurance services, focused on scalable architecture, clean code, and reliable delivery.',
                    ],
                    'why_choose' => [
                        'title' => 'Why Choose Me',
                        'subtitle' => 'I focus on clean code, security, performance, and clear communication.',
                    ],
                    'projects' => [
                        'title' => 'Projects',
                        'subtitle' => 'Personal + professional projects including client work, experiments, and open-source builds.',
                    ],
                    'featured_projects' => [
                        'title' => 'Featured Projects',
                        'subtitle' => 'A selection of recent work showcasing quality, performance, and clean architecture.',
                    ],
                    'process' => [
                        'title' => 'How I Work',
                        'subtitle' => 'A smooth workflow to deliver quality products—on time.',
                    ],
                    'tech_stack' => [
                        'title' => 'Tech Stack',
                        'subtitle' => 'Tools and technologies I use to build scalable and maintainable applications.',
                    ],
                    'testimonials' => [
                        'title' => 'Testimonials',
                        'subtitle' => 'What clients say about working with me.',
                    ],
                    'faq' => [
                        'title' => 'FAQ',
                        'subtitle' => 'Answers to common questions clients ask before starting.',
                    ],
                  
                ],

                // HERO
                'hero' => [
                    'kicker' => 'CUSTOM WEB SERVICE PORTALS',
                    'headline' => 'Laravel Developer — Build Fast, Secure Web Apps',
                    'description' => 'I build scalable Laravel web apps, APIs, admin panels, ERP solutions, news portals, ecommerce platforms, business websites, and custom management systems. I also work with WordPress customization and theme development.',
                    'buttons' => [
                        ['text' => 'Hire Me', 'url' => '/contact'],
                        ['text' => 'View Projects', 'url' => '/projects'],
                        ['text' => 'Get a Free Quote', 'url' => '/contact'],
                    ],
                    'activate_title' => 'Activate Portal',
                    'activate_subtitle' => 'Available for freelance • 24h response',
                    'tags' => [
                        '3+ Years', 'Laravel', 'CodeIgniter', 'PHP', 'MySQL', 'REST API', 'WordPress', 'SQA',
                    ],
                    'profile_image' => 'upload/images/default_profile.jpg',
                    'status' => [
                        'label' => 'Status',
                        'value' => 'Freelance',
                        'badge' => 'Open',
                    ],
                    'mini_stats' => [
                        ['value' => '20+', 'label' => 'Projects'],
                        ['value' => 'Fast', 'label' => 'Delivery'],
                        ['value' => 'Clean', 'label' => 'Code'],
                    ],
                ],

                // SERVICES (cards)
                'services' => [
                    [
                        'icon' => '🧩',
                        'title' => 'Laravel Web Applications',
                        'desc' => 'Custom Laravel web applications including ecommerce platforms, admin panels, dashboards, authentication, roles & permissions, and scalable backend systems.',
                    ],
                    [
                        'icon' => '🏢',
                        'title' => 'ERP & Management Systems',
                        'desc' => 'ERP solutions, inventory management, HR, accounting modules, and custom business management systems tailored to your workflow.',
                    ],
                    [
                        'icon' => '🔗',
                        'title' => 'REST API Development',
                        'desc' => 'Secure REST APIs for mobile apps, third-party integrations, authentication systems, and scalable backend services.',
                    ],
                    [
                        'icon' => '📰',
                        'title' => 'CMS & News Portals',
                        'desc' => 'News portals and CMS platforms with role-based editors, SEO-friendly URLs, media management, and publishing workflows.',
                    ],
                    [
                        'icon' => '🎨',
                        'title' => 'WordPress Customization',
                        'desc' => 'WordPress theme development & customization, performance optimization, plugin integration, and business website development.',
                    ],
                    [
                        'icon' => '✅',
                        'title' => 'Software Quality Assurance (SQA)',
                        'desc' => 'Manual testing, functional and regression testing, bug reporting, and quality checks to ensure stable, secure, and reliable applications.',
                    ],
                ],

                // CTA 1
                'cta_1' => [
                    'title' => 'Need a reliable developer for your project?',
                    'subtitle' => 'Let’s discuss your requirements and build something great.',
                    'button_text' => 'Let’s Talk',
                ],

                // FEATURED PROJECTS SETTINGS
                'featured_projects' => [
                    'button_text' => 'See all',
                    'limit' => 6,
                ],
                
                // WHY CHOOSE ME (cards)
                'why_choose_me' => [
                    [
                        'icon' => '🔒',
                        'title' => 'Secure & Reliable',
                        'desc' => 'Validation, authentication, permissions, and Laravel best practices applied in every project.',
                    ],
                    [
                        'icon' => '⚡',
                        'title' => 'Fast Performance',
                        'desc' => 'Optimized queries, caching strategies, and clean architecture for high performance.',
                    ],
                    [
                        'icon' => '🤝',
                        'title' => 'Clear Communication',
                        'desc' => 'Regular updates, clear documentation, and transparent communication throughout the project.',
                    ],
                ],

                // PROCESS (steps)
                'process' => [
                    ['step' => '1', 'title' => 'Requirements', 'desc' => 'Understand project goals, required features, and delivery timeline.'],
                    ['step' => '2', 'title' => 'Planning', 'desc' => 'Database design, system architecture, and UI/UX planning.'],
                    ['step' => '3', 'title' => 'Development', 'desc' => 'Laravel / WordPress development following best practices.'],
                    ['step' => '4', 'title' => 'Testing (SQA)', 'desc' => 'Manual testing, bug fixing, and regression testing.'],
                    ['step' => '5', 'title' => 'Deploy & Support', 'desc' => 'Deployment, monitoring, and post-launch support & maintenance.'],
                ],

                // TECH STACK (lists)
                'tech_stack' => [
                    'backend' => ['Laravel', 'PHP', 'CodeIgniter', 'MySQL', 'Redis', 'Queues', 'Sanctum'],
                    'frontend' => ['Blade', 'React', 'Tailwind CSS', 'Alpine.js', 'JavaScript', 'Bootstrap'],
                    'wordpress' => ['Theme Development', 'Customization', 'Elementor', 'SEO Basics', 'Speed Optimization'],
                    'tools' => ['Git', 'Postman', 'Linux', 'cPanel', 'VPS', 'Nginx (Basic)'],
                    'sqa' => ['Manual Testing', 'Functional Testing', 'Regression Testing', 'Test Cases', 'Bug Reporting'],
                ],

                // STATS
                'stats' => [
                    ['value' => 20, 'suffix' => '+', 'label' => 'Professional Projects Completed'],
                    ['value' => 3,  'suffix' => '+', 'label' => 'Professional Years Experience'],
                    ['value' => 24, 'suffix' => 'h', 'label' => 'Response Time'],
                    ['value' => 100,'suffix' => '%', 'label' => 'Quality Focus'],
                ],

                // CTA 2
                'cta_2' => [
                    'title' => 'Need a reliable developer for your project?',
                    'subtitle' => 'Let’s discuss your requirements and build something great.',
                    'button_text_1' => 'Let’s Talk',
                    'button_text_2' => 'View Projects',
                ],

                // TESTIMONIALS
                'testimonials' => [
                    ['text' => 'Excellent work, delivered on time and very professional communication.', 'name' => 'Client Name', 'role' => 'Business Owner'],
                    ['text' => 'Very skilled Laravel developer. Clean code and fast delivery.', 'name' => 'Client Name', 'role' => 'Project Manager'],
                    ['text' => 'Great experience—quick responses and solid backend skills.', 'name' => 'Client Name', 'role' => 'Startup Founder'],
                    ['text' => 'Reliable, communicative, and security-focused developer.', 'name' => 'Client Name', 'role' => 'CTO'],
                ],

                // FAQ
                'faq' => [
                    ['q' => 'How much does a project cost?', 'a' => 'It depends on features and complexity. Share your requirements and I will provide a clear quote.'],
                    ['q' => 'How long will it take?', 'a' => 'Small websites take a few days, larger systems take 2–6 weeks depending on scope.'],
                    ['q' => 'Do you provide support after delivery?', 'a' => 'Yes. I provide post-launch support and maintenance options.'],
                    ['q' => 'Do you work with WordPress too?', 'a' => 'Yes. Theme development, customization, speed optimization, and business websites.'],
                    ['q' => 'Can you build APIs for mobile apps?', 'a' => 'Yes. I build secure REST APIs with authentication, versioning, and documentation.'],
                    ['q' => 'Do you ensure security?', 'a' => 'Yes. Validation, authorization, rate limiting, and security best practices are applied.'],
                ],
            ]
        );
    }
}
