@extends('layouts.website')

@section('title', 'Bappa Sutradhar | Home')
@section('content')
<!-- HERO -->
<section class="mx-auto max-w-6xl px-4 py-10">
    <div class="grid md:grid-cols-[7fr_3fr] gap-10 items-start">

        <!-- LEFT HERO CARD -->
        <div class="relative rounded-md p-7 glass cyber-glow scanline">

            <p class="text-emerald-200/90 text-sm tracking-widest cyber-text">
                CUSTOM WEB SERVICE PORTALS
            </p>

            <h1 class="mt-3 text-3xl md:text-5xl font-extrabold text-white leading-tight">
                Laravel Developer — Build Fast, Secure Web Apps
            </h1>

            <p class="mt-4 text-base text-white/70 max-w-3xl">
                I build scalable Laravel web apps, APIs, admin panels, ERP solutions, news portals,
                ecommerce platforms, business websites, and custom management systems.
                I also work with WordPress customization and theme development.
            </p>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('contact') }}"
                    class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-6 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/30 transition">
                    Hire Me
                </a>

                <a href="{{ route('projects') }}"
                    class="rounded-md border border-white/10 bg-white/5 px-6 py-3 font-semibold text-white hover:border-emerald-400/30 transition">
                    View Projects
                </a>

                <a href="{{ route('contact') }}"
                    class="rounded-md border border-white/10 bg-white/5 px-6 py-3 font-semibold text-white hover:border-emerald-400/30 transition">
                    Get a Free Quote
                </a>
            </div>

            <!-- ACTIVATE PORTAL -->
            <div class="mt-4 flex items-center gap-4">
                <div class="portal-pulse">
                    <span class="portal-pulse__ring"></span>
                    <span class="portal-pulse__outer"></span>
                    <span class="portal-pulse__inner"></span>
                    <span class="portal-pulse__icon">▶︎</span>
                </div>

                <div>
                    <p class="text-white font-semibold">Activate Portal</p>
                    <p class="text-xs text-white/55">Available for freelance • 24h response</p>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-2 text-sm">
                @foreach (['3+ Years', 'Laravel', 'CodeIgniter', 'PHP', 'MySQL', 'REST API', 'WordPress', 'SQA'] as $t)
                <span class="rounded-full border border-emerald-400/15 bg-emerald-400/5 px-3 py-1 text-emerald-100/90">
                    {{ $t }}
                </span>
                @endforeach
            </div>
        </div>

        <!-- RIGHT PROFILE CARD -->
        <div class="rounded-md p-5 glass-soft cyber-glow">
            <div class="flex justify-center">
                <div
                    class="relative w-full max-h-[380px] md:max-h-[260px] overflow-hidden rounded-md border border-emerald-400/15">

                    <img src="{{ asset('images/profile.jpg') }}" alt="Bappa Sutradhar"
                        class="w-full max-h-[380px] md:max-h-[260px] object-cover" />

                    <!-- DARK OVERLAY -->
                    <div class="absolute inset-0 bg-black/30"></div>

                    <!-- CYBER NOISE (VISIBLE) -->
                    <div class="absolute inset-0 cyber-noise pointer-events-none opacity-50"></div>

                    <!-- SCANLINE -->
                    <div class="absolute inset-0 scanline opacity-40 pointer-events-none"></div>

                    <!-- Glow corner accents -->
                    <div class="absolute top-2 left-2 h-5 w-5 border-t-2 border-l-2 border-emerald-400/60"></div>
                    <div class="absolute top-2 right-2 h-5 w-5 border-t-2 border-r-2 border-emerald-400/60"></div>
                    <div class="absolute bottom-2 left-2 h-5 w-5 border-b-2 border-l-2 border-emerald-400/60"></div>
                    <div class="absolute bottom-2 right-2 h-5 w-5 border-b-2 border-r-2 border-emerald-400/60">
                    </div>
                </div>
            </div>


            <div class="mt-4 flex items-center justify-between">
                <div>
                    <p class="text-xs text-white/55">Status</p>
                    <p class="text-lg font-bold text-white">Freelance</p>
                </div>
                <span
                    class="text-xs rounded-full bg-emerald-400/15 border border-emerald-400/25 px-3 py-1 text-emerald-200">
                    Open
                </span>
            </div>

            <div class="mt-4 grid grid-cols-3 gap-2 text-center">
                <div class="rounded-md border border-white/10 bg-white/5 px-3 py-1">
                    <p class="text-sm font-bold text-white">20+</p>
                    <p class="text-[11px] text-white/55">Projects</p>
                </div>
                <div class="rounded-md border border-white/10 bg-white/5 px-3 py-1">
                    <p class="text-sm font-bold text-white">Fast</p>
                    <p class="text-[11px] text-white/55">Delivery</p>
                </div>
                <div class="rounded-md border border-white/10 bg-white/5 px-3 py-1">
                    <p class="text-sm font-bold text-white">Clean</p>
                    <p class="text-[11px] text-white/55">Code</p>
                </div>
            </div>

            <a href="{{ route('contact') }}"
                class="mt-4 block text-center rounded-md bg-white text-slate-950 font-semibold px-4 py-2 hover:bg-white/90">
                Let’s Talk
            </a>
        </div>

    </div>
</section>


<!-- SERVICES -->
<section class="mx-auto max-w-6xl px-4 py-10">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">Services</h2>
        <p class="mt-2 text-white/70 max-w-2xl">
            I provide complete web development and quality assurance services,
            focused on scalable architecture, clean code, and reliable delivery.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach ([
        ['🧩', 'Laravel Web Applications', 'Custom Laravel web applications including ecommerce platforms, admin panels,
        dashboards, authentication, roles & permissions, and scalable backend systems.'],
        ['🏢', 'ERP & Management Systems', 'ERP solutions, inventory management, HR, accounting modules, and custom
        business management systems tailored to your workflow.'],
        ['🔗', 'REST API Development', 'Secure REST APIs for mobile apps, third-party integrations, authentication
        systems, and scalable backend services.'],
        ['📰', 'CMS & News Portals', 'News portals and CMS platforms with role-based editors, SEO-friendly URLs, media
        management, and publishing workflows.'],
        ['🎨', 'WordPress Customization', 'WordPress theme development & customization, performance optimization, plugin
        integration, and business website development.'],
        ['✅', 'Software Quality Assurance (SQA)', 'Manual testing, functional and regression testing, bug reporting, and
        quality checks to ensure stable, secure, and reliable applications.'],
        ] as $srv)
        <div class="rounded-md p-6 glass-soft cyber-glow hover:border-emerald-400/25 transition">
            <div class="text-3xl mb-3">{{ $srv[0] }}</div>
            <h3 class="font-semibold text-lg text-white">{{ $srv[1] }}</h3>
            <p class="mt-2 text-white/70 text-sm">{{ $srv[2] }}</p>
        </div>
        @endforeach
    </div>

    <div class="mt-10 text-center">
        <a href="{{ route('contact') }}"
            class="inline-block rounded-md bg-emerald-400/20 border border-emerald-400/30 px-6 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
            Discuss Your Project
        </a>
    </div>
</section>


<!-- FEATURED PROJECTS -->
<section class="mx-auto max-w-6xl px-4 pb-10">
    <div class="flex items-end justify-between gap-4">
        <h2 class="text-2xl font-bold text-white">Featured Projects</h2>
        <a href="{{ route('projects') }}" class="text-sm font-semibold text-emerald-200 hover:text-emerald-100">
            See all →
        </a>
    </div>

    <div class="mt-6 grid md:grid-cols-3 gap-5">
        @foreach ($projects as $p)
        <a href="{{ route('projects.show', $p['slug']) }}"
            class="group block rounded-md overflow-hidden glass-soft cyber-glow hover:border-emerald-400/25 transition">

            <!-- IMAGE -->
            <div class="relative h-60 px-6 pt-6 overflow-hidden project-media">
                <img src="{{ asset('images/projects/' . $p['image']) }}" alt="{{ $p['title'] }}"
                    class="h-full w-full object-cover" loading="lazy" decoding="async">

                <!-- Overlay -->
                <div class="absolute inset-0 bg-black/30"></div>

                <!-- Cyber accents -->
                <div class="absolute inset-0 scanline opacity-40 pointer-events-none"></div>
            </div>

            <!-- CONTENT -->
            <div class="p-6">
                <h3 class="font-semibold text-white">{{ $p['title'] }}</h3>
                <p class="mt-2 text-white/70 text-sm">{{ $p['subtitle'] }}</p>

                <div class="mt-4 flex flex-wrap gap-1">
                    @foreach ($p['stack'] as $tag)
                    <span class="text-xs rounded-full bg-white/5 border border-white/10 px-2.5 py-1 text-white/85">
                        {{ $tag }}
                    </span>
                    @endforeach
                </div>

                <p class="mt-4 text-xs text-white/55">
                    Status: {{ $p['status'] }}
                </p>
            </div>
        </a>
        @endforeach
    </div>
</section>


<!-- WHY CHOOSE ME -->
<section class="mx-auto max-w-6xl px-4 py-10">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">Why Choose Me</h2>
        <p class="mt-2 text-white/70 max-w-2xl">
            I focus on clean code, security, performance, and clear communication.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach ([['🔒', 'Secure & Reliable', 'Validation, auth, permissions, and best practices.'], ['⚡', 'Fast
        Performance', 'Optimized queries, caching, and clean architecture.'], ['🤝', 'Clear Communication', 'Regular
        updates, clean documentation, on-time delivery.']] as $w)
        <div class="rounded-md p-6 glass-soft cyber-glow">
            <div class="text-3xl mb-3">{{ $w[0] }}</div>
            <h3 class="text-white font-semibold text-lg">{{ $w[1] }}</h3>
            <p class="mt-2 text-white/70 text-sm">{{ $w[2] }}</p>
        </div>
        @endforeach
    </div>
</section>


<!-- PROCESS -->
<section class="mx-auto max-w-6xl px-4 py-10">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">How I Work</h2>
        <p class="mt-2 text-white/70 max-w-2xl">
            A smooth workflow to deliver quality products—on time.
        </p>
    </div>

    <div class="grid md:grid-cols-5 gap-4">
        @foreach ([['1', 'Requirements', 'Understand goals, features, and timeline.'], ['2', 'Planning', 'Database +
        architecture + UI plan.'], ['3', 'Development', 'Laravel/WordPress development with best practices.'], ['4',
        'Testing (SQA)', 'Manual testing, bug fix, regression checks.'], ['5', 'Deploy & Support', 'Deploy + post-launch
        support and maintenance.']] as $step)
        <div class="rounded-md p-5 glass-soft cyber-glow">
            <div
                class="w-10 h-10 rounded-md bg-emerald-400/15 border border-emerald-400/20 flex items-center justify-center font-bold text-emerald-200">
                {{ $step[0] }}
            </div>
            <h3 class="mt-3 font-semibold text-white">{{ $step[1] }}</h3>
            <p class="mt-2 text-sm text-white/70">{{ $step[2] }}</p>
        </div>
        @endforeach
    </div>
</section>


<!-- TECH STACK -->
<section class="mx-auto max-w-6xl px-4 py-10">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">Tech Stack</h2>
        <p class="mt-2 text-white/70 max-w-2xl">
            Tools and technologies I use to build scalable and maintainable applications.
        </p>
    </div>

    <div class="grid md:grid-cols-5 gap-6">
        <!-- Backend -->
        <div class="rounded-md p-6 glass-soft cyber-glow">
            <h3 class="text-white font-semibold">Backend</h3>
            <div class="mt-4 flex flex-wrap gap-2 text-xs">
                @foreach (['Laravel', 'PHP', 'CodeIgniter', 'MySQL', 'Redis', 'Queues', 'Sanctum'] as $t)
                <span class="rounded-full border border-white/10 bg-white/5 px-2 py-1 text-white/85">
                    {{ $t }}
                </span>
                @endforeach
            </div>
        </div>

        <!-- Frontend -->
        <div class="rounded-md p-6 glass-soft cyber-glow">
            <h3 class="text-white font-semibold">Frontend</h3>
            <div class="mt-4 flex flex-wrap gap-2 text-xs">
                @foreach (['Blade', 'React', 'Tailwind CSS', 'Alpine.js', 'JavaScript', 'Bootstrap'] as $t)
                <span class="rounded-full border border-white/10 bg-white/5 px-2 py-1 text-white/85">
                    {{ $t }}
                </span>
                @endforeach
            </div>
        </div>

        <!-- WordPress -->
        <div class="rounded-md p-6 glass-soft cyber-glow">
            <h3 class="text-white font-semibold">WordPress</h3>
            <div class="mt-4 flex flex-wrap gap-2 text-xs">
                @foreach (['Theme Development', 'Customization', 'Elementor', 'SEO Basics', 'Speed Optimization'] as $t)
                <span class="rounded-full border border-white/10 bg-white/5 px-2 py-1 text-white/85">
                    {{ $t }}
                </span>
                @endforeach
            </div>
        </div>

        <!-- Tools -->
        <div class="rounded-md p-6 glass-soft cyber-glow">
            <h3 class="text-white font-semibold">Tools</h3>
            <div class="mt-4 flex flex-wrap gap-2 text-xs">
                @foreach (['Git', 'Postman', 'Linux', 'cPanel', 'VPS', 'Nginx (Basic)'] as $t)
                <span class="rounded-full border border-white/10 bg-white/5 px-2 py-1 text-white/85">
                    {{ $t }}
                </span>
                @endforeach
            </div>
        </div>

        <!-- SQA -->
        <div class="rounded-md p-6 glass-soft cyber-glow">
            <h3 class="text-white font-semibold">SQA</h3>
            <div class="mt-4 flex flex-wrap gap-2 text-xs">
                @foreach (['Manual Testing', 'Functional Testing', 'Regression Testing', 'Test Cases', 'Bug Reporting']
                as $t)
                <span class="rounded-full border border-white/10 bg-white/5 px-2 py-1 text-white/85">
                    {{ $t }}
                </span>
                @endforeach
            </div>
        </div>
    </div>
</section>


<!-- STATS -->
<section class="mx-auto max-w-6xl px-4" x-data="{
        items: [
            { value: 20, suffix: '+', label: 'Professional Projects Completed' },
            { value: 3,  suffix: '+', label: 'Professional Years Experience' },
            { value: 24, suffix: 'h', label: 'Response Time' },
            { value: 100,suffix: '%', label: 'Quality Focus' },
        ],
        counts: [0, 0, 0, 0],
        done:   [false, false, false, false],
        started: false,

        animate(i) {
            const target = this.items[i].value;
            let current = 0;

            const steps = 80;
            const inc = Math.max(1, Math.ceil(target / steps));

            const t = setInterval(() => {
                current += inc;
                if (current >= target) {
                    current = target;
                    clearInterval(t);
                    this.done[i] = true; // trigger effect
                }
                this.counts[i] = current;
            }, 35); // slower tick
        },

        start() {
            if (this.started) return;
            this.started = true;

            this.items.forEach((_, i) => {
                setTimeout(() => this.animate(i), i * 180); // stagger
            });
        }
    }" x-init="
        const io = new IntersectionObserver(([e]) => {
            if (e.isIntersecting) {
                start();
                io.disconnect();
            }
        }, { threshold: 0.3 });
        io.observe($el);
    ">
    <div class="grid md:grid-cols-4 gap-6">
        <template x-for="(item, i) in items" :key="i">
            <div class="rounded-md p-6 text-center glass-soft cyber-glow transition"
                :class="done[i] ? 'stat-done' : ''">
                <div class="text-3xl font-extrabold text-white stat-number">
                    <span x-text="counts[i]"></span><span x-text="item.suffix"></span>
                </div>
                <div class="mt-2 text-sm text-white/70" x-text="item.label"></div>
            </div>
        </template>
    </div>

</section>





<!-- CTA -->
<section class="mx-auto max-w-6xl px-4 py-10">
    <div
        class="rounded-md glass cyber-glow p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div>
            <h3 class="text-xl font-bold text-white">Need a reliable developer for your project?</h3>
            <p class="text-white/70 mt-2">
                Let’s discuss your requirements and build something great.
            </p>
        </div>

        <a href="{{ route('contact') }}"
            class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-6 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
            Let’s Talk
        </a>
    </div>
</section>


<!-- TESTIMONIALS -->
<section class="mx-auto max-w-6xl px-4 py-10">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">Testimonials</h2>
        <p class="mt-2 text-white/70 max-w-2xl">What clients say about working with me.</p>
    </div>

    @php
    $testimonials = [
    [
    'text' => 'Excellent work, delivered on time and very professional communication.',
    'name' => 'Client Name',
    'role' => 'Business Owner',
    ],
    [
    'text' => 'Very skilled Laravel developer. Clean code and fast delivery.',
    'name' => 'Client Name',
    'role' => 'Project Manager',
    ],
    [
    'text' => 'Great experience—quick responses and solid backend skills.',
    'name' => 'Client Name',
    'role' => 'Startup Founder',
    ],
    [
    'text' => 'Reliable, communicative, and security-focused developer.',
    'name' => 'Client Name',
    'role' => 'CTO',
    ],
    ];

    // divide testimonials into groups of 2
    $groups = array_chunk($testimonials, 2);
    @endphp

    <div x-data="{
                active: 0,
                total: {{ count($groups) }},
                next() { this.active = (this.active + 1) % this.total },
                prev() { this.active = (this.active - 1 + this.total) % this.total }
            }" x-init="setInterval(() => next(), 6000)" class="relative">
        <!-- SLIDES -->
        <div class="overflow-hidden">
            <div class="flex transition-transform duration-500" :style="`transform: translateX(-${active * 100}%);`">

                @foreach ($groups as $group)
                <div class="min-w-full grid md:grid-cols-2 gap-6">
                    @foreach ($group as $t)
                    <div class="rounded-md p-6 glass-soft cyber-glow">
                        <p class="text-white/85">“{{ $t['text'] }}”</p>
                        <p class="mt-3 text-sm text-white/55">
                            — {{ $t['name'] }}, {{ $t['role'] }}
                        </p>
                    </div>
                    @endforeach
                </div>
                @endforeach

            </div>
        </div>

        <!-- CONTROLS -->
        <div class="mt-6 flex items-center justify-between">
            <button @click="prev()"
                class="rounded-md border border-white/10 bg-white/5 px-4 py-2 text-white hover:border-emerald-400/30 transition">
                ← Prev
            </button>

            <!-- DOTS -->
            <div class="flex gap-2">
                @for ($i = 0; $i < count($groups); $i++) <button @click="active={{ $i }}"
                    class="h-2.5 w-2.5 rounded-full border border-emerald-400/30"
                    :class="active === {{ $i }} ? 'bg-emerald-400/70' : 'bg-white/10'">
                    </button>
                    @endfor
            </div>

            <button @click="next()"
                class="rounded-md border border-white/10 bg-white/5 px-4 py-2 text-white hover:border-emerald-400/30 transition">
                Next →
            </button>
        </div>
    </div>
</section>


<!-- FAQ -->
<section class="mx-auto max-w-6xl px-4 py-10">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">FAQ</h2>
        <p class="mt-2 text-white/70 max-w-2xl">
            Answers to common questions clients ask before starting.
        </p>
    </div>

    @php
    $faqs = [
    [
    'q' => 'How much does a project cost?',
    'a' =>
    'It depends on features and complexity. Share your requirements and I will provide a clear quote.',
    ],
    [
    'q' => 'How long will it take?',
    'a' => 'Small sites take a few days, larger systems take 2–6 weeks depending on scope.',
    ],
    [
    'q' => 'Do you provide support after delivery?',
    'a' => 'Yes. I provide post-launch support and maintenance options.',
    ],
    [
    'q' => 'Do you work with WordPress too?',
    'a' => 'Yes. Theme development, customization, speed optimization, and business websites.',
    ],
    [
    'q' => 'Can you build APIs for mobile apps?',
    'a' => 'Yes. I build secure REST APIs with authentication and documentation.',
    ],
    [
    'q' => 'Do you ensure security?',
    'a' => 'Yes. Validation, authorization, and best practices are applied in every project.',
    ],
    [
    'q' => 'Can you build APIs for mobile apps?',
    'a' => 'Yes. I build secure REST APIs with authentication, versioning, and documentation.',
    ],
    [
    'q' => 'Do you ensure security?',
    'a' =>
    'Yes. Validation, authorization, rate limiting, and best practices are applied in every project.',
    ],
    ];

    // FAQ ভাগ করা
    $leftFaqs = array_filter($faqs, fn($v, $k) => $k % 2 === 0, ARRAY_FILTER_USE_BOTH);
    $rightFaqs = array_filter($faqs, fn($v, $k) => $k % 2 === 1, ARRAY_FILTER_USE_BOTH);
    @endphp

    <div class="grid md:grid-cols-2 gap-6 items-start">

        <!-- LEFT COLUMN -->
        <div class="space-y-6">
            @foreach ($leftFaqs as $faq)
            <div x-data="{ open: false }" class="rounded-md p-6 glass-soft cyber-glow h-fit">

                <button @click="open = !open" class="w-full flex items-start justify-between gap-4 text-left">
                    <h3 class="text-white font-semibold">{{ $faq['q'] }}</h3>
                    <span class="text-white/60 text-xl" x-text="open ? '−' : '+'"></span>
                </button>

                <div x-show="open" x-transition class="mt-3 text-sm text-white/70 leading-relaxed">
                    {{ $faq['a'] }}
                </div>
            </div>
            @endforeach
        </div>

        <!-- RIGHT COLUMN -->
        <div class="space-y-6">
            @foreach ($rightFaqs as $faq)
            <div x-data="{ open: false }" class="rounded-md p-6 glass-soft cyber-glow h-fit">

                <button @click="open = !open" class="w-full flex items-start justify-between gap-4 text-left">
                    <h3 class="text-white font-semibold">{{ $faq['q'] }}</h3>
                    <span class="text-white/60 text-xl" x-text="open ? '−' : '+'"></span>
                </button>

                <div x-show="open" x-transition class="mt-3 text-sm text-white/70 leading-relaxed">
                    {{ $faq['a'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection