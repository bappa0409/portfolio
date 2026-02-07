@extends('layouts.website')
@section('title', 'Bappa Sutradhar | Projects')

@section('content')
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 cyber-grid opacity-40 pointer-events-none"></div>

        <section class="relative z-10 mx-auto max-w-6xl px-4 py-10">
            <!-- HEADER -->
            <div class="text-center">
                <p class="text-emerald-200/80 font-mono text-sm tracking-widest">&gt; PROJECT_PROTOCOL</p>

                <h1 class="mt-3 text-4xl md:text-5xl font-extrabold text-white cyber-text tracking-wider">
                    {{ data_get($meta, 'projects.title', 'PROJECT_NEXUS') }}
                </h1>

                <p class="mt-4 text-slate-300 max-w-2xl mx-auto text-sm">
                    {{ data_get(
                        $meta,
                        'projects.subtitle',
                        'Personal + professional projects including client work, experiments, and open-source builds.'
                    ) }}
                </p>
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
                    @foreach ($stats as $s)
                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-5 text-center">
                            <div class="text-xl font-extrabold text-white">{{ $s[0] }}</div>
                            <div class="mt-1 text-xs text-slate-400 font-mono">{{ $s[1] }}</div>
                        </div>
                    @endforeach
                </div>
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

            <!-- GITHUB REPOS -->
            @if($showGithub)
            <div class="mt-10">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <span class="text-emerald-200 font-mono">&gt;</span>
                        <h2 class="text-white font-bold tracking-wide">GITHUB_REPOSITORIES</h2>
                    </div>
                    @if(!empty($githubUsername))
                        <a href="https://github.com/{{ $githubUsername }}" target="_blank"
                        class="text-xs font-mono text-emerald-200 hover:text-emerald-100 transition">
                            View GitHub →
                        </a>
                    @else
                        <a href="https://github.com/" target="_blank"
                        class="text-xs font-mono text-emerald-200 hover:text-emerald-100 transition">
                            View GitHub →
                        </a>
                    @endif
                </div>
                
                <div class="mt-6 grid md:grid-cols-3 gap-5">
                    @forelse ($githubRepos as $r)
                        <a href="{{ $r['url'] }}" target="_blank"
                        class="rounded-md glass-soft cyber-glow p-5 border border-white/10 hover:border-emerald-400/25 transition block">

                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <p class="text-white font-semibold">{{ $r['name'] }}</p>
                                    <p class="mt-2 text-sm text-slate-300">{{ $r['desc'] ?: 'No description.' }}</p>
                                </div>
                                <div class="h-9 w-9 rounded-md bg-emerald-400/10 border border-emerald-400/15 grid place-items-center text-emerald-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M4 2h12a2 2 0 012 2v16a2 2 0 01-2 2H6a2 2 0 01-2-2V2zm2 2v16h10V4H6zm14 4h2v12a2 2 0 01-2 2h-1v-2h1V8z"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <div class="mt-3 flex flex-wrap gap-2 text-[11px] font-mono text-slate-300">
                                 @if(isset($r['commits']) && $r['commits'] > 0)
                                    <span class="rounded-full border border-white/10 bg-white/5 px-2.5 py-1 text-white/70">
                                        ⎇ {{ $r['commits'] }} commits
                                    </span>
                                @elseif(isset($r['commits']))
                                ⎇ —
                                @endif
                                

                                @if(!empty($r['languages']) && is_array($r['languages']))
                                    @php
                                        $langs = $r['languages'];
                                        arsort($langs); // sort by bytes desc
                                        $topLangs = array_slice(array_keys($langs), 0, 3);
                                    @endphp

                                    @foreach($topLangs as $lg)
                                        <span class="rounded-full border border-white/10 bg-white/5 px-2.5 py-1 text-white/70">
                                            {{ $lg }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>

                        </a>
                    @empty
                        <div class="text-sm text-white/60">
                            GitHub repos not loaded. Set <span class="font-mono">GITHUB_USERNAME</span> in <span class="font-mono">.env</span>.
                        </div>
                    @endforelse
                </div>
            </div>
            @endif

            <!-- LOCAL PROJECTS -->
            @if($showLocal)
            <div class="mt-12">
                <div class="flex items-center gap-2">
                    <span class="text-emerald-200 font-mono">&gt;</span>
                    <h2 class="text-white font-bold tracking-wide">PROJECTS</h2>
                </div>
                <p class="mt-2 text-sm text-slate-400">Professional & personal builds.</p>

                <div class="mt-6 grid md:grid-cols-3 gap-5">
                    @foreach ($visibleProjects as $p)
                        <a href="{{ !empty($p['slug']) ? route('projects.show', $p['slug']) : ($p['url'] ?? '#') }}"
                        class="group block rounded-md overflow-hidden glass-soft cyber-glow hover:border-emerald-400/25 transition">

                            <!-- IMAGE -->
                            <div class="relative h-60 px-6 pt-6 overflow-hidden">
                                @php
                                    $img = $p['image'] ?? null;
                                    $imgPath = $img ? (str_starts_with($img, 'images/') ? $img : ('upload/images/projects/'.$img)) : null;
                                @endphp

                                @if($imgPath)
                                    <img src="{{ asset($imgPath) }}" alt="{{ $p['title'] }}"
                                        class="h-full w-full object-cover" loading="lazy" decoding="async">
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/15 to-white/0"></div>
                                @endif

                                <div class="absolute inset-0 bg-black/30"></div>
                                <div class="absolute inset-0 scanline opacity-40 pointer-events-none"></div>
                            </div>

                            <!-- CONTENT -->
                            <div class="p-6">
                                <h3 class="font-semibold text-white">{{ $p['title'] }}</h3>
                                <p class="mt-2 text-white/70 text-sm">{{ $p['subtitle'] }}</p>

                                <div class="mt-4 flex flex-wrap gap-1">
                                    @foreach (($p['stack'] ?? []) as $tag)
                                        <span class="text-xs rounded-full bg-white/5 border border-white/10 px-2.5 py-1 text-white/85">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>

                                <p class="mt-4 text-xs text-white/55">
                                    Type: {{ ucfirst($p['type'] ?? 'project') }} • Status: {{ $p['status'] ?? 'Active' }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif


            <!-- CHALLENGES -->
            @if($showChallenges)
            <div class="mt-12">
                <div class="flex items-center gap-2">
                    <span class="text-emerald-200 font-mono">&gt;</span>
                    <h2 class="text-white font-bold tracking-wide">DEV_CHALLENGES</h2>
                </div>
                <p class="mt-2 text-sm text-slate-400">UI builds and layout practice (handpicked).</p>

                <div class="mt-6 grid sm:grid-cols-2 md:grid-cols-4 gap-5">
                    @foreach ($challenges as $c)
                        @php
                            $img = $p['image'] ?? null;
                            $imgPath = $img ? (str_starts_with($img, 'images/') ? $img : ('upload/images/projects/'.$img)) : null;
                        @endphp
                        
                        <a href="{{ $c['url'] ?? '#' }}" target="_blank"
                        class="group block rounded-md overflow-hidden glass-soft cyber-glow hover:border-emerald-400/25 transition">

                            <!-- IMAGE -->
                            <div class="relative h-48 md:h-52 px-6 pt-6 overflow-hidden">
                                @if (!empty($c['thumb']))
                                    <img src="{{ asset($c['thumb']) }}" alt="{{ $c['title'] }}"
                                        class="h-full w-full object-cover" loading="lazy" decoding="async">
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/15 to-white/0"></div>
                                @endif

                                <div class="absolute inset-0 bg-black/30"></div>
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

                                <p class="mt-4 text-xs text-white/55">Type: Challenge</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

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
                    <a href="{{ asset('cv/resume.pdf') }}" target="_blank"
                    class="rounded-md border border-cyan-400/30 bg-cyan-400/10 px-6 py-3 font-semibold text-cyan-200 hover:bg-cyan-400/20 transition">
                        ⭳ DOWNLOAD_CV
                    </a>
                </div>

                <p class="mt-5 text-xs text-slate-500 font-mono">⌁ System online • pushing commits...</p>
            </div>

        </section>
    </div>
@endsection
