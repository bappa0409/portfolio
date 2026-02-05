@extends('layouts.app')
@section('title', 'Admin | Homepage Settings')
@section('breadcrumb', 'Website / Homepage Settings')

@section('content')
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; HOMEPAGE_CONTROL</p>
            <h1 class="mt-2 text-2xl font-extrabold text-white cyber-text tracking-wide">HOMEPAGE_SETTINGS</h1>
            <p class="mt-2 text-sm text-slate-300">Manage homepage fixed sections content from here.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="text-xs font-mono text-emerald-200 hover:text-emerald-100">← Back</a>
    </div>

    <div class="mt-4 rounded-md glass cyber-glow p-6 relative">
        <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

        @if(session('success'))
            <div class="mb-4 rounded-md border border-emerald-400/20 bg-emerald-400/10 px-4 py-2 text-emerald-100 text-xs font-mono">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.homepage.settings.update') }}" class="mt-4 grid md:grid-cols-2 gap-5"
              enctype="multipart/form-data">
            @csrf

            {{-- =========================================================
                SECTION META (Titles/Subtitles)
            ========================================================== --}}
            <div class="md:col-span-2">
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; SECTION_META</p>
                <p class="mt-1 text-[11px] text-slate-400 font-mono">Controls headings/subheadings of fixed sections.</p>
            </div>

            @php $meta = $settings->sections_meta ?? []; @endphp

            {{-- Services meta --}}
            <div>
                <label class="text-xs font-mono text-slate-400">SERVICES TITLE</label>
                <input name="sections_meta[services][title]"
                       value="{{ old('sections_meta.services.title', data_get($meta,'services.title','Services')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>
            <div>
                <label class="text-xs font-mono text-slate-400">SERVICES SUBTITLE</label>
                <input name="sections_meta[services][subtitle]"
                       value="{{ old('sections_meta.services.subtitle', data_get($meta,'services.subtitle','')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            {{-- Why choose meta --}}
            <div>
                <label class="text-xs font-mono text-slate-400">WHY CHOOSE TITLE</label>
                <input name="sections_meta[why_choose][title]"
                       value="{{ old('sections_meta.why_choose.title', data_get($meta,'why_choose.title','Why Choose Me')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>
            <div>
                <label class="text-xs font-mono text-slate-400">WHY CHOOSE SUBTITLE</label>
                <input name="sections_meta[why_choose][subtitle]"
                       value="{{ old('sections_meta.why_choose.subtitle', data_get($meta,'why_choose.subtitle','')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            {{-- Process meta --}}
            <div>
                <label class="text-xs font-mono text-slate-400">PROCESS TITLE</label>
                <input name="sections_meta[process][title]"
                       value="{{ old('sections_meta.process.title', data_get($meta,'process.title','How I Work')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>
            <div>
                <label class="text-xs font-mono text-slate-400">PROCESS SUBTITLE</label>
                <input name="sections_meta[process][subtitle]"
                       value="{{ old('sections_meta.process.subtitle', data_get($meta,'process.subtitle','')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            {{-- Tech stack meta --}}
            <div>
                <label class="text-xs font-mono text-slate-400">TECH STACK TITLE</label>
                <input name="sections_meta[tech_stack][title]"
                       value="{{ old('sections_meta.tech_stack.title', data_get($meta,'tech_stack.title','Tech Stack')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>
            <div>
                <label class="text-xs font-mono text-slate-400">TECH STACK SUBTITLE</label>
                <input name="sections_meta[tech_stack][subtitle]"
                       value="{{ old('sections_meta.tech_stack.subtitle', data_get($meta,'tech_stack.subtitle','')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            {{-- Testimonials meta --}}
            <div>
                <label class="text-xs font-mono text-slate-400">TESTIMONIALS TITLE</label>
                <input name="sections_meta[testimonials][title]"
                       value="{{ old('sections_meta.testimonials.title', data_get($meta,'testimonials.title','Testimonials')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>
            <div>
                <label class="text-xs font-mono text-slate-400">TESTIMONIALS SUBTITLE</label>
                <input name="sections_meta[testimonials][subtitle]"
                       value="{{ old('sections_meta.testimonials.subtitle', data_get($meta,'testimonials.subtitle','')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            {{-- FAQ meta --}}
            <div>
                <label class="text-xs font-mono text-slate-400">FAQ TITLE</label>
                <input name="sections_meta[faq][title]"
                       value="{{ old('sections_meta.faq.title', data_get($meta,'faq.title','FAQ')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>
            <div>
                <label class="text-xs font-mono text-slate-400">FAQ SUBTITLE</label>
                <input name="sections_meta[faq][subtitle]"
                       value="{{ old('sections_meta.faq.subtitle', data_get($meta,'faq.subtitle','')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            {{-- Featured projects meta --}}
            <div>
                <label class="text-xs font-mono text-slate-400">FEATURED PROJECTS TITLE</label>
                <input name="sections_meta[featured_projects][title]"
                       value="{{ old('sections_meta.featured_projects.title', data_get($meta,'featured_projects.title','Featured Projects')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>
            <div>
                <label class="text-xs font-mono text-slate-400">FEATURED PROJECTS BUTTON TEXT</label>
                <input name="sections_meta[featured_projects][button_text]"
                       value="{{ old('sections_meta.featured_projects.button_text', data_get($meta,'featured_projects.button_text','See all →')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            {{-- =========================================================
                HERO
            ========================================================== --}}
            <div class="md:col-span-2 mt-6">
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; HERO</p>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">KICKER</label>
                <input name="hero[kicker]" value="{{ old('hero.kicker', data_get($settings->hero,'kicker')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">HEADLINE</label>
                <input name="hero[headline]" value="{{ old('hero.headline', data_get($settings->hero,'headline')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">DESCRIPTION</label>
                <textarea name="hero[description]" rows="4"
                          class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ old('hero.description', data_get($settings->hero,'description')) }}</textarea>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">ACTIVATE TITLE</label>
                <input name="hero[activate_title]" value="{{ old('hero.activate_title', data_get($settings->hero,'activate_title')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">ACTIVATE SUBTITLE</label>
                <input name="hero[activate_subtitle]" value="{{ old('hero.activate_subtitle', data_get($settings->hero,'activate_subtitle')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">STATUS LABEL</label>
                <input name="hero[status][label]" value="{{ old('hero.status.label', data_get($settings->hero,'status.label','Status')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">STATUS VALUE</label>
                <input name="hero[status][value]" value="{{ old('hero.status.value', data_get($settings->hero,'status.value','Freelance')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">BADGE TEXT</label>
                <input name="hero[status][badge]" value="{{ old('hero.status.badge', data_get($settings->hero,'status.badge','Open')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            {{-- HERO BUTTONS --}}
            <div class="md:col-span-2" x-data="{ buttons: @js(old('hero.buttons', data_get($settings->hero,'buttons', []))) }">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-mono text-slate-400">HERO BUTTONS</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                            @click="buttons.push({text:'',url:''})">+ ADD_BUTTON</button>
                </div>

                <template x-for="(b,i) in buttons" :key="i">
                    <div class="mt-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                        <div class="grid md:grid-cols-2 gap-3">
                            <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`hero[buttons][${i}][text]`" x-model="b.text" placeholder="Button Text">
                            <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`hero[buttons][${i}][url]`" x-model="b.url" placeholder="/contact">
                        </div>
                        <div class="mt-2 text-right">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="buttons.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>
            </div>

            {{-- HERO TAGS --}}
            <div class="md:col-span-2" x-data="{ tags: @js(old('hero.tags', data_get($settings->hero,'tags', []))) }">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-mono text-slate-400">HERO TAGS</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                            @click="tags.push('')">+ ADD_TAG</button>
                </div>

                <template x-for="(t,i) in tags" :key="i">
                    <div class="mt-3 rounded-md border border-white/10 bg-slate-950/30 p-4 flex items-center gap-3">
                        <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                               :name="`hero[tags][${i}]`" x-model="tags[i]" placeholder="Laravel">
                        <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="tags.splice(i,1)">REMOVE</button>
                    </div>
                </template>
            </div>

            {{-- HERO MINI STATS --}}
            <div class="md:col-span-2" x-data="{ minis: @js(old('hero.mini_stats', data_get($settings->hero,'mini_stats', []))) }">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-mono text-slate-400">HERO MINI STATS</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                            @click="minis.push({value:'',label:''})">+ ADD_MINI_STAT</button>
                </div>

                <template x-for="(m,i) in minis" :key="i">
                    <div class="mt-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                        <div class="grid md:grid-cols-2 gap-3">
                            <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`hero[mini_stats][${i}][value]`" x-model="m.value" placeholder="20+">
                            <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`hero[mini_stats][${i}][label]`" x-model="m.label" placeholder="Projects">
                        </div>
                        <div class="mt-2 text-right">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="minis.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>
            </div>

            {{-- HERO IMAGE --}}
            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">PROFILE IMAGE</label>

                <label for="hero_profile_image"
                       class="mt-2 block rounded-md border border-dashed border-white/15 bg-slate-950/30
                              hover:border-emerald-400/30 transition p-4 cursor-pointer relative overflow-hidden">
                    <div class="absolute inset-0 scanline opacity-30 pointer-events-none"></div>

                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-md border border-white/10 bg-white/5 flex items-center justify-center text-white/70">⧉</div>
                            <div>
                                <p class="text-sm text-white/85 font-semibold">Drag & Drop image</p>
                                <p class="text-[11px] text-slate-400 font-mono">or click to upload (only one)</p>
                            </div>
                        </div>

                        <span class="text-[10px] px-2 py-1 rounded bg-emerald-400/15 text-emerald-200 border border-emerald-400/20">HERO</span>
                    </div>

                    <input id="hero_profile_image" type="file" name="hero_profile_image" accept="image/*" class="hidden">
                </label>

                <div id="heroImagePreview" class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 hidden">
                    <div class="relative rounded-md border border-white/10 bg-white/5 overflow-hidden">
                        <img id="heroImagePreviewImg" src="" class="w-full h-24 object-cover" alt="Hero preview">
                        <div class="absolute inset-0 bg-black/20 pointer-events-none"></div>
                        <div id="heroImagePreviewCap" class="px-2 py-1 text-[10px] font-mono text-slate-300 truncate"></div>
                    </div>
                </div>

                @if(data_get($settings->hero,'profile_image'))
                    <p class="mt-2 text-[11px] text-slate-500 font-mono">Current:</p>
                    <img class="mt-2 h-24 rounded-md border border-white/10"
                         src="{{ asset('storage/'.data_get($settings->hero,'profile_image')) }}" alt="Current hero image">
                @endif

                @error('hero_profile_image')
                    <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            {{-- =========================================================
                SERVICES (repeatable)
            ========================================================== --}}
            <div class="md:col-span-2 mt-6">
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; SERVICES</p>
            </div>

            <div class="md:col-span-2" x-data="{ items: @js(old('services', $settings->services ?? [])) }">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-mono text-slate-400">SERVICES LIST</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                            @click="items.push({icon:'',title:'',desc:''})">+ ADD_SERVICE</button>
                </div>

                <template x-for="(srv,i) in items" :key="i">
                    <div class="mt-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                        <div class="grid md:grid-cols-3 gap-3">
                            <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`services[${i}][icon]`" x-model="srv.icon" placeholder="🧩">
                            <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white md:col-span-2"
                                   :name="`services[${i}][title]`" x-model="srv.title" placeholder="Title">
                        </div>

                        <textarea class="mt-3 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                  rows="3" :name="`services[${i}][desc]`" x-model="srv.desc" placeholder="Description"></textarea>

                        <div class="mt-2 text-right">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="items.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>
            </div>

            {{-- =========================================================
                FEATURED PROJECTS (config)
            ========================================================== --}}
            <div class="md:col-span-2 mt-6">
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; FEATURED_PROJECTS</p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">SECTION TITLE</label>
                <input name="featured_projects[title]"
                       value="{{ old('featured_projects.title', data_get($settings->featured_projects,'title','Featured Projects')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">LIMIT</label>
                <input type="number" min="1" max="24" name="featured_projects[limit]"
                       value="{{ old('featured_projects.limit', data_get($settings->featured_projects,'limit',6)) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">BUTTON TEXT (frontend "See all →")</label>
                <input name="featured_projects[button_text]"
                       value="{{ old('featured_projects.button_text', data_get($settings->featured_projects,'button_text','See all →')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            {{-- =========================================================
                CTA TOP
            ========================================================== --}}
            <div class="md:col-span-2 mt-6">
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; CTA_TOP</p>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">TITLE</label>
                <input name="cta_top[title]" value="{{ old('cta_top.title', data_get($settings->cta_top,'title')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">SUBTITLE</label>
                <textarea name="cta_top[subtitle]" rows="2"
                          class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ old('cta_top.subtitle', data_get($settings->cta_top,'subtitle')) }}</textarea>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">BUTTON TEXT</label>
                <input name="cta_top[button_text]" value="{{ old('cta_top.button_text', data_get($settings->cta_top,'button_text')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">BUTTON URL</label>
                <input name="cta_top[button_url]" value="{{ old('cta_top.button_url', data_get($settings->cta_top,'button_url','/contact')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            {{-- =========================================================
                WHY CHOOSE ME (repeatable)
            ========================================================== --}}
            <div class="md:col-span-2 mt-6">
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; WHY_CHOOSE_ME</p>
            </div>

            <div class="md:col-span-2" x-data="{ items: @js(old('why_choose_me', $settings->why_choose_me ?? [])) }">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-mono text-slate-400">WHY CHOOSE LIST</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                            @click="items.push({icon:'',title:'',desc:''})">+ ADD_ITEM</button>
                </div>

                <template x-for="(w,i) in items" :key="i">
                    <div class="mt-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                        <div class="grid md:grid-cols-3 gap-3">
                            <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`why_choose_me[${i}][icon]`" x-model="w.icon" placeholder="🔒">
                            <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white md:col-span-2"
                                   :name="`why_choose_me[${i}][title]`" x-model="w.title" placeholder="Title">
                        </div>

                        <textarea class="mt-3 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                  rows="3" :name="`why_choose_me[${i}][desc]`" x-model="w.desc" placeholder="Description"></textarea>

                        <div class="mt-2 text-right">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="items.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>
            </div>

            {{-- =========================================================
                PROCESS (repeatable)
            ========================================================== --}}
            <div class="md:col-span-2 mt-6">
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PROCESS</p>
            </div>

            <div class="md:col-span-2" x-data="{ items: @js(old('process', $settings->process ?? [])) }">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-mono text-slate-400">PROCESS STEPS</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                            @click="items.push({step:'',title:'',desc:''})">+ ADD_STEP</button>
                </div>

                <template x-for="(p,i) in items" :key="i">
                    <div class="mt-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                        <div class="grid md:grid-cols-3 gap-3">
                            <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`process[${i}][step]`" x-model="p.step" placeholder="1">
                            <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white md:col-span-2"
                                   :name="`process[${i}][title]`" x-model="p.title" placeholder="Title">
                        </div>

                        <textarea class="mt-3 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                  rows="3" :name="`process[${i}][desc]`" x-model="p.desc" placeholder="Description"></textarea>

                        <div class="mt-2 text-right">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="items.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>
            </div>

            {{-- =========================================================
                TECH STACK (repeatable lists)
            ========================================================== --}}
            <div class="md:col-span-2 mt-6">
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; TECH_STACK</p>
                <p class="mt-1 text-[11px] text-slate-400 font-mono">Add items (one per row) for each category.</p>
            </div>

            @php $ts = $settings->tech_stack ?? []; @endphp

            <div class="md:col-span-2 grid md:grid-cols-2 gap-5">
                {{-- Backend --}}
                <div x-data="{ items: @js(old('tech_stack.backend', data_get($ts,'backend',[]))) }" class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-mono text-slate-400">BACKEND</p>
                        <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                                @click="items.push('')">+ ADD</button>
                    </div>
                    <template x-for="(t,i) in items" :key="i">
                        <div class="mt-3 flex items-center gap-3">
                            <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`tech_stack[backend][${i}]`" x-model="items[i]" placeholder="Laravel">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="items.splice(i,1)">X</button>
                        </div>
                    </template>
                </div>

                {{-- Frontend --}}
                <div x-data="{ items: @js(old('tech_stack.frontend', data_get($ts,'frontend',[]))) }" class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-mono text-slate-400">FRONTEND</p>
                        <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                                @click="items.push('')">+ ADD</button>
                    </div>
                    <template x-for="(t,i) in items" :key="i">
                        <div class="mt-3 flex items-center gap-3">
                            <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`tech_stack[frontend][${i}]`" x-model="items[i]" placeholder="Blade">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="items.splice(i,1)">X</button>
                        </div>
                    </template>
                </div>

                {{-- WordPress --}}
                <div x-data="{ items: @js(old('tech_stack.wordpress', data_get($ts,'wordpress',[]))) }" class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-mono text-slate-400">WORDPRESS</p>
                        <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                                @click="items.push('')">+ ADD</button>
                    </div>
                    <template x-for="(t,i) in items" :key="i">
                        <div class="mt-3 flex items-center gap-3">
                            <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`tech_stack[wordpress][${i}]`" x-model="items[i]" placeholder="Customization">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="items.splice(i,1)">X</button>
                        </div>
                    </template>
                </div>

                {{-- Tools --}}
                <div x-data="{ items: @js(old('tech_stack.tools', data_get($ts,'tools',[]))) }" class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-mono text-slate-400">TOOLS</p>
                        <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                                @click="items.push('')">+ ADD</button>
                    </div>
                    <template x-for="(t,i) in items" :key="i">
                        <div class="mt-3 flex items-center gap-3">
                            <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`tech_stack[tools][${i}]`" x-model="items[i]" placeholder="Git">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="items.splice(i,1)">X</button>
                        </div>
                    </template>
                </div>

                {{-- SQA --}}
                <div x-data="{ items: @js(old('tech_stack.sqa', data_get($ts,'sqa',[]))) }" class="rounded-md border border-white/10 bg-slate-950/30 p-4 md:col-span-2">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-mono text-slate-400">SQA</p>
                        <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                                @click="items.push('')">+ ADD</button>
                    </div>
                    <template x-for="(t,i) in items" :key="i">
                        <div class="mt-3 flex items-center gap-3">
                            <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`tech_stack[sqa][${i}]`" x-model="items[i]" placeholder="Regression Testing">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="items.splice(i,1)">X</button>
                        </div>
                    </template>
                </div>
            </div>

            {{-- =========================================================
                STATS (repeatable)
            ========================================================== --}}
            <div class="md:col-span-2 mt-6">
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; STATS</p>
            </div>

            <div class="md:col-span-2" x-data="{ items: @js(old('stats', $settings->stats ?? [])) }">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-mono text-slate-400">STATS ITEMS</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                            @click="items.push({value:0,suffix:'',label:''})">+ ADD_STAT</button>
                </div>

                <template x-for="(s,i) in items" :key="i">
                    <div class="mt-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                        <div class="grid md:grid-cols-3 gap-3">
                            <input type="number" class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`stats[${i}][value]`" x-model.number="s.value" placeholder="20">
                            <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`stats[${i}][suffix]`" x-model="s.suffix" placeholder="+">
                            <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`stats[${i}][label]`" x-model="s.label" placeholder="Projects Completed">
                        </div>
                        <div class="mt-2 text-right">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="items.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>
            </div>

            {{-- =========================================================
                CTA BOTTOM
            ========================================================== --}}
            <div class="md:col-span-2 mt-6">
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; CTA_BOTTOM</p>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">TITLE</label>
                <input name="cta_bottom[title]" value="{{ old('cta_bottom.title', data_get($settings->cta_bottom,'title')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">SUBTITLE</label>
                <textarea name="cta_bottom[subtitle]" rows="2"
                          class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ old('cta_bottom.subtitle', data_get($settings->cta_bottom,'subtitle')) }}</textarea>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">BUTTON TEXT</label>
                <input name="cta_bottom[button_text]" value="{{ old('cta_bottom.button_text', data_get($settings->cta_bottom,'button_text')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">BUTTON URL</label>
                <input name="cta_bottom[button_url]" value="{{ old('cta_bottom.button_url', data_get($settings->cta_bottom,'button_url','/contact')) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            {{-- =========================================================
                TESTIMONIALS (repeatable)
            ========================================================== --}}
            <div class="md:col-span-2 mt-6">
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; TESTIMONIALS</p>
            </div>

            <div class="md:col-span-2" x-data="{ items: @js(old('testimonials', $settings->testimonials ?? [])) }">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-mono text-slate-400">TESTIMONIALS LIST</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                            @click="items.push({text:'',name:'',role:''})">+ ADD_TESTIMONIAL</button>
                </div>

                <template x-for="(t,i) in items" :key="i">
                    <div class="mt-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                        <textarea class="w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                  rows="3" :name="`testimonials[${i}][text]`" x-model="t.text" placeholder="Testimonial text"></textarea>

                        <div class="mt-3 grid md:grid-cols-2 gap-3">
                            <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`testimonials[${i}][name]`" x-model="t.name" placeholder="Client Name">
                            <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`testimonials[${i}][role]`" x-model="t.role" placeholder="Role (CTO)">
                        </div>

                        <div class="mt-2 text-right">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="items.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>
            </div>

            {{-- =========================================================
                FAQ (repeatable)
            ========================================================== --}}
            <div class="md:col-span-2 mt-6">
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; FAQ</p>
            </div>

            <div class="md:col-span-2" x-data="{ items: @js(old('faq', $settings->faq ?? [])) }">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-mono text-slate-400">FAQ LIST</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                            @click="items.push({q:'',a:''})">+ ADD_FAQ</button>
                </div>

                <template x-for="(f,i) in items" :key="i">
                    <div class="mt-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                        <input class="w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                               :name="`faq[${i}][q]`" x-model="f.q" placeholder="Question">
                        <textarea class="mt-3 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                  rows="3" :name="`faq[${i}][a]`" x-model="f.a" placeholder="Answer"></textarea>

                        <div class="mt-2 text-right">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="items.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>
            </div>

            {{-- =========================================================
                SAVE
            ========================================================== --}}
            <div class="md:col-span-2 flex gap-3 mt-6">
                <button class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-6 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
                    SAVE_SETTINGS
                </button>

                <a href="{{ route('admin.dashboard') }}"
                   class="rounded-md border border-white/10 bg-white/5 px-6 py-3 font-semibold text-white hover:border-emerald-400/25 transition">
                    CANCEL
                </a>
            </div>

        </form>
    </div>
@endsection

@push('scripts')
<script>
(() => {
    const input = document.getElementById('hero_profile_image');
    const wrap  = input?.closest('label');
    const prev  = document.getElementById('heroImagePreview');
    const img   = document.getElementById('heroImagePreviewImg');
    const cap   = document.getElementById('heroImagePreviewCap');

    const bindDropZone = (zoneEl, inputEl) => {
        if (!zoneEl || !inputEl) return;

        const setActive = (on) => {
            zoneEl.classList.toggle('border-emerald-400/50', on);
            zoneEl.classList.toggle('bg-emerald-400/5', on);
        };

        ['dragenter', 'dragover'].forEach(evt => {
            zoneEl.addEventListener(evt, (e) => {
                e.preventDefault(); e.stopPropagation();
                setActive(true);
            });
        });

        ['dragleave', 'drop'].forEach(evt => {
            zoneEl.addEventListener(evt, (e) => {
                e.preventDefault(); e.stopPropagation();
                setActive(false);
            });
        });

        zoneEl.addEventListener('drop', (e) => {
            const files = Array.from(e.dataTransfer.files || []).filter(f => f.type.startsWith('image/'));
            if (!files.length) return;
            const dt = new DataTransfer();
            dt.items.add(files[0]);
            inputEl.files = dt.files;
            inputEl.dispatchEvent(new Event('change', { bubbles: true }));
        });
    };

    if (input && prev && img && cap) {
        input.addEventListener('change', () => {
            const file = input.files?.[0];
            if (!file || !file.type.startsWith('image/')) {
                prev.classList.add('hidden');
                return;
            }
            img.src = URL.createObjectURL(file);
            cap.textContent = file.name;
            prev.classList.remove('hidden');
        });
        bindDropZone(wrap, input);
    }
})();
</script>
@endpush
