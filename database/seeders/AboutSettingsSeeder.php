<?php

namespace Database\Seeders;

use App\Models\AboutSetting;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutSetting::updateOrCreate(
            ['id' => 1],
            [

                // HEADER
                'header' => [
                    'kicker' => '> ABOUT_PROTOCOL',
                    'title' => 'ABOUT_ME.EXE',
                    'subtitle' => 'Decoding the human behind the code...',
                ],

                // TERMINAL SECTION
                'terminal' => [
                    'whoami' => 'Bappa Sutradhar — Assistant Programmer / Laravel Developer',

                    'stack' => [
                        'Laravel', 'PHP', 'CodeIgniter', 'MySQL',
                        'Oracle', 'REST API', 'Git', 'Tailwind',
                    ],

                    'current_role' =>
                        'IT BANGLA LTD — School Management System & internal software • bug fixing • testing • production support',

                    'projects' => [
                        'Sales ERP System (HR, Sales, Purchase, Inventory, Accounts, RBAC)',
                        'Article 71 — News Portal with Admin Panel',
                        'Clean Solution Limited — Service Website with CMS-like Admin',
                    ],
                ],

                // TAGS (chips)
                'tags' => [
                    'Laravel', 'PHP', 'MySQL', 'Oracle',
                    'REST API', 'Git', 'SQA', 'Production Support',
                ],

                // PROFILE CARD
                'profile' => [
                    'name' => 'Bappa Sutradhar',
                    'title' => 'Assistant Programmer • Laravel Developer',
                    'status' => [
                        'available' => 'Available for new projects',
                        'response' => 'Usually responds within 24h',
                        'collab' => 'Open to collaboration',
                    ],
                ],

                // MY JOURNEY
                'journey' =>
                    "I’m a Laravel-focused developer working as an Assistant Programmer in Dhaka. I enjoy building real-world systems like ERP modules, management dashboards, news portals, and internal business applications. My strength is turning requirements into clean, maintainable features—database design, APIs, admin panels, bug fixing, testing releases, and supporting production users.",

                // EDUCATION
                'education' => [
                    [
                        'title' => 'BSc in CSE',
                        'year' => '2022 — 2026',
                        'note' => 'Southeast University (Running • Evening)',
                    ],
                    [
                        'title' => 'Diploma in Agriculture',
                        'year' => '2014 — 2018',
                        'note' => 'CGPA: 3.24 / 4.00',
                    ],
                    [
                        'title' => 'SSC',
                        'year' => '2009 — 2014',
                        'note' => 'GPA: 3.81 / 5.00',
                    ],
                ],

                // TRAINING
                'training' => [
                    [
                        'title' => 'Web Design',
                        'institute' => 'Bangladesh Korea Technical Training Center (SEIP)',
                        'duration' => '6 months',
                    ],
                    [
                        'title' => 'Web Development',
                        'institute' => 'Learning and Earning Development Project (LEDP)',
                        'duration' => '3 months',
                    ],
                ],

                // EXPERIENCE
                'experience' => [
                    [
                        'role' => 'Assistant Programmer',
                        'company' => 'IT BANGLA LTD',
                        'location' => 'Paltan, Dhaka',
                        'period' => 'Nov 2024 — Present',
                        'tasks' => [
                            'Develop & maintain School Management System',
                            'Oracle database reporting & troubleshooting',
                            'Bug fixing, testing & production support',
                        ],
                    ],
                    [
                        'role' => 'PHP Developer',
                        'company' => 'BDTASK LTD',
                        'location' => 'Khilkhet, Dhaka',
                        'period' => 'Dec 2022 — Dec 2023',
                        'tasks' => [
                            'Built ERP modules and APIs',
                            'Laravel & CodeIgniter development',
                            'Production support & scalability',
                        ],
                    ],
                    [
                        'role' => 'Intern (Developer)',
                        'company' => 'EXCEL IT AI',
                        'location' => 'Mogbazar, Dhaka',
                        'period' => 'Nov 2021 — Apr 2022',
                        'tasks' => [
                            'ASP.NET MVC & SQL Server',
                            'Entity Framework CRUD',
                            'Laravel API basics',
                        ],
                    ],
                ],

                // SKILLS (progress bars)
                'skills' => [
                    ['name' => 'Laravel / PHP', 'percent' => 90],
                    ['name' => 'MySQL / DB Design', 'percent' => 85],
                    ['name' => 'REST API', 'percent' => 80],
                    ['name' => 'Oracle (Reporting / Support)', 'percent' => 75],
                    ['name' => 'Frontend (Tailwind / JS)', 'percent' => 72],
                    ['name' => 'SQA / Testing', 'percent' => 70],
                ],

                // CODE PHILOSOPHY
                'philosophy' => [
                    'Clean code & maintainable structure',
                    'Security-first mindset',
                    'Performance-aware development',
                    'Clear communication & reliable delivery',
                ],

                // PASSION MODULES
                'passions' => [
                    [
                        'title' => 'Clean Architecture',
                        'desc' => 'Readable structure, scalable modules',
                    ],
                    [
                        'title' => 'Problem Solving',
                        'desc' => 'Debugging, fixes, stable releases',
                    ],
                    [
                        'title' => 'ERP Systems',
                        'desc' => 'Modules, reports, business workflows',
                    ],
                    [
                        'title' => 'APIs',
                        'desc' => 'REST APIs & integrations',
                    ],
                ],
            ]
        );
    }
}
