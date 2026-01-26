{{-- resources/views/projects.blade.php --}}
@extends('layouts.app')

@section('title', 'Bappa Sutradhar | Projects')

@section('content')
<div class="relative overflow-hidden page-fade">
    <div class="absolute inset-0 cyber-grid opacity-40 pointer-events-none"></div>

    <section class="relative z-10 mx-auto max-w-6xl px-4 py-10">

        @php
            // Fallback demo data (if controller doesn't pass $projects / $repos / $challenges)
            $stats = $stats ?? [
                ['50+', 'Projects'],
                ['25+', 'Clients'],
                ['5+', 'Years'],
                ['1200+', 'Commits'],
            ];

            $filters = $filters ?? [
                ['id' => 'all', 'label' => 'Dev Challenges'],
                ['id' => 'featured', 'label' => 'Featured Pro'],
                ['id' => 'codewars', 'label' => 'Codewars'],
                ['id' => 'hackerrank', 'label' => 'HackerRank'],
            ];

            $activeFilter = request('filter', 'all');

            $repos = $repos ?? [
                ['name' => 'ERP-Tracker', 'desc' => 'ERP modules & admin dashboard utilities.', 'lang' => 'PHP', 'stars' => 12, 'forks' => 3, 'url' => 'https://github.com/'],
                ['name' => 'terminus', 'desc' => 'Laravel utilities, helpers, and reusable components.', 'lang' => 'PHP', 'stars' => 9, 'forks' => 2, 'url' => 'https://github.com/'],
                ['name' => 'primeflix-movie-downloader', 'desc' => 'CLI script for media fetching workflow.', 'lang' => 'Python', 'stars' => 7, 'forks' => 1, 'url' => 'https://github.com/'],
                ['name' => 'Geo-Phone-Tracker', 'desc' => 'Phone + location tracking POC (educational).', 'lang' => 'Python', 'stars' => 5, 'forks' => 1, 'url' => 'https://github.com/'],
                ['name' => 'CHEGEBB', 'desc' => 'Portfolio UI experiments and components.', 'lang' => 'HTML', 'stars' => 3, 'forks' => 0, 'url' => 'https://github.com/'],
            ];

            $projects = $projects ?? [
                [
                    'title' => 'Health Master',
                    'subtitle' => 'Healthcare landing + admin concept, responsive UI.',
                    'status' => 'Completed',
                    'image' => 'images/projects/healthmaster.jpg',
                    'stack' => ['Laravel','Tailwind','MySQL'],
                    'url' => '#',
                    'featured' => true,
                ],
                [
                    'title' => 'Welcome to WeRent',
                    'subtitle' => 'Real estate / rental platform UI + modules.',
                    'status' => 'In Progress',
                    'image' => 'images/projects/werent.jpg',
                    'stack' => ['Laravel','REST API','MySQL'],
                    'url' => '#',
                    'featured' => true,
                ],
                [
                    'title' => 'Farming Solutions',
                    'subtitle' => 'Business website with admin + content sections.',
                    'status' => 'Completed',
                    'image' => 'images/projects/farming.jpg',
                    'stack' => ['PHP','Bootstrap','MySQL'],
                    'url' => '#',
                    'featured' => false,
                ],
                [
                    'title' => 'Rehab Outcome Therapies',
                    'subtitle' => 'Service website UI + lead capture forms.',
                    'status' => 'Completed',
                    'image' => 'images/projects/rehab.jpg',
                    'stack' => ['Laravel','Tailwind'],
                    'url' => '#',
                    'featured' => false,
                ],
                [
                    'title' => 'ERP System Modules',
                    'subtitle' => 'Inventory, HR, Accounts modules with RBAC.',
                    'status' => 'Ongoing',
                    'image' => 'images/projects/erp.jpg',
                    'stack' => ['Laravel','MySQL','RBAC'],
                    'url' => '#',
                    'featured' => false,
                ],
            ];

            $challenges = $challenges ?? [
                ['title' => 'Card Generator', 'desc' => 'Component-based UI practice', 'tags' => ['UI','Tailwind'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-1.avif'],
                ['title' => 'Landing Page', 'desc' => 'Hero + pricing layout', 'tags' => ['HTML','CSS'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-2.avif'],
                ['title' => 'Dashboard UI', 'desc' => 'Grid layout & stats cards', 'tags' => ['UI','Grid'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-3.avif'],
                ['title' => 'Form UI', 'desc' => 'Validation + spacing', 'tags' => ['Forms'], 'url' => '#', 'thumb' => 'images/projects/frontend/frontend-4.avif'],
            ];

            // Optional: filter featured
            $visibleProjects = $activeFilter === 'featured'
                ? array_values(array_filter($projects, fn($p) => !empty($p['featured'])))
                : $projects;
        @endphp

        <!-- HEADER -->
        <div class="text-center">
            <p class="text-emerald-200/80 font-mono text-sm tracking-widest">&gt; PROJECT_PROTOCOL</p>
            <h1 class="mt-3 text-4xl md:text-5xl font-extrabold text-white cyber-text tracking-wider">
                PROJECT_NEXUS
            </h1>
            <p class="mt-4 text-slate-300 max-w-2xl mx-auto text-sm">
                Exploring digital frontiers — from Laravel applications and ERP modules to UI experiments and integrations.
            </p>
        </div>

        <!-- STATS -->
        <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ($stats as $s)
                <div class="rounded-md glass cyber-glow p-5 relative text-center">
                    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>
                    <div class="text-2xl font-extrabold text-white">{{ $s[0] }}</div>
                    <div class="mt-1 text-xs text-slate-400 font-mono">{{ $s[1] }}</div>
                </div>
            @endforeach
        </div>

        <!-- FILTER TABS -->
        <div class="mt-8 rounded-md glass cyber-glow p-4 relative">
            <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

            <div class="flex flex-wrap gap-2 items-center justify-between">
                <div class="flex flex-wrap gap-2">
                    @foreach ($filters as $f)
                        @php $isActive = $activeFilter === $f['id']; @endphp
                        <a href="{{ url()->current() }}?filter={{ $f['id'] }}"
                           class="px-3 py-2 rounded-md border text-xs font-mono transition
                                  {{ $isActive
                                        ? 'bg-emerald-400/15 border-emerald-400/30 text-emerald-200'
                                        : 'bg-slate-950/30 border-white/10 text-white/70 hover:border-emerald-400/25 hover:text-emerald-200' }}">
                            <span class="text-emerald-200/90">&gt;</span> {{ $f['label'] }}
                        </a>
                    @endforeach
                </div>

                <div class="hidden sm:flex items-center gap-2 text-xs text-slate-400 font-mono">
                    <span class="text-emerald-200/80">⌁</span> Filter: {{ strtoupper($activeFilter) }}
                </div>
            </div>
        </div>

        <!-- FEATURED REPOSITORIES -->
        <div class="mt-10">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <span class="text-emerald-200 font-mono">&gt;</span>
                    <h2 class="text-white font-bold tracking-wide">FEATURED_REPOSITORIES</h2>
                </div>
                <a href="https://github.com/" target="_blank"
                   class="text-xs font-mono text-emerald-200 hover:text-emerald-100 transition">
                    View GitHub →
                </a>
            </div>

            <div class="mt-6 grid md:grid-cols-3 gap-5">
                @foreach ($repos as $r)
                    <a href="{{ $r['url'] }}" target="_blank"
                       class="rounded-md glass-soft cyber-glow p-5 border border-white/10 hover:border-emerald-400/25 transition block">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <p class="text-white font-semibold">{{ $r['name'] }}</p>
                                <p class="mt-2 text-sm text-slate-300">{{ $r['desc'] }}</p>
                            </div>
                            <div class="h-9 w-9 rounded-md bg-emerald-400/10 border border-emerald-400/15 grid place-items-center text-emerald-200">
                                <!-- tiny repo icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M4 2h12a2 2 0 012 2v16a2 2 0 01-2 2H6a2 2 0 01-2-2V2zm2 2v16h10V4H6zm14 4h2v12a2 2 0 01-2 2h-1v-2h1V8z"/>
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between text-xs text-slate-400 font-mono">
                            <span class="rounded-full border border-white/10 bg-white/5 px-2.5 py-1 text-white/70">{{ $r['lang'] }}</span>
                            <div class="flex items-center gap-3">
                                <span>★ {{ $r['stars'] }}</span>
                                <span>⑂ {{ $r['forks'] }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- FEATURED PROJECTS -->
        <div class="mt-12">
            <div class="flex items-center gap-2">
                <span class="text-emerald-200 font-mono">&gt;</span>
                <h2 class="text-white font-bold tracking-wide">FEATURED_PROJECTS</h2>
            </div>
            <p class="mt-2 text-sm text-slate-400">
                Handpicked showcases — real builds and portfolio work.
            </p>

            {{-- <div class="mt-6 grid md:grid-cols-3 gap-6">
                @foreach ($visibleProjects as $p)
                    <a href="{{ $p['url'] ?? '#' }}"
                       class="rounded-md overflow-hidden glass-soft cyber-glow border border-white/10 hover:border-emerald-400/25 transition block">
                        <div class="h-36 bg-slate-950/30 relative">
                            @if (!empty($p['image']))
                                <img src="{{ asset($p['image']) }}" alt="{{ $p['title'] }}"
                                     class="h-full w-full object-cover opacity-90">
                                <div class="absolute inset-0 bg-gradient-to-b from-black/0 via-black/10 to-black/60"></div>
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/15 to-white/0"></div>
                            @endif

                            <div class="absolute top-3 left-3 flex gap-2">
                                <span class="text-[10px] font-mono px-2 py-1 rounded-full border border-emerald-400/25 bg-emerald-400/10 text-emerald-200">
                                    PROJECT
                                </span>
                                <span class="text-[10px] font-mono px-2 py-1 rounded-full border border-white/10 bg-white/5 text-white/70">
                                    {{ $p['status'] ?? 'Active' }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-white font-semibold">{{ $p['title'] }}</h3>
                            <p class="mt-2 text-sm text-slate-300">{{ $p['subtitle'] }}</p>

                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach (($p['stack'] ?? []) as $tag)
                                    <span class="text-[11px] font-mono rounded-full bg-white/5 border border-white/10 px-2.5 py-1 text-white/80">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>

                            <div class="mt-4 flex items-center justify-between text-xs text-slate-400 font-mono">
                                <span class="text-emerald-200/80">↳ view</span>
                                <span class="text-white/50">ID: {{ substr(md5($p['title']), 0, 6) }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div> --}}
              <div class="mt-6 grid md:grid-cols-3 gap-5">
                @foreach ($projects as $p)
                    <a href="{{ route('projects.show', $p['slug']) }}"
                        class="group block rounded-md overflow-hidden glass-soft cyber-glow hover:border-emerald-400/25 transition">

                        <!-- IMAGE -->
                        <div class="relative h-60 px-6 pt-6 overflow-hidden">
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
                                    <span
                                        class="text-xs rounded-full bg-white/5 border border-white/10 px-2.5 py-1 text-white/85">
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
        </div>

        <!-- PROJECT ANALYTICS -->
        <div class="mt-12 rounded-md glass cyber-glow p-6 relative">
            <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

            <div class="flex items-center gap-2">
                <span class="text-emerald-200">⛭</span>
                <h2 class="text-white font-bold tracking-wide">PROJECT_ANALYTICS</h2>
            </div>
            <p class="mt-2 text-sm text-slate-400">High-level performance metrics (portfolio).</p>

            <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ([
                    ['31+', 'Total Projects'],
                    ['46k+', 'Active Users'],
                    ['748+', 'Commits'],
                    ['61%', 'Success Rate'],
                ] as $m)
                    <div class="rounded-md border border-white/10 bg-slate-950/30 p-5 text-center">
                        <div class="text-xl font-extrabold text-white">{{ $m[0] }}</div>
                        <div class="mt-1 text-xs text-slate-400 font-mono">{{ $m[1] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- FRONTEND MENTOR CHALLENGES -->
        <div class="mt-12">
            <div class="flex items-center gap-2">
                <span class="text-emerald-200 font-mono">&gt;</span>
                <h2 class="text-white font-bold tracking-wide">FRONTEND_MENTOR_CHALLENGES</h2>
            </div>
            <p class="mt-2 text-sm text-slate-400">UI builds and layout practice (handpicked).</p>

            <div class="mt-6 grid sm:grid-cols-2 md:grid-cols-4 gap-5">
                  {{-- @foreach ($challenges as $c)
                  <a href="{{ $c['url'] ?? '#' }}"
                       class="rounded-md overflow-hidden glass-soft cyber-glow border border-white/10 hover:border-emerald-400/25 transition block">
                        <div class="h-28 bg-slate-950/30 relative">
                            @if (!empty($c['thumb']))
                                <img src="{{ asset($c['thumb']) }}" alt="{{ $c['title'] }}" class="h-full w-full object-cover opacity-90">
                                <div class="absolute inset-0 bg-gradient-to-b from-black/0 to-black/60"></div>
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/15 to-white/0"></div>
                            @endif
                        </div>

                        <div class="p-5">
                            <p class="text-white font-semibold text-sm">{{ $c['title'] }}</p>
                            <p class="mt-1 text-xs text-slate-300">{{ $c['desc'] }}</p>

                            <div class="mt-3 flex flex-wrap gap-1.5">
                                @foreach (($c['tags'] ?? []) as $t)
                                    <span class="text-[10px] font-mono rounded-full bg-white/5 border border-white/10 px-2 py-1 text-white/75">
                                        {{ $t }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </a> 
                @endforeach--}}
                    @foreach ($challenges as $c)
                        <a href="{{ route('projects.show', $p['slug']) }}"
                            class="group block rounded-md overflow-hidden glass-soft cyber-glow hover:border-emerald-400/25 transition">

                            <!-- IMAGE -->
                            <div class="relative h-48 md:h-52 px-6 pt-6 overflow-hidden">
                                <img src="{{ asset($c['thumb']) }}" alt="{{ $c['title'] }}"
                                    class="h-full w-full object-cover" loading="lazy" decoding="async">

                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-black/30"></div>

                                <!-- Cyber accents -->
                                <div class="absolute inset-0 scanline opacity-40 pointer-events-none"></div>
                            </div>

                            <!-- CONTENT -->
                            <div class="p-6">
                                <h3 class="font-semibold text-white">{{ $c['title'] }}</h3>
                                <p class="mt-2 text-white/70 text-sm">{{ $c['desc'] }}</p>

                                <div class="mt-4 flex flex-wrap gap-1">
                                    @foreach (($c['tags'] ?? []) as $t)
                                        <span class="text-[10px] font-mono rounded-full bg-white/5 border border-white/10 px-2 py-1 text-white/75">
                                            {{ $t }}
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
        </div>

        <!-- FINAL CTA -->
        <div class="mt-12 rounded-md glass cyber-glow p-8 text-center relative">
            <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

            <h3 class="text-2xl font-extrabold text-white cyber-text">READY_TO_BUILD_SOMETHING_AMAZING?</h3>
            <p class="mt-3 text-slate-300 max-w-2xl mx-auto">
                Want a Laravel web app, ERP module, admin panel, business website, or custom system?
                Let’s talk and make it real.
            </p>

            <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('contact') }}"
                   class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-6 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
                    START_PROJECT
                </a>
                <a href="{{ asset('cv/Bappa_Sutradhar_CV.pdf') }}" target="_blank"
                   class="rounded-md border border-cyan-400/30 bg-cyan-400/10 px-6 py-3 font-semibold text-cyan-200 hover:bg-cyan-400/20 transition">
                    ⭳ DOWNLOAD_CV
                </a>
            </div>

            <p class="mt-5 text-xs text-slate-500 font-mono">⌁ System online • pushing commits...</p>
        </div>

    </section>
</div>
@endsection
