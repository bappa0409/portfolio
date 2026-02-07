@extends('layouts.website')
@section('title', ($project['title'] ?? 'Project').' | Project')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-12">
    <a href="{{ route('projects') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-200 hover:text-emerald-100">
        ← Back to Projects
    </a>

    <div class="mt-6 rounded-md overflow-hidden glass cyber-glow scanline border border-emerald-400/15">

        {{-- HEADER INFO (Before Hero) --}}
        <div class="p-5 md:p-6 border-b border-emerald-400/10">
            <div class="max-w-3xl">
                <p class="text-emerald-200/80 text-xs tracking-widest cyber-text">PROJECT FILE</p>

                <div class="mt-2 flex flex-wrap items-center gap-3">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white leading-tight">
                        {{ $project['title'] ?? 'Project' }}
                    </h1>

                    <span class="text-xs rounded-full bg-emerald-400/15 border border-emerald-400/25 px-3 py-1 text-emerald-200">
                        {{ ($project['status'] ?? '') === 'Live' ? 'Online' : 'Private' }}
                    </span>
                </div>

                @if(!empty($project['subtitle']))
                    <p class="mt-3 text-white/70">{{ $project['subtitle'] }}</p>
                @endif

                @if(!empty($project['stack']) && count($project['stack']) > 0)
                    <div class="mt-5 flex flex-wrap gap-2">
                        @foreach($project['stack'] as $tag)
                            <span class="text-xs rounded-full bg-white/5 border border-white/10 px-3 py-1 text-white/85">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        {{-- HERO + GALLERY --}}
        <div
            x-data="{
                lightbox: false,
                active: 0,
                images: @js($project['thumbnails'] ?? []),

                open(i){
                    if(!this.images.length) return;
                    this.active = i;
                    this.lightbox = true;
                    document.body.classList.add('overflow-hidden');
                },
                close(){
                    this.lightbox = false;
                    document.body.classList.remove('overflow-hidden');
                },
                next(){
                    if(!this.images.length) return;
                    this.active = (this.active + 1) % this.images.length;
                },
                prev(){
                    if(!this.images.length) return;
                    this.active = (this.active - 1 + this.images.length) % this.images.length;
                },
                key(e){
                    if(!this.lightbox) return;
                    if(e.key === 'Escape') this.close();
                    if(e.key === 'ArrowRight') this.next();
                    if(e.key === 'ArrowLeft') this.prev();
                }
            }"
            @keydown.window="key($event)"
        >
            {{-- HERO IMAGE (no lightbox) --}}
            <div class="relative h-56 md:h-80 overflow-hidden">
                @if(!empty($project['image']))
                    <img src="{{ asset('upload/images/projects/'.$project['image']) }}"
                         alt="{{ $project['title'] ?? 'Project' }}"
                         class="h-full w-full object-cover"
                         loading="lazy" decoding="async">
                @else
                    <div class="h-full w-full bg-gradient-to-br from-emerald-400/15 to-white/0"></div>
                @endif

                {{-- overlays --}}
                <div class="absolute inset-0 bg-black/45 pointer-events-none"></div>
                <div class="absolute inset-0 cyber-noise opacity-40 pointer-events-none"></div>
                <div class="absolute inset-0 scanline opacity-40 pointer-events-none"></div>

                {{-- corners --}}
                <div class="absolute top-3 left-3 h-6 w-6 border-t-2 border-l-2 border-emerald-400/60 pointer-events-none"></div>
                <div class="absolute top-3 right-3 h-6 w-6 border-t-2 border-r-2 border-emerald-400/60 pointer-events-none"></div>
                <div class="absolute bottom-3 left-3 h-6 w-6 border-b-2 border-l-2 border-emerald-400/60 pointer-events-none"></div>
                <div class="absolute bottom-3 right-3 h-6 w-6 border-b-2 border-r-2 border-emerald-400/60 pointer-events-none"></div>

                @if(!empty($project['image']))
                    <div class="absolute bottom-3 left-3 z-20 flex items-center gap-2 rounded-md bg-black/50 border border-emerald-400/20 px-3 py-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-emerald-400/70"></span>
                        <span class="text-xs text-white/80">
                            Project Hero Image
                            @if(!empty($project['thumbnails']) && count($project['thumbnails']) > 1)
                                • Gallery: {{ count($project['thumbnails']) }} images
                            @endif
                        </span>
                    </div>
                @endif
            </div>

            {{-- THUMBNAILS (includes main image as first item; controller did it) --}}
            @if(!empty($project['thumbnails']) && count($project['thumbnails']) > 0)
                <div class="p-5 md:p-6 border-t border-emerald-400/10">
                    <div class="flex items-end justify-between gap-4">
                        <div>
                            <p class="text-xs text-white/55">Gallery</p>
                            <p class="text-white font-semibold">Screenshots</p>
                        </div>
                        <div class="text-xs text-white/55">{{ count($project['thumbnails']) }} images</div>
                    </div>

                    <div class="mt-4 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                        @foreach(($project['thumbnails'] ?? []) as $i => $img)
                            <button type="button"
                                    @click="open({{ $i }})"
                                    class="relative rounded-md overflow-hidden border border-white/10 bg-white/5 hover:border-emerald-400/25 transition aspect-[4/3]">
                                <img src="{{ asset('upload/images/projects/'.$img) }}"
                                     alt="Gallery image {{ $i+1 }} - {{ $project['title'] ?? 'Project' }}"
                                     class="h-full w-full object-cover"
                                     loading="lazy" decoding="async">
                                <div class="absolute inset-0 bg-black/25 pointer-events-none"></div>

                                @if($i === 0)
                                    <div class="absolute bottom-1 left-1 text-[10px] rounded bg-black/60 px-1.5 py-0.5 text-white/80">
                                        Main
                                    </div>
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- LIGHTBOX --}}
            @if(!empty($project['thumbnails']) && count($project['thumbnails']) > 0)
                <template x-teleport="body">
                    <div x-show="lightbox" x-transition.opacity class="fixed inset-0 z-[9999]">
                        <div class="absolute inset-0 bg-black/80" @click="close()"></div>

                        <div class="relative mx-auto h-full max-w-6xl px-4 py-10 flex items-center justify-center">
                            <div class="relative w-full">
                                <div class="rounded-md overflow-hidden border border-emerald-400/20 bg-black/40 cyber-glow">
                                    <div class="relative">
                                        <img
                                            :src="`{{ asset('images/projects') }}/${images[active]}`"
                                            :alt="`{{ $project['title'] ?? 'Project' }} preview ${active+1}`"
                                            class="w-full max-h-[75vh] object-contain bg-black"
                                            loading="lazy" decoding="async"
                                        >

                                        <div class="absolute top-0 left-0 right-0 flex items-center justify-between p-3 bg-black/55">
                                            <div class="text-xs text-white/70">
                                                <span x-text="active + 1"></span>/<span x-text="images.length"></span>
                                                <span class="mx-2 text-white/30">•</span>
                                                <span class="text-white/80">{{ $project['title'] ?? 'Project' }}</span>
                                            </div>

                                            <button type="button" @click="close()"
                                                    class="rounded-md border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-semibold text-white hover:border-emerald-400/30 transition">
                                                Close ✕
                                            </button>
                                        </div>

                                        <button type="button" @click.stop="prev()"
                                                class="absolute left-3 top-1/2 -translate-y-1/2 rounded-md border border-white/10 bg-white/5 px-3 py-2 text-white hover:border-emerald-400/30 transition">
                                            ←
                                        </button>
                                        <button type="button" @click.stop="next()"
                                                class="absolute right-3 top-1/2 -translate-y-1/2 rounded-md border border-white/10 bg-white/5 px-3 py-2 text-white hover:border-emerald-400/30 transition">
                                            →
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4 flex gap-2 overflow-x-auto pb-2">
                                    <template x-for="(img, i) in images" :key="img">
                                        <button type="button"
                                                @click="active = i"
                                                class="relative h-16 w-24 shrink-0 rounded-md overflow-hidden border transition"
                                                :class="active === i ? 'border-emerald-400/60' : 'border-white/10 hover:border-emerald-400/30'">
                                            <img :src="`{{ asset('images/projects') }}/${img}`"
                                                 class="h-full w-full object-cover" alt="">
                                            <div class="absolute inset-0 bg-black/20 pointer-events-none"></div>
                                        </button>
                                    </template>
                                </div>

                                <p class="mt-2 text-xs text-white/45">
                                    Tip: Use ← → keys to navigate, Esc to close.
                                </p>
                            </div>
                        </div>
                    </div>
                </template>
            @endif
        </div>

        {{-- BODY --}}
        <div class="p-5 md:p-6">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="rounded-md p-6 glass-soft cyber-glow border border-emerald-400/10">
                    <h2 class="font-bold text-lg text-white">Overview</h2>
                    <p class="mt-2 text-white/70 text-sm leading-relaxed">
                        {{ $project['overview'] ?? '' }}
                    </p>
                </div>

                <div class="rounded-md p-6 glass-soft cyber-glow border border-emerald-400/10">
                    <h2 class="font-bold text-lg text-white">Key Features</h2>

                    @if(!empty($project['features']) && count($project['features']) > 0)
                        <ul class="mt-3 space-y-2 text-sm text-white/70 list-disc list-inside">
                            @foreach($project['features'] as $f)
                                <li>{{ $f }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-2 text-sm text-white/60">No features added.</p>
                    @endif
                </div>
            </div>

            <div class="mt-6 rounded-md p-6 glass-soft cyber-glow border border-emerald-400/10">
                <h2 class="font-bold text-lg text-white">Development Process</h2>

                @if(!empty($project['process']) && count($project['process']) > 0)
                    <div class="mt-4 grid sm:grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        @foreach($project['process'] as $step)
                            <div class="rounded-md bg-white/5 border border-white/10 p-4">
                                <p class="font-semibold text-white">
                                    {{ $step['title'] ?? '' }}
                                </p>

                                @if(!empty($step['desc']))
                                    <p class="mt-1 text-white/70">
                                        {{ $step['desc'] }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mt-2 text-sm text-white/60">No process steps added.</p>
                @endif
            </div>


            <div class="mt-8 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center justify-center rounded-md bg-emerald-400/20 border border-emerald-400/30 px-6 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/30 transition cyber-glow">
                    Build something like this
                </a>

                <a href="{{ route('projects') }}"
                   class="inline-flex items-center justify-center rounded-md border border-white/10 bg-white/5 px-6 py-3 font-semibold text-white hover:border-emerald-400/30 transition">
                    View more projects
                </a>
            </div>
        </div>

    </div>
</section>
@endsection
