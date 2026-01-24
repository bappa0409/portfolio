@extends('layouts.app')

@section('title','Bappa Sutradhar | Home')

@section('content')

<!-- HERO SECTION -->
<section class="mx-auto max-w-6xl px-4 py-8">
    <div class="grid md:grid-cols-[7fr_3fr] items-center gap-10">

        <!-- LEFT CONTENT -->
        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-white">
                Laravel Developer — Build Fast, Secure Web Apps
            </h1>

            <p class="mt-4 text-lg text-slate-300">
                I build scalable Laravel web apps, APIs, admin panels, ERP solutions, news portals, ecommerce platforms, business websites, and custom management systems. I also work with WordPress customization and theme development.
            </p>

            <div class="mt-7 flex gap-3">
                <a href="{{ route('contact') }}"
                   class="rounded-lg bg-blue-500 hover:bg-blue-400 px-5 py-3 font-semibold text-slate-950">
                    Hire Me
                </a>

                <a href="{{ route('projects') }}"
                   class="rounded-lg border border-white/15 hover:border-white/30 px-5 py-3 font-semibold text-white">
                    View Projects
                </a>
            </div>

            <div class="mt-7 flex flex-wrap gap-3 text-sm">
                <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-slate-200">
                    3+ Years Experience
                </span>
                <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-slate-200">
                    Laravel • Codeigniter • PHP • MySQL
                </span>
                <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-slate-200">
                    REST APIs
                </span>
                <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-slate-200">
                    JaraScript
                </span>
            </div>
        </div>

        <!-- RIGHT CARD WITH IMAGE -->
        <div class="rounded-lg border border-white/10 bg-white/5 p-4 text-white">

            <!-- PROFILE IMAGE -->
            <div class="flex justify-center mb-3">
                <img
                    src="{{ asset('images/profile.jpg') }}"
                    alt="Laravel Developer"
                    class="max-h-[300px] rounded-lg object-cover shadow-lg"
                >
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-300 text-sm">Available for</p>
                    <p class="text-xl font-bold">Freelance</p>
                </div>

                <span class="text-xs rounded-full bg-emerald-500/15 border border-emerald-400/20 px-3 py-1 text-emerald-300">
                    Open
                </span>
            </div>

            <div class="mt-3 grid grid-cols-3 gap-2 text-center">
                <div class="rounded-lg border border-white/10 bg-slate-950/40 p-2">
                    <p class="text-sm font-semibold">20+</p>
                    <p class="text-xs text-slate-400">Projects</p>
                </div>

                <div class="rounded-lg border border-white/10 bg-slate-950/40 p-2">
                    <p class="text-sm font-semibold">Fast</p>
                    <p class="text-xs text-slate-400">Delivery</p>
                </div>

                <div class="rounded-lg border border-white/10 bg-slate-950/40 p-2">
                    <p class="text-sm font-semibold">Clean</p>
                    <p class="text-xs text-slate-400">Code</p>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('contact') }}"
                   class="block text-center rounded-lg bg-white text-slate-950 font-semibold px-4 py-2 hover:bg-slate-100">
                    Get a Free Quote
                </a>
            </div>
        </div>
    </div>
</section>


<!-- SERVICES -->
<section class="mx-auto max-w-6xl px-4 py-12">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">Services</h2>
        <p class="mt-2 text-slate-300 max-w-2xl">
            I provide complete web development and quality assurance services,
            focused on scalable architecture, clean code, and reliable delivery.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">

        <!-- Laravel Web Applications (Includes Ecommerce) -->
        <div class="rounded-md border border-white/10 bg-white/5 p-6 hover:border-blue-500/40 transition">
            <div class="text-3xl mb-3">🧩</div>
            <h3 class="font-semibold text-lg text-white">Laravel Web Applications</h3>
            <p class="mt-2 text-slate-300 text-sm">
                Custom Laravel web applications including ecommerce platforms,
                admin panels, dashboards, authentication, roles & permissions,
                and scalable backend systems.
            </p>
        </div>

        <!-- ERP & Management Systems -->
        <div class="rounded-md border border-white/10 bg-white/5 p-6 hover:border-blue-500/40 transition">
            <div class="text-3xl mb-3">🏢</div>
            <h3 class="font-semibold text-lg text-white">ERP & Management Systems</h3>
            <p class="mt-2 text-slate-300 text-sm">
                ERP solutions, inventory management, HR, accounting modules,
                and custom business management systems tailored to your workflow.
            </p>
        </div>

        <!-- REST API Development -->
        <div class="rounded-md border border-white/10 bg-white/5 p-6 hover:border-blue-500/40 transition">
            <div class="text-3xl mb-3">🔗</div>
            <h3 class="font-semibold text-lg text-white">REST API Development</h3>
            <p class="mt-2 text-slate-300 text-sm">
                Secure REST APIs for mobile apps, third-party integrations,
                authentication systems, and scalable backend services.
            </p>
        </div>

        <!-- CMS & News Portals -->
        <div class="rounded-md border border-white/10 bg-white/5 p-6 hover:border-blue-500/40 transition">
            <div class="text-3xl mb-3">📰</div>
            <h3 class="font-semibold text-lg text-white">CMS & News Portals</h3>
            <p class="mt-2 text-slate-300 text-sm">
                News portals and CMS platforms with role-based editors,
                SEO-friendly URLs, media management, and publishing workflows.
            </p>
        </div>

        <!-- WordPress Customization -->
        <div class="rounded-md border border-white/10 bg-white/5 p-6 hover:border-blue-500/40 transition">
            <div class="text-3xl mb-3">🎨</div>
            <h3 class="font-semibold text-lg text-white">WordPress Customization</h3>
            <p class="mt-2 text-slate-300 text-sm">
                WordPress theme development and customization, performance optimization,
                plugin integration, and business website development.
            </p>
        </div>

        <!-- Software Quality Assurance -->
        <div class="rounded-md border border-white/10 bg-white/5 p-6 hover:border-blue-500/40 transition">
            <div class="text-3xl mb-3">✅</div>
            <h3 class="font-semibold text-lg text-white">Software Quality Assurance (SQA)</h3>
            <p class="mt-2 text-slate-300 text-sm">
                Manual testing, functional and regression testing, bug reporting,
                and quality checks to ensure stable, secure, and reliable applications.
            </p>
        </div>

    </div>

    <!-- CTA -->
    <div class="mt-10 text-center">
        <a href="{{ route('contact') }}"
           class="inline-block rounded-lg bg-blue-500 hover:bg-blue-400 px-6 py-3 font-semibold text-slate-950">
            Discuss Your Project
        </a>
    </div>
</section>


<!-- PROJECTS -->
<section class="mx-auto max-w-6xl px-4 py-10">
    <div class="flex items-end justify-between gap-4">
        <h2 class="text-2xl font-bold text-white">Featured Projects</h2>
        <a href="{{ route('projects') }}"
           class="text-sm font-semibold text-blue-400 hover:text-blue-300">
            See all →
        </a>
    </div>

    <div class="mt-6 grid md:grid-cols-3 gap-5">
        @foreach ($projects as $p)
            <a href="{{ route('projects.show', $p['slug']) }}"
               class="block rounded-md border border-white/10 bg-white/5 overflow-hidden hover:border-white/20 transition">
                <div class="h-36 bg-gradient-to-br from-blue-500/20 to-slate-950"></div>

                <div class="p-5">
                    <h3 class="font-semibold text-white">{{ $p['title'] }}</h3>
                    <p class="mt-2 text-slate-300 text-sm">{{ $p['subtitle'] }}</p>

                    <div class="mt-4 flex flex-wrap gap-1">
                        @foreach ($p['stack'] as $tag)
                            <span class="text-xs rounded-full bg-slate-950/60 border border-white/10 px-2 py-1 text-slate-200">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>

                    <p class="mt-4 text-xs text-slate-400">
                        Status: {{ $p['status'] }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>
</section>

<!-- WHY CHOOSE ME -->
<section class="mx-auto max-w-6xl px-4 py-12">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">Why Choose Me</h2>
        <p class="mt-2 text-slate-300 max-w-2xl">
            I focus on clean code, security, performance, and clear communication.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <div class="rounded-md border border-white/10 bg-white/5 p-6">
            <div class="text-3xl mb-3">🔒</div>
            <h3 class="text-white font-semibold text-lg">Secure & Reliable</h3>
            <p class="mt-2 text-slate-300 text-sm">Validation, auth, permissions, and best practices.</p>
        </div>

        <div class="rounded-md border border-white/10 bg-white/5 p-6">
            <div class="text-3xl mb-3">⚡</div>
            <h3 class="text-white font-semibold text-lg">Fast Performance</h3>
            <p class="mt-2 text-slate-300 text-sm">Optimized queries, caching, and clean architecture.</p>
        </div>

        <div class="rounded-md border border-white/10 bg-white/5 p-6">
            <div class="text-3xl mb-3">🤝</div>
            <h3 class="text-white font-semibold text-lg">Clear Communication</h3>
            <p class="mt-2 text-slate-300 text-sm">Regular updates, clean documentation, on-time delivery.</p>
        </div>
    </div>
</section>


<!-- PROCESS -->
<section class="mx-auto max-w-6xl px-4 py-12">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">How I Work</h2>
        <p class="mt-2 text-slate-300 max-w-2xl">
            A smooth workflow to deliver quality products—on time.
        </p>
    </div>

    <div class="grid md:grid-cols-5 gap-4">
        @foreach ([
            ['1', 'Requirements', 'Understand goals, features, and timeline.'],
            ['2', 'Planning', 'Database + architecture + UI plan.'],
            ['3', 'Development', 'Laravel/WordPress development with best practices.'],
            ['4', 'Testing (SQA)', 'Manual testing, bug fix, regression checks.'],
            ['5', 'Deploy & Support', 'Deploy + post-launch support and maintenance.'],
        ] as $step)
            <div class="rounded-md border border-white/10 bg-white/5 p-5">
                <div class="w-10 h-10 rounded-xl bg-blue-500/15 border border-blue-400/20 flex items-center justify-center font-bold text-blue-300">
                    {{ $step[0] }}
                </div>
                <h3 class="mt-3 font-semibold text-white">{{ $step[1] }}</h3>
                <p class="mt-2 text-sm text-slate-300">{{ $step[2] }}</p>
            </div>
        @endforeach
    </div>
</section>


<!-- TECH STACK -->
<section class="mx-auto max-w-6xl px-4 py-12">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">Tech Stack</h2>
        <p class="mt-2 text-slate-300 max-w-2xl">
            Tools and technologies I use to build scalable and maintainable applications.
        </p>
    </div>

    <div class="grid md:grid-cols-4 gap-6">
        <div class="rounded-md border border-white/10 bg-white/5 p-6">
            <h3 class="text-white font-semibold">Backend</h3>
            <div class="mt-4 flex flex-wrap gap-2 text-sm">
                @foreach (['Laravel','PHP','CodeIgniter','MySQL','Redis','Queues','Sanctum'] as $t)
                    <span class="rounded-full border border-white/10 bg-slate-950/60 px-3 py-1 text-slate-200">{{ $t }}</span>
                @endforeach
            </div>
        </div>

        <div class="rounded-md border border-white/10 bg-white/5 p-6">
            <h3 class="text-white font-semibold">Frontend</h3>
            <div class="mt-4 flex flex-wrap gap-2 text-sm">
                @foreach (['Blade','React','Tailwind CSS','Alpine.js','JavaScript','Bootstrap'] as $t)
                    <span class="rounded-full border border-white/10 bg-slate-950/60 px-3 py-1 text-slate-200">{{ $t }}</span>
                @endforeach
            </div>
        </div>

        <div class="rounded-md border border-white/10 bg-white/5 p-6">
            <h3 class="text-white font-semibold">WordPress</h3>
            <div class="mt-4 flex flex-wrap gap-2 text-sm">
                @foreach (['Theme Development','Customization','Elementor','SEO Basics','Speed Optimization'] as $t)
                    <span class="rounded-full border border-white/10 bg-slate-950/60 px-3 py-1 text-slate-200">{{ $t }}</span>
                @endforeach
            </div>
        </div>

        <div class="rounded-md border border-white/10 bg-white/5 p-6">
            <h3 class="text-white font-semibold">Tools</h3>
            <div class="mt-4 flex flex-wrap gap-2 text-sm">
                @foreach (['Git','Postman','Linux','cPanel','VPS','Nginx (Basic)'] as $t)
                    <span class="rounded-full border border-white/10 bg-slate-950/60 px-3 py-1 text-slate-200">{{ $t }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>


<!-- STATS -->
<section class="mx-auto max-w-6xl px-4 py-5">
    <div class="grid md:grid-cols-4 gap-6">
        @foreach ([
            ['20+', 'Projects Completed'],
            ['3+', 'Years Experience'],
            ['24h', 'Response Time'],
            ['100%', 'Quality Focus'],
        ] as $s)
            <div class="rounded-md border border-white/10 bg-white/5 p-6 text-center">
                <div class="text-3xl font-extrabold text-white">{{ $s[0] }}</div>
                <div class="mt-2 text-sm text-slate-300">{{ $s[1] }}</div>
            </div>
        @endforeach
    </div>
</section>



<!-- CTA -->
<section class="mx-auto max-w-6xl px-4 py-10">
    <div class="rounded-md border border-white/10 bg-gradient-to-br from-blue-500/15 to-white/5 p-8
                flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div>
            <h3 class="text-xl font-bold text-white">Need a reliable developer for your project?</h3>
            <p class="text-slate-300 mt-2">
                Let’s discuss your requirements and build something great.
            </p>
        </div>

        <a href="{{ route('contact') }}"
           class="rounded-lg bg-blue-500 hover:bg-blue-400 px-5 py-3 font-semibold text-slate-950">
            Let’s Talk
        </a>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="mx-auto max-w-6xl px-4 py-12">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">Testimonials</h2>
        <p class="mt-2 text-slate-300 max-w-2xl">What clients say about working with me.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="rounded-md border border-white/10 bg-white/5 p-6">
            <p class="text-slate-200">“Excellent work, delivered on time and very professional communication.”</p>
            <p class="mt-3 text-sm text-slate-400">— Client Name, Business Owner</p>
        </div>

        <div class="rounded-md border border-white/10 bg-white/5 p-6">
            <p class="text-slate-200">“Very skilled Laravel developer. Clean code and fast delivery.”</p>
            <p class="mt-3 text-sm text-slate-400">— Client Name, Project Manager</p>
        </div>
    </div>
</section>


<!-- CLIENTS -->
<section class="mx-auto max-w-6xl px-4 py-12">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">Clients & Collaborations</h2>
        <p class="mt-2 text-slate-300 max-w-2xl">Worked with startups and local businesses. (Add logos when available)</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        @for ($i=1; $i<=5; $i++)
            <div class="rounded-md border border-white/10 bg-white/5 p-6 text-center text-slate-300">
                Logo {{ $i }}
            </div>
        @endfor
    </div>
</section>


<!-- FAQ -->
<section class="mx-auto max-w-6xl px-4 py-12">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">FAQ</h2>
        <p class="mt-2 text-slate-300 max-w-2xl">Answers to common questions clients ask before starting.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        @foreach ([
            ['How much does a project cost?', 'It depends on features and complexity. Share your requirements and I will provide a clear quote.'],
            ['How long will it take?', 'Small sites take a few days, larger systems take 2–6 weeks depending on scope.'],
            ['Do you provide support after delivery?', 'Yes. I provide post-launch support and maintenance options.'],
            ['Do you work with WordPress too?', 'Yes. Theme development, customization, speed optimization, and business websites.'],
        ] as $faq)
            <div class="rounded-md border border-white/10 bg-white/5 p-6">
                <h3 class="text-white font-semibold">{{ $faq[0] }}</h3>
                <p class="mt-2 text-slate-300 text-sm">{{ $faq[1] }}</p>
            </div>
        @endforeach
    </div>
</section>


@endsection
