@extends('layouts.app')
@section('title', 'Admin | Edit Home Page Setting')
@section('breadcrumb', 'Home page / Edit')

@section('content')
 <div class="flex items-start justify-between gap-4">
    <div>
        <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PROJECT_CONTROL</p>
        <h1 class="mt-2 text-2xl font-extrabold text-white cyber-text tracking-wide">CREATE_PROJECT</h1>
        <p class="mt-2 text-sm text-slate-300">Manage website projects from here.</p>
    </div>
    <a href="{{ route('admin.project.index') }}" class="text-xs font-mono text-emerald-200 hover:text-emerald-100">←
        Back</a>
</div>
<div class="p-6">
    <div class="mb-4 flex items-center justify-between">
        <h1 class="text-xl font-bold text-white">Homepage Settings</h1>
        @if(session('success'))
            <span class="text-emerald-200 text-sm">{{ session('success') }}</span>
        @endif
    </div>

    <form method="POST" action="{{ route('admin.homepage.settings.update') }}" enctype="multipart/form-data">
        @csrf

        {{-- HERO --}}
        <div class="rounded-md border border-white/10 bg-white/5 p-5 mb-6">
            <h2 class="text-white font-semibold mb-4">Hero</h2>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-white/60">Kicker</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="hero[kicker]" value="{{ data_get($settings->hero,'kicker') }}">
                </div>

                <div>
                    <label class="text-xs text-white/60">Headline</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="hero[headline]" value="{{ data_get($settings->hero,'headline') }}">
                </div>
            </div>

            <div class="mt-4">
                <label class="text-xs text-white/60">Description</label>
                <textarea class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white" rows="4"
                    name="hero[description]">{{ data_get($settings->hero,'description') }}</textarea>
            </div>

            <div class="grid md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="text-xs text-white/60">Activate Title</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="hero[activate_title]" value="{{ data_get($settings->hero,'activate_title') }}">
                </div>
                <div>
                    <label class="text-xs text-white/60">Activate Subtitle</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="hero[activate_subtitle]" value="{{ data_get($settings->hero,'activate_subtitle') }}">
                </div>
            </div>

            {{-- Status --}}
            <div class="grid md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="text-xs text-white/60">Status Label</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="hero[status][label]" value="{{ data_get($settings->hero,'status.label','Status') }}">
                </div>
                <div>
                    <label class="text-xs text-white/60">Status Value</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="hero[status][value]" value="{{ data_get($settings->hero,'status.value','Freelance') }}">
                </div>
                <div>
                    <label class="text-xs text-white/60">Badge</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="hero[status][badge]" value="{{ data_get($settings->hero,'status.badge','Open') }}">
                </div>
            </div>

            {{-- Profile Image --}}
            <div class="mt-4">
                <label class="text-xs text-white/60">Profile Image</label>
                <input type="file" name="hero_profile_image" class="block mt-2 text-white/70">
                @if(data_get($settings->hero,'profile_image'))
                    <img class="mt-3 h-20 rounded border border-white/10"
                         src="{{ asset('storage/'.data_get($settings->hero,'profile_image')) }}">
                @endif
            </div>

            {{-- Buttons (repeatable) --}}
            <div class="mt-6" x-data="{ items: @js(data_get($settings->hero,'buttons',[])) }">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-white/80 font-semibold">Buttons</h3>
                    <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/80"
                        @click="items.push({text:'',url:''})">+ Add</button>
                </div>

                <template x-for="(b,i) in items" :key="i">
                    <div class="grid md:grid-cols-[2fr_3fr_auto] gap-3 mb-2">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                            :name="`hero[buttons][${i}][text]`" x-model="b.text" placeholder="Text">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                            :name="`hero[buttons][${i}][url]`" x-model="b.url" placeholder="/contact">
                        <button type="button" class="px-3 rounded border border-white/10 text-white/70"
                            @click="items.splice(i,1)">Remove</button>
                    </div>
                </template>
            </div>

            {{-- Tags (repeatable) --}}
            <div class="mt-6" x-data="{ items: @js(data_get($settings->hero,'tags',[])) }">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-white/80 font-semibold">Hero Tags</h3>
                    <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/80"
                        @click="items.push('')">+ Add</button>
                </div>

                <template x-for="(t,i) in items" :key="i">
                    <div class="grid md:grid-cols-[1fr_auto] gap-3 mb-2">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                            :name="`hero[tags][${i}]`" x-model="items[i]" placeholder="Laravel">
                        <button type="button" class="px-3 rounded border border-white/10 text-white/70"
                            @click="items.splice(i,1)">Remove</button>
                    </div>
                </template>
            </div>

            {{-- Mini stats (repeatable) --}}
            <div class="mt-6" x-data="{ items: @js(data_get($settings->hero,'mini_stats',[])) }">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-white/80 font-semibold">Profile Mini Stats (3)</h3>
                    <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/80"
                        @click="items.push({value:'',label:''})">+ Add</button>
                </div>

                <template x-for="(s,i) in items" :key="i">
                    <div class="grid md:grid-cols-[1fr_2fr_auto] gap-3 mb-2">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                            :name="`hero[mini_stats][${i}][value]`" x-model="s.value" placeholder="20+">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                            :name="`hero[mini_stats][${i}][label]`" x-model="s.label" placeholder="Projects">
                        <button type="button" class="px-3 rounded border border-white/10 text-white/70"
                            @click="items.splice(i,1)">Remove</button>
                    </div>
                </template>
            </div>
        </div>

        {{-- SERVICES --}}
        <div class="rounded-md border border-white/10 bg-white/5 p-5 mb-6"
             x-data="{ items: @js($settings->services ?? []) }">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-white font-semibold">Services</h2>
                <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/80"
                    @click="items.push({icon:'',title:'',desc:''})">+ Add</button>
            </div>

            <template x-for="(srv,i) in items" :key="i">
                <div class="rounded border border-white/10 bg-slate-950/30 p-4 mb-3">
                    <div class="grid md:grid-cols-3 gap-3">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                            :name="`services[${i}][icon]`" x-model="srv.icon" placeholder="🧩">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white md:col-span-2"
                            :name="`services[${i}][title]`" x-model="srv.title" placeholder="Service Title">
                    </div>
                    <textarea class="w-full mt-3 rounded border border-white/10 bg-slate-950/40 p-2 text-white" rows="3"
                        :name="`services[${i}][desc]`" x-model="srv.desc" placeholder="Description"></textarea>

                    <div class="mt-2 text-right">
                        <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/70"
                            @click="items.splice(i,1)">Remove</button>
                    </div>
                </div>
            </template>
        </div>

        {{-- CTA TOP --}}
        <div class="rounded-md border border-white/10 bg-white/5 p-5 mb-6">
            <h2 class="text-white font-semibold mb-4">CTA (Top)</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-white/60">Title</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="cta_top[title]" value="{{ data_get($settings->cta_top,'title') }}">
                </div>
                <div>
                    <label class="text-xs text-white/60">Button Text</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="cta_top[button_text]" value="{{ data_get($settings->cta_top,'button_text') }}">
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="text-xs text-white/60">Subtitle</label>
                    <textarea class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white" rows="2"
                        name="cta_top[subtitle]">{{ data_get($settings->cta_top,'subtitle') }}</textarea>
                </div>
                <div>
                    <label class="text-xs text-white/60">Button URL</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="cta_top[button_url]" value="{{ data_get($settings->cta_top,'button_url') }}" placeholder="/contact">
                </div>
            </div>
        </div>

        {{-- FEATURED PROJECTS CONFIG --}}
        <div class="rounded-md border border-white/10 bg-white/5 p-5 mb-6">
            <h2 class="text-white font-semibold mb-4">Featured Projects (Config)</h2>
            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="text-xs text-white/60">Title</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="featured_projects[title]" value="{{ data_get($settings->featured_projects,'title','Featured Projects') }}">
                </div>
                <div>
                    <label class="text-xs text-white/60">Button Text</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="featured_projects[button_text]" value="{{ data_get($settings->featured_projects,'button_text','See all →') }}">
                </div>
                <div>
                    <label class="text-xs text-white/60">Limit</label>
                    <input type="number" min="1" max="24" class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="featured_projects[limit]" value="{{ data_get($settings->featured_projects,'limit',6) }}">
                </div>
            </div>
        </div>

        {{-- WHY CHOOSE ME --}}
        <div class="rounded-md border border-white/10 bg-white/5 p-5 mb-6"
             x-data="{ items: @js($settings->why_choose_me ?? []) }">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-white font-semibold">Why Choose Me</h2>
                <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/80"
                    @click="items.push({icon:'',title:'',desc:''})">+ Add</button>
            </div>

            <template x-for="(w,i) in items" :key="i">
                <div class="rounded border border-white/10 bg-slate-950/30 p-4 mb-3">
                    <div class="grid md:grid-cols-3 gap-3">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                            :name="`why_choose_me[${i}][icon]`" x-model="w.icon" placeholder="⚡">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white md:col-span-2"
                            :name="`why_choose_me[${i}][title]`" x-model="w.title" placeholder="Title">
                    </div>
                    <textarea class="w-full mt-3 rounded border border-white/10 bg-slate-950/40 p-2 text-white" rows="2"
                        :name="`why_choose_me[${i}][desc]`" x-model="w.desc" placeholder="Description"></textarea>

                    <div class="mt-2 text-right">
                        <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/70"
                            @click="items.splice(i,1)">Remove</button>
                    </div>
                </div>
            </template>
        </div>

        {{-- PROCESS --}}
        <div class="rounded-md border border-white/10 bg-white/5 p-5 mb-6"
             x-data="{ items: @js($settings->process ?? []) }">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-white font-semibold">Process</h2>
                <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/80"
                    @click="items.push({step:'',title:'',desc:''})">+ Add</button>
            </div>

            <template x-for="(p,i) in items" :key="i">
                <div class="rounded border border-white/10 bg-slate-950/30 p-4 mb-3">
                    <div class="grid md:grid-cols-3 gap-3">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                            :name="`process[${i}][step]`" x-model="p.step" placeholder="1">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white md:col-span-2"
                            :name="`process[${i}][title]`" x-model="p.title" placeholder="Title">
                    </div>
                    <textarea class="w-full mt-3 rounded border border-white/10 bg-slate-950/40 p-2 text-white" rows="2"
                        :name="`process[${i}][desc]`" x-model="p.desc" placeholder="Description"></textarea>

                    <div class="mt-2 text-right">
                        <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/70"
                            @click="items.splice(i,1)">Remove</button>
                    </div>
                </div>
            </template>
        </div>

        {{-- TECH STACK (comma separated inputs to array) --}}
        @php
          $ts = $settings->tech_stack ?? [];
          $toCsv = fn($arr) => is_array($arr) ? implode(', ', $arr) : '';
        @endphp
        <div class="rounded-md border border-white/10 bg-white/5 p-5 mb-6">
            <h2 class="text-white font-semibold mb-4">Tech Stack (comma separated)</h2>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-white/60">Backend</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="tech_stack[backend_csv]" value="{{ $toCsv(data_get($ts,'backend',[])) }}">
                </div>
                <div>
                    <label class="text-xs text-white/60">Frontend</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="tech_stack[frontend_csv]" value="{{ $toCsv(data_get($ts,'frontend',[])) }}">
                </div>

                <div>
                    <label class="text-xs text-white/60">WordPress</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="tech_stack[wordpress_csv]" value="{{ $toCsv(data_get($ts,'wordpress',[])) }}">
                </div>
                <div>
                    <label class="text-xs text-white/60">Tools</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="tech_stack[tools_csv]" value="{{ $toCsv(data_get($ts,'tools',[])) }}">
                </div>

                <div class="md:col-span-2">
                    <label class="text-xs text-white/60">SQA</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="tech_stack[sqa_csv]" value="{{ $toCsv(data_get($ts,'sqa',[])) }}">
                </div>
            </div>

            <p class="text-xs text-white/50 mt-3">Example: Laravel, PHP, MySQL</p>
        </div>

        {{-- STATS COUNTER --}}
        <div class="rounded-md border border-white/10 bg-white/5 p-5 mb-6"
             x-data="{ items: @js($settings->stats ?? []) }">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-white font-semibold">Stats Counter</h2>
                <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/80"
                    @click="items.push({value:0,suffix:'',label:''})">+ Add</button>
            </div>

            <template x-for="(s,i) in items" :key="i">
                <div class="rounded border border-white/10 bg-slate-950/30 p-4 mb-3">
                    <div class="grid md:grid-cols-3 gap-3">
                        <input type="number" class="rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                            :name="`stats[${i}][value]`" x-model="s.value" min="0">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                            :name="`stats[${i}][suffix]`" x-model="s.suffix" placeholder="+ / % / h">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                            :name="`stats[${i}][label]`" x-model="s.label" placeholder="Label">
                    </div>
                    <div class="mt-2 text-right">
                        <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/70"
                            @click="items.splice(i,1)">Remove</button>
                    </div>
                </div>
            </template>
        </div>

        {{-- TESTIMONIALS --}}
        <div class="rounded-md border border-white/10 bg-white/5 p-5 mb-6"
             x-data="{ items: @js($settings->testimonials ?? []) }">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-white font-semibold">Testimonials</h2>
                <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/80"
                    @click="items.push({text:'',name:'',role:''})">+ Add</button>
            </div>

            <template x-for="(t,i) in items" :key="i">
                <div class="rounded border border-white/10 bg-slate-950/30 p-4 mb-3">
                    <textarea class="w-full rounded border border-white/10 bg-slate-950/40 p-2 text-white" rows="2"
                        :name="`testimonials[${i}][text]`" x-model="t.text" placeholder="Testimonial text"></textarea>
                    <div class="grid md:grid-cols-2 gap-3 mt-3">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                            :name="`testimonials[${i}][name]`" x-model="t.name" placeholder="Client Name">
                        <input class="rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                            :name="`testimonials[${i}][role]`" x-model="t.role" placeholder="Role">
                    </div>
                    <div class="mt-2 text-right">
                        <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/70"
                            @click="items.splice(i,1)">Remove</button>
                    </div>
                </div>
            </template>
        </div>

        {{-- FAQ --}}
        <div class="rounded-md border border-white/10 bg-white/5 p-5 mb-6"
             x-data="{ items: @js($settings->faq ?? []) }">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-white font-semibold">FAQ</h2>
                <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/80"
                    @click="items.push({q:'',a:''})">+ Add</button>
            </div>

            <template x-for="(f,i) in items" :key="i">
                <div class="rounded border border-white/10 bg-slate-950/30 p-4 mb-3">
                    <input class="w-full rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        :name="`faq[${i}][q]`" x-model="f.q" placeholder="Question">
                    <textarea class="w-full mt-3 rounded border border-white/10 bg-slate-950/40 p-2 text-white" rows="2"
                        :name="`faq[${i}][a]`" x-model="f.a" placeholder="Answer"></textarea>
                    <div class="mt-2 text-right">
                        <button type="button" class="text-xs px-3 py-1 rounded border border-white/10 text-white/70"
                            @click="items.splice(i,1)">Remove</button>
                    </div>
                </div>
            </template>
        </div>

        {{-- CTA BOTTOM --}}
        <div class="rounded-md border border-white/10 bg-white/5 p-5 mb-6">
            <h2 class="text-white font-semibold mb-4">CTA (Bottom)</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-white/60">Title</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="cta_bottom[title]" value="{{ data_get($settings->cta_bottom,'title') }}">
                </div>
                <div>
                    <label class="text-xs text-white/60">Button Text</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="cta_bottom[button_text]" value="{{ data_get($settings->cta_bottom,'button_text') }}">
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="text-xs text-white/60">Subtitle</label>
                    <textarea class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white" rows="2"
                        name="cta_bottom[subtitle]">{{ data_get($settings->cta_bottom,'subtitle') }}</textarea>
                </div>
                <div>
                    <label class="text-xs text-white/60">Button URL</label>
                    <input class="w-full mt-1 rounded border border-white/10 bg-slate-950/40 p-2 text-white"
                        name="cta_bottom[button_url]" value="{{ data_get($settings->cta_bottom,'button_url') }}" placeholder="/contact">
                </div>
            </div>
        </div>

        <button type="submit"
            class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-6 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/30 transition">
            Save Settings
        </button>
    </form>
</div>
@endsection
