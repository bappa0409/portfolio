@extends('layouts.website')
@section('title', (data_get($settings?->profile,'name','Bappa Sutradhar').' | About'))

@section('content')
@php
    $header    = $settings?->header ?? [];
    $terminal  = $settings?->terminal ?? [];
    $tags      = $settings?->tags ?? [];
    $profile   = $settings?->profile ?? [];

    $img       = data_get($profile,'profile_image');
    $imgUrl    = $img ? asset('storage/'.$img) : asset('images/avatar-placeholder.png');
@endphp

<div class="relative overflow-hidden">
    <div class="absolute inset-0 cyber-grid opacity-40 pointer-events-none"></div>

    <section class="relative z-10 mx-auto max-w-6xl px-4 py-10">

        <!-- HEADER -->
        <div class="text-center">
            <p class="text-emerald-200/80 font-mono text-sm tracking-widest">
                {{ data_get($header,'kicker','> ABOUT_PROTOCOL') }}
            </p>

            <h1 class="mt-3 text-4xl md:text-5xl font-extrabold text-white cyber-text tracking-wider">
                {{ data_get($header,'title','ABOUT_ME.EXE') }}
            </h1>

            <p class="mt-3 text-slate-300 text-sm font-mono">
                {{ data_get($header,'subtitle','Decoding the human behind the code...') }}
            </p>
        </div>

        <!-- TOP GRID: TERMINAL + PROFILE -->
        <div class="mt-10 grid md:grid-cols-12 gap-6 items-start">

            <!-- TERMINAL CARD -->
            <div class="md:col-span-7 rounded-md glass cyber-glow p-6 relative">
                <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="text-emerald-200 font-mono">&gt;</span>
                        <h2 class="text-white font-bold tracking-wide">PROFILE_TERMINAL</h2>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-red-400/80"></span>
                        <span class="h-2 w-2 rounded-full bg-yellow-300/80"></span>
                        <span class="h-2 w-2 rounded-full bg-emerald-400/80"></span>
                    </div>
                </div>

                <div class="mt-5 rounded-md border border-white/10 bg-slate-950/30 p-5 font-mono text-sm text-slate-200 leading-relaxed">
                    <p>
                        <span class="text-emerald-200">user</span>@<span class="text-emerald-200">bappa</span>:~$
                        <span class="text-slate-400">whoami</span>
                    </p>
                    <p class="mt-2">
                        {{ data_get($terminal,'whoami','') }}
                    </p>

                    <p class="mt-4">
                        <span class="text-emerald-200">user</span>@<span class="text-emerald-200">bappa</span>:~$
                        <span class="text-slate-400">stack</span>
                    </p>
                    <p class="mt-2 text-slate-300">
                        {{ collect(data_get($terminal,'stack',[]))->implode(' • ') }}
                    </p>

                    <p class="mt-4">
                        <span class="text-emerald-200">user</span>@<span class="text-emerald-200">bappa</span>:~$
                        <span class="text-slate-400">current_role</span>
                    </p>
                    <p class="mt-2 text-slate-300">
                        {{ data_get($terminal,'current_role','') }}
                    </p>

                    <p class="mt-4">
                        <span class="text-emerald-200">user</span>@<span class="text-emerald-200">bappa</span>:~$
                        <span class="text-slate-400">projects --top</span>
                    </p>
                    <ul class="mt-2 text-slate-300 list-disc ml-5 space-y-1">
                        @foreach (data_get($terminal,'projects',[]) as $p)
                            <li>{{ $p }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-5 flex flex-wrap gap-2 text-sm">
                    @foreach ($tags as $t)
                        <span class="rounded-full border border-emerald-400/15 bg-emerald-400/5 px-3 py-1 text-emerald-100/90">
                            {{ $t }}
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- PROFILE CARD -->
            <div class="md:col-span-5 rounded-md glass cyber-glow p-6 relative">
                <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                <div class="flex items-center gap-2">
                    <span class="text-emerald-200">◉</span>
                    <h2 class="text-white font-bold tracking-wide">IDENTITY_NODE</h2>
                </div>

                <div class="mt-5 flex items-center gap-4">
                    <div class="h-16 w-16 rounded-full border border-emerald-400/20 bg-emerald-400/10 overflow-hidden">
                        <img src="{{ $imgUrl }}" alt="{{ data_get($profile,'name','Profile') }}" class="h-full w-full object-cover">
                    </div>
                    <div>
                        <p class="text-white font-semibold text-lg">{{ data_get($profile,'name','') }}</p>
                        <p class="text-slate-300 text-sm">{{ data_get($profile,'title','') }}</p>
                        <p class="text-xs text-slate-400 font-mono mt-1">{{ data_get($profile,'location','') }}</p>
                    </div>
                </div>

                <div class="mt-5 grid grid-cols-2 gap-3">
                    <div class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                        <p class="text-xs text-slate-400 font-mono">Email</p>
                        <p class="text-sm text-slate-200 break-all">{{ data_get($profile,'email','') }}</p>
                    </div>
                    <div class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                        <p class="text-xs text-slate-400 font-mono">Mobile</p>
                        <p class="text-sm text-slate-200 break-all">{{ data_get($profile,'mobile','') }}</p>
                    </div>
                </div>

                <div class="mt-5 text-center rounded-md border border-white/10 bg-slate-950/30 p-4">
                    <p class="text-xs text-slate-400 font-mono">GitHub</p>
                    @php $gh = data_get($profile,'github'); @endphp
                    @if($gh)
                        <a href="{{ $gh }}" target="_blank" class="text-sm text-emerald-200 hover:text-emerald-100 break-all">
                            {{ \Illuminate\Support\Str::of($gh)->replace(['https://','http://'], '') }}
                        </a>
                    @else
                        <p class="text-sm text-slate-200">—</p>
                    @endif
                </div>

                <div class="mt-5 rounded-md border border-white/10 bg-slate-950/30 p-5">
                    <p class="text-white font-semibold">STATUS</p>
                    <div class="mt-3 text-sm text-slate-300 space-y-2">
                        @if(data_get($profile,'status.available'))
                            <p class="font-mono text-emerald-200">✔ {{ data_get($profile,'status.available') }}</p>
                        @endif

                        @if(data_get($profile,'status.response'))
                            <p class="text-xs text-slate-400">{{ data_get($profile,'status.response') }}</p>
                        @endif

                        @if(data_get($profile,'status.collab'))
                            <p class="text-xs text-slate-400">{{ data_get($profile,'status.collab') }}</p>
                        @endif
                    </div>
                </div>

                <div class="mt-5 flex gap-3">
                    <a href="{{ route('projects') }}"
                       class="flex-1 text-center rounded-md border border-white/10 bg-slate-950/30 px-4 py-3 font-semibold text-white hover:border-emerald-400/25 transition">
                        VIEW_PROJECTS
                    </a>
                    <a href="{{ route('contact') }}"
                       class="flex-1 text-center rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
                        GET_IN_TOUCH
                    </a>
                </div>
            </div>
        </div>

        <!-- MY JOURNEY -->
        <div class="mt-10 rounded-md glass cyber-glow p-6 relative">
            <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

            <div class="flex items-center gap-2">
                <span class="text-emerald-200 font-mono">&gt;</span>
                <h2 class="text-white font-bold tracking-wide">MY_JOURNEY.LOG</h2>
            </div>

            <div class="mt-5 text-slate-300 text-sm leading-relaxed whitespace-pre-line">
                {{ $settings?->journey }}
            </div>
        </div>

        <!-- EDUCATION + EXPERIENCE -->
        <div class="mt-10 grid md:grid-cols-12 gap-6 items-start">

            <!-- EDUCATION -->
            <div class="md:col-span-5 rounded-md glass cyber-glow p-6 relative">
                <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                <div class="flex items-center gap-2">
                    <span class="text-emerald-200">⟡</span>
                    <h2 class="text-white font-bold tracking-wide">EDUCATION.DAT</h2>
                </div>

                <div class="mt-6 space-y-4">
                    @foreach ($settings?->education ?? [] as $edu)
                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                            <div class="flex items-center justify-between">
                                <p class="text-white font-semibold">{{ data_get($edu,'title') }}</p>
                                <p class="text-xs text-slate-400 font-mono">{{ data_get($edu,'year') }}</p>
                            </div>
                            <p class="text-sm text-slate-300 mt-1">{{ data_get($edu,'note') }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- TRAINING -->
                <div class="mt-8">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-emerald-200 text-xs font-mono">&gt;</span>
                        <p class="text-white font-semibold tracking-wide text-sm">TRAINING_GROUNDS</p>
                    </div>

                    <div class="space-y-3">
                        @foreach ($settings?->training ?? [] as $tr)
                            <div class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                                <p class="text-white font-semibold">{{ data_get($tr,'title') }}</p>
                                <p class="mt-1 text-sm text-slate-300">{{ data_get($tr,'institute') }}</p>
                                <p class="text-xs text-slate-400 font-mono mt-1">Duration: {{ data_get($tr,'duration') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- EXPERIENCE -->
            <div class="md:col-span-7 rounded-md glass cyber-glow p-6 relative">
                <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                <div class="flex items-center gap-2">
                    <span class="text-emerald-200">⛭</span>
                    <h2 class="text-white font-bold tracking-wide">EXPERIENCE_LOG</h2>
                </div>

                <div class="mt-6 space-y-4">
                    @foreach ($settings?->experience ?? [] as $ex)
                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-5">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="text-white font-semibold">{{ data_get($ex,'role') }}</p>
                                    <p class="text-sm text-slate-300">
                                        {{ data_get($ex,'company') }} • {{ data_get($ex,'location') }}
                                    </p>
                                </div>
                                <p class="text-xs text-slate-400 font-mono">{{ data_get($ex,'period') }}</p>
                            </div>

                            <ul class="mt-3 text-sm text-slate-300 list-disc ml-5 space-y-1">
                                @foreach (data_get($ex,'tasks',[]) as $task)
                                    <li>{{ $task }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- SYSTEM METRICS (SKILLS) -->
        <div class="mt-10 rounded-md glass cyber-glow p-6 relative">
            <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

            <div class="flex items-center gap-2">
                <span class="text-emerald-200">⛭</span>
                <h2 class="text-white font-bold tracking-wide">SYSTEM_METRICS</h2>
            </div>

            <div class="mt-6 grid md:grid-cols-2 gap-6">
                @foreach ($settings?->skills ?? [] as $s)
                    @php
                        $name = data_get($s,'name','');
                        $per  = (int) data_get($s,'percent',0);
                    @endphp

                    <div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-300">{{ $name }}</span>
                            <span class="text-emerald-200 font-mono">{{ $per }}%</span>
                        </div>
                        <div class="mt-2 h-2 rounded-full bg-slate-950/50 border border-white/10 overflow-hidden">
                            <div class="h-full bg-emerald-400/40" style="width: {{ $per }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- CODE PHILOSOPHY + PASSION MODULES -->
        <div class="mt-10 rounded-md glass cyber-glow p-6 relative">
            <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

            <div class="grid md:grid-cols-12 gap-6 items-start">

                {{-- LEFT : CODE PHILOSOPHY --}}
                <div class="md:col-span-6">
                    <div class="flex items-center gap-2">
                        <span class="text-emerald-200 font-mono">&gt;</span>
                        <h2 class="text-white font-bold tracking-wide">CODE_PHILOSOPHY</h2>
                    </div>

                    <div class="mt-5 text-slate-300 text-sm leading-relaxed space-y-3">
                        @forelse ($settings?->philosophy ?? [] as $p)
                            @if(!empty($p))
                                <p>• {{ $p }}</p>
                            @endif
                        @empty
                            <p class="text-white/40 text-xs font-mono">No philosophy added.</p>
                        @endforelse
                    </div>
                </div>

                {{-- RIGHT : PASSION MODULES --}}
                <div class="md:col-span-6">
                    <div class="flex items-center gap-2">
                        <span class="text-emerald-200">⌁</span>
                        <h2 class="text-white font-bold tracking-wide">PASSION_MODULES</h2>
                    </div>

                    <div class="mt-4 grid grid-cols-2 gap-3">
                        @forelse ($settings?->passions ?? [] as $ps)
                            @if(!empty(data_get($ps,'title')) && !empty(data_get($ps,'desc')))
                                <div class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                                    <p class="text-white font-semibold text-sm">
                                        {{ data_get($ps,'title') }}
                                    </p>
                                    <p class="mt-2 text-xs text-slate-400 leading-relaxed">
                                        {{ data_get($ps,'desc') }}
                                    </p>
                                </div>
                            @endif
                        @empty
                            <p class="col-span-2 text-white/40 text-xs font-mono">
                                No passion modules added.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>


        <!-- FINAL CTA (static fallback — if you later store final_cta, this can be dynamic too) -->
        <div class="mt-10 rounded-md glass cyber-glow p-8 text-center relative">
            <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

            <h3 class="text-2xl font-extrabold text-white cyber-text">
                READY_TO_BUILD_SOMETHING_AMAZING?
            </h3>

            <p class="mt-3 text-slate-300 max-w-2xl mx-auto">
                Let’s turn your ideas into reality — whether it’s a web application, business website, ERP system,
                ecommerce platform, or something completely custom.
            </p>

            <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('contact') }}"
                   class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-6 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
                    START_PROJECT
                </a>
                <a href="{{ route('projects') }}"
                   class="rounded-md border border-white/10 bg-slate-950/30 px-6 py-3 font-semibold text-white hover:border-emerald-400/25 transition">
                    VIEW_PORTFOLIO
                </a>
            </div>

            <p class="mt-5 text-xs text-slate-500 font-mono">⌁ Activate neural interface...</p>
        </div>

    </section>
</div>
@endsection
