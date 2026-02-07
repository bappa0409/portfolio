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

<div class="mt-4 rounded-md glass cyber-glow p-6 relative" x-data="hpSettings()" x-init="init()" x-cloak>
    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

    {{-- Tabs --}}
    <div class="flex flex-wrap gap-2 border-b border-white/10 pb-3">
        @php
        $tabs = [
            'meta' => 'SECTION_META',
            'hero' => 'HERO',
            'services' => 'SERVICES',
            'featured_projects' => 'FEATURED_PROJECTS',
            'cta_1' => 'CTA_1',
            'why_choose' => 'WHY_CHOOSE',
            'process' => 'PROCESS',
            'tech_stack' => 'TECH_STACK',
            'stats' => 'STATS',
            'cta_2' => 'CTA_2',
            'testimonials' => 'TESTIMONIALS',
            'faq' => 'FAQ',
        ];
        @endphp

        @foreach($tabs as $k => $label)
            <button type="button"
                class="px-2 py-2 text-[11px] font-mono rounded border border-white/10"
                :class="tab==='{{ $k }}'
                    ? 'bg-emerald-400/25 text-emerald-200 border-emerald-400/30'
                    : 'bg-white/5 text-slate-300 hover:text-white'"
                @click="setTab('{{ $k }}')">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- ======================================================================
    SECTION META TAB
    ====================================================================== --}}
    <section x-show="tab==='meta'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; SECTION_META</p>
                <p class="mt-1 text-[11px] text-slate-400 font-mono">Controls headings/subheadings of fixed sections.</p>
            </div>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveMeta()" :disabled="saving.meta" x-text="saving.meta ? 'SAVING...' : 'SAVE_META'"></button>
        </div>

        @php $meta = $settings->sections_meta ?? []; @endphp
        <form id="metaForm" class="mt-4 grid md:grid-cols-2 gap-3" @submit.prevent="saveMeta()">
            @csrf

            {{-- Services meta --}}
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-3">
                    <label class="text-xs font-mono text-slate-400">SERVICES TITLE</label>
                    <input name="sections_meta[services][title]"
                        value="{{ data_get($meta,'services.title','Services') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.services.title')"></p>
                </div>

                <div class="md:col-span-9">
                    <label class="text-xs font-mono text-slate-400">SERVICES SUBTITLE</label>
                    <input name="sections_meta[services][subtitle]" value="{{ data_get($meta,'services.subtitle','') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.services.subtitle')"></p>
                </div>
            </div>

            {{-- Why choose meta --}}
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-3">
                    <label class="text-xs font-mono text-slate-400">WHY CHOOSE TITLE</label>
                    <input name="sections_meta[why_choose][title]"
                        value="{{ data_get($meta,'why_choose.title','Why Choose Me') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.why_choose.title')"></p>
                </div>

                <div class="md:col-span-9">
                    <label class="text-xs font-mono text-slate-400">WHY CHOOSE SUBTITLE</label>
                    <input name="sections_meta[why_choose][subtitle]"
                        value="{{ data_get($meta,'why_choose.subtitle','') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.why_choose.subtitle')"></p>
                </div>
            </div>

            {{-- Process meta --}}
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-3">
                    <label class="text-xs font-mono text-slate-400">PROCESS TITLE</label>
                    <input name="sections_meta[process][title]"
                        value="{{ data_get($meta,'process.title','How I Work') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.process.title')"></p>
                </div>

                <div class="md:col-span-9">
                    <label class="text-xs font-mono text-slate-400">PROCESS SUBTITLE</label>
                    <input name="sections_meta[process][subtitle]" value="{{ data_get($meta,'process.subtitle','') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.process.subtitle')"></p>
                </div>
            </div>

            {{-- Tech stack meta --}}
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-3">
                    <label class="text-xs font-mono text-slate-400">TECH STACK TITLE</label>
                    <input name="sections_meta[tech_stack][title]"
                        value="{{ data_get($meta,'tech_stack.title','Tech Stack') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.tech_stack.title')"></p>
                </div>

                <div class="md:col-span-9">
                    <label class="text-xs font-mono text-slate-400">TECH STACK SUBTITLE</label>
                    <input name="sections_meta[tech_stack][subtitle]"
                        value="{{ data_get($meta,'tech_stack.subtitle','') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.tech_stack.subtitle')"></p>
                </div>
            </div>

            {{-- Testimonials meta --}}
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-3">
                    <label class="text-xs font-mono text-slate-400">TESTIMONIALS TITLE</label>
                    <input name="sections_meta[testimonials][title]"
                        value="{{ data_get($meta,'testimonials.title','Testimonials') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.testimonials.title')"></p>
                </div>

                <div class="md:col-span-9">
                    <label class="text-xs font-mono text-slate-400">TESTIMONIALS SUBTITLE</label>
                    <input name="sections_meta[testimonials][subtitle]"
                        value="{{ data_get($meta,'testimonials.subtitle','') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.testimonials.subtitle')"></p>
                </div>
            </div>

            {{-- FAQ meta --}}
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-3">
                    <label class="text-xs font-mono text-slate-400">FAQ TITLE</label>
                    <input name="sections_meta[faq][title]" value="{{ data_get($meta,'faq.title','FAQ') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.faq.title')"></p>
                </div>

                <div class="md:col-span-9">
                    <label class="text-xs font-mono text-slate-400">FAQ SUBTITLE</label>
                    <input name="sections_meta[faq][subtitle]" value="{{ data_get($meta,'faq.subtitle','') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.faq.subtitle')"></p>
                </div>
            </div>

            {{-- Projects meta --}}
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-3">
                    <label class="text-xs font-mono text-slate-400">PROJECTS TITLE</label>
                    <input name="sections_meta[projects][title]"
                        value="{{ data_get($meta,'projects.title','Projects') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.projects.title')"></p>
                </div>

                <div class="md:col-span-9">
                    <label class="text-xs font-mono text-slate-400">PROJECTS SUBTITLE</label>
                    <input name="sections_meta[projects][subtitle]"
                        value="{{ data_get($meta,'projects.subtitle','') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.projects.subtitle')"></p>
                </div>
            </div>

            {{-- Featured projects meta --}}
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-3">
                    <label class="text-xs font-mono text-slate-400">FEATURED PROJECTS TITLE</label>
                    <input name="sections_meta[featured_projects][title]"
                        value="{{ data_get($meta,'featured_projects.title','Featured Projects') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.featured_projects.title')"></p>
                </div>

                <div class="md:col-span-9">
                    <label class="text-xs font-mono text-slate-400">FEATURED PROJECTS SUBTITLE</label>
                    <input name="sections_meta[featured_projects][subtitle]"
                        value="{{ data_get($meta,'featured_projects.subtitle','') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('sections_meta.featured_projects.subtitle')"></p>
                </div>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    HERO TAB
    ====================================================================== --}}
    <section x-show="tab==='hero'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; HERO</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveHero()" :disabled="saving.hero" x-text="saving.hero ? 'SAVING...' : 'SAVE_HERO'"></button>
        </div>

        <form id="heroForm" class="mt-4 grid md:grid-cols-2 gap-3" enctype="multipart/form-data" @submit.prevent="saveHero()">
            @csrf

            <!-- ===== HERO BASIC INFO ===== -->
            <div class="md:col-span-2">
                <p class="mb-2 text-xs font-mono text-slate-400">HERO BASIC INFO</p>

                <div class="rounded-md border border-white/10 bg-slate-950/30 p-4">

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                        <div class="md:col-span-3">
                            <label class="text-xs font-mono text-slate-400">KICKER</label>
                            <input name="hero[kicker]" value="{{ data_get($settings->hero,'kicker') }}"
                                class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                            <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('hero.kicker')"></p>
                        </div>

                        <div class="md:col-span-9">
                            <label class="text-xs font-mono text-slate-400">HEADLINE</label>
                            <input name="hero[headline]" value="{{ data_get($settings->hero,'headline') }}"
                                class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                            <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('hero.headline')"></p>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-mono text-slate-400">DESCRIPTION</label>
                        <textarea name="hero[description]" rows="3"
                            class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ data_get($settings->hero,'description') }}</textarea>
                        <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('hero.description')"></p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                        <div class="md:col-span-2">
                            <label class="text-xs font-mono text-slate-400">ACTIVATE TITLE</label>
                            <input name="hero[activate_title]" value="{{ data_get($settings->hero,'activate_title') }}"
                                class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                            <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('hero.activate_title')"></p>
                        </div>

                        <div class="md:col-span-4">
                            <label class="text-xs font-mono text-slate-400">ACTIVATE SUBTITLE</label>
                            <input name="hero[activate_subtitle]" value="{{ data_get($settings->hero,'activate_subtitle') }}"
                                class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                            <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('hero.activate_subtitle')"></p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-xs font-mono text-slate-400">STATUS LABEL</label>
                            <input name="hero[status][label]" value="{{ data_get($settings->hero,'status.label','Status') }}"
                                class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                            <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('hero.status.label')"></p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-xs font-mono text-slate-400">STATUS VALUE</label>
                            <input name="hero[status][value]" value="{{ data_get($settings->hero,'status.value','Freelance') }}"
                                class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                            <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('hero.status.value')"></p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-xs font-mono text-slate-400">BADGE TEXT</label>
                            <input name="hero[status][badge]" value="{{ data_get($settings->hero,'status.badge','Open') }}"
                                class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                            <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('hero.status.badge')"></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- HERO BUTTONS --}}
            <div class="md:col-span-2" x-data="{ buttons: @js(data_get($settings->hero,'buttons', [])) }">
                <p class="mb-2 text-xs font-mono text-slate-400">HERO BUTTONS</p>

                <div class="mt-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                        <template x-for="(b,i) in buttons" :key="i">
                            <div class="md:col-span-4">
                                <label class="text-[11px] font-mono text-slate-400">
                                    BUTTON LABEL <span class="text-slate-500" x-text="`#${i+1}`"></span>
                                </label>

                                <input class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                    :name="`hero[buttons][${i}][text]`"
                                    x-model="b.text"
                                    placeholder="Button label">

                                {{-- ✅ fix: nested scope --}}
                                <p class="mt-1 text-[11px] text-red-300 font-mono"
                                    x-text="$root.err(`hero.buttons.${i}.text`)"></p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- HERO TAGS --}}
            <div class="md:col-span-2" x-data="tagInput({
                initial: @js(data_get($settings->hero,'tags', [])),
                namePrefix: 'hero[tags]',
                placeholder: 'Write here..'
            })">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-mono text-slate-400">HERO TAGS</p>
                </div>

                <div class="mt-2 flex flex-wrap items-center gap-2 rounded-md border border-white/10 bg-slate-950/30 p-3">
                    <template x-for="(t,i) in tags" :key="t + '-' + i">
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-2 py-1 text-[11px] border border-white/10 text-white">
                            <span class="max-w-[180px] truncate" x-text="t"></span>

                            <button type="button" class="text-slate-300 hover:text-red-300" @click="remove(i)">×</button>

                            <input type="hidden" :name="`${namePrefix}[${i}]`" :value="t">
                        </span>
                    </template>

                    <input type="text" x-ref="input" x-model="q" @keydown.enter.prevent="add()"
                        :placeholder="placeholder"
                        class="flex-1 min-w-[140px] bg-transparent text-white outline-none border-0 focus:ring-0 text-sm placeholder:text-slate-500" />
                </div>

                {{-- ✅ fix: nested scope --}}
                <p class="mt-1 text-[11px] text-red-300 font-mono"
                    x-show="error || $root.err('hero.tags')"
                    x-text="error || $root.err('hero.tags')"></p>
            </div>

            {{-- HERO MINI STATS --}}
            <div class="md:col-span-2" x-data="{
                minis: (() => {
                    const existing = @js(data_get($settings->hero,'mini_stats', []));
                    const fixed = [];
                    for (let i = 0; i < 4; i++) {
                        fixed.push({
                            value: existing[i]?.value ?? '',
                            label: existing[i]?.label ?? ''
                        });
                    }
                    return fixed;
                })()
            }">
                <p class="text-xs font-mono text-slate-400 mb-2">HERO MINI STATS</p>

                <div class="mt-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                    <div class="grid md:grid-cols-2 gap-3">
                        <template x-for="(m,i) in minis" :key="i">
                            <div>
                                <p class="mb-2 text-[11px] text-slate-500 font-mono">
                                    STAT <span x-text="i + 1"></span>
                                </p>

                                <div class="grid grid-cols-2 gap-3">
                                    <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                        :name="`hero[mini_stats][${i}][value]`" x-model="m.value" placeholder="20+">

                                    <input class="rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                        :name="`hero[mini_stats][${i}][label]`" x-model="m.label" placeholder="Projects">
                                </div>

                                {{-- ✅ fix: nested scope --}}
                                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="$root.err(`hero.mini_stats.${i}.value`)"></p>
                                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="$root.err(`hero.mini_stats.${i}.label`)"></p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- HERO IMAGE --}}
            <div class="md:col-span-2 grid md:grid-cols-12 gap-4 items-start">

                {{-- LEFT : UPLOAD + PREVIEW --}}
                <div class="md:col-span-9">
                    <label class="text-xs font-mono text-slate-400">PROFILE IMAGE</label>

                    <label for="hero_profile_image"
                        class="js-image-upload mt-2 block rounded-md border border-dashed border-white/15 bg-slate-950/30 hover:border-emerald-400/30 transition p-4 cursor-pointer relative overflow-hidden"
                        data-preview="#heroImagePreview">

                        <div class="absolute inset-0 scanline opacity-30 pointer-events-none"></div>

                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-md border border-white/10 bg-white/5 flex items-center justify-center text-white/70">
                                    ⧉
                                </div>
                                <div>
                                    <p class="text-sm text-white/85 font-semibold">Drag & Drop image</p>
                                    <p class="text-[11px] text-slate-400 font-mono">
                                        or click to upload (only one)
                                    </p>
                                </div>
                            </div>

                            <span
                                class="text-[10px] px-2 py-1 rounded bg-emerald-400/15 text-emerald-200 border border-emerald-400/20">
                                HERO
                            </span>
                        </div>

                        <input id="hero_profile_image"
                            type="file"
                            name="hero_profile_image"
                            accept="image/*"
                            class="hidden">
                    </label>

                    {{-- PREVIEW --}}
                    <div id="heroImagePreview"
                        class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 hidden">
                        <div class="relative rounded-md border border-white/10 bg-white/5 overflow-hidden">
                            <img data-preview-img
                                src=""
                                class="w-full h-24 object-cover"
                                alt="Hero preview">
                            <div class="absolute inset-0 bg-black/20 pointer-events-none"></div>
                            <div data-preview-cap
                                class="px-2 py-1 text-[10px] font-mono text-slate-300 truncate"></div>
                        </div>
                    </div>

                    {{-- ERROR --}}
                    <p class="mt-1 text-[11px] text-red-300 font-mono"
                    x-text="err('hero_profile_image')"></p>
                </div>

                {{-- RIGHT : CURRENT IMAGE --}}
                <div class="md:col-span-3 flex flex-col items-center">
                    @if(data_get($settings->hero,'profile_image'))
                        <p class="mb-2 text-[11px] text-slate-500 font-mono">CURRENT IMAGE</p>
                        <img
                            src="{{ asset('storage/'.data_get($settings->hero,'profile_image')) }}"
                            alt="Current hero image"
                            class="h-28 w-28 rounded-md object-cover border border-white/10 shadow-md">
                    @else
                        <div
                            class="h-28 w-28 rounded-md flex items-center justify-center
                                border border-white/10 bg-white/5 text-slate-500
                                text-xs font-mono">
                            NO IMAGE
                        </div>
                    @endif
                </div>

            </div>
        </form>
    </section>

    {{-- ======================================================================
    SERVICES TAB
    ====================================================================== --}}
    <section x-show="tab==='services'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; SERVICES</p>
            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveServices()" :disabled="saving.services"
                x-text="saving.services ? 'SAVING...' : 'SAVE_SERVICES'"></button>
        </div>

        <form id="servicesForm" class="mt-4 gap-3" @submit.prevent="saveServices()">
            @csrf

            <div x-data="{ items: @js($settings->services ?? []) }">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-mono text-slate-400">SERVICES LIST</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({icon:'',title:'',desc:''})">+ ADD_SERVICE</button>
                </div>

                <template x-for="(srv,i) in items" :key="i">
                    <div class="mt-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                            <div class="md:col-span-4">
                                <label class="text-xs font-mono text-slate-400">ICON & TITLE</label>

                                <input class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                    :name="`services[${i}][icon]`" x-model="srv.icon" placeholder="🧩">

                                <input class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                    :name="`services[${i}][title]`" x-model="srv.title" placeholder="Service title">

                                {{-- ✅ fix: nested scope --}}
                                <p class="mt-1 text-[11px] text-red-300 font-mono"
                                    x-text="$root.err(`services.${i}.title`)"></p>
                            </div>

                            <div class="md:col-span-8">
                                <label class="text-xs font-mono text-slate-400">DESCRIPTION</label>
                                <textarea class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                    rows="3" :name="`services[${i}][desc]`" x-model="srv.desc" placeholder="Service description"></textarea>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="items.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    FEATURED PROJECTS TAB
    ====================================================================== --}}
    <section x-show="tab==='featured_projects'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; FEATURED_PROJECTS</p>
            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveFeaturedProjects()" :disabled="saving.featured_projects"
                x-text="saving.featured_projects ? 'SAVING...' : 'SAVE_FEATURED'"></button>
        </div>

        <form id="featuredProjectsForm" class="mt-4 grid md:grid-cols-2 gap-3" @submit.prevent="saveFeaturedProjects()">
            @csrf
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-6">
                    <label class="text-xs font-mono text-slate-400">LIMIT</label>
                    <input type="number" min="1" max="24" name="featured_projects[limit]"
                        value="{{ data_get($settings->featured_projects,'limit',6) }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('featured_projects.limit')"></p>
                </div>

                <div class="md:col-span-6">
                    <label class="text-xs font-mono text-slate-400">BUTTON TEXT</label>
                    <input name="featured_projects[button_text]"
                        value="{{ data_get($settings->featured_projects,'button_text','See all') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('featured_projects.button_text')"></p>
                </div>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    CTA 1 TAB
    ====================================================================== --}}
    <section x-show="tab==='cta_1'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; CTA_1</p>
            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveCtaTop()" :disabled="saving.cta_1"
                x-text="saving.cta_1 ? 'SAVING...' : 'SAVE_CTA_1'"></button>
        </div>

        <form id="ctaTopForm" class="mt-4 grid md:grid-cols-2 gap-3" @submit.prevent="saveCtaTop()">
            @csrf

            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-8">
                    <label class="text-xs font-mono text-slate-400">TITLE</label>
                    <input name="cta_1[title]" value="{{ data_get($settings->cta_1,'title') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('cta_1.title')"></p>
                </div>

                <div class="md:col-span-4">
                    <label class="text-xs font-mono text-slate-400">BUTTON TEXT</label>
                    <input name="cta_1[button_text]" value="{{ data_get($settings->cta_1,'button_text') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('cta_1.button_text')"></p>
                </div>
            </div>

            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-12">
                    <label class="text-xs font-mono text-slate-400">SUBTITLE</label>
                    <textarea name="cta_1[subtitle]" rows="2"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ data_get($settings->cta_1,'subtitle') }}</textarea>
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('cta_1.subtitle')"></p>
                </div>
            </div>
        </form>
    </section>

   {{-- ======================================================================
    WHY CHOOSE TAB (STATS STYLE)
    ====================================================================== --}}
    <section x-show="tab==='why_choose'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; WHY_CHOOSE_ME</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveWhyChoose()" :disabled="saving.why_choose"
                x-text="saving.why_choose ? 'SAVING...' : 'SAVE_WHY_CHOOSE'">
            </button>
        </div>

        <form id="whyChooseForm" class="mt-4" @submit.prevent="saveWhyChoose()">
            @csrf

            <div x-data="{ items: @js($settings->why_choose_me ?? []) }"
                class="rounded-md border border-white/10 bg-slate-950/30 p-4">

                {{-- Header --}}
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">WHY CHOOSE ITEMS</p>

                    <button type="button"
                        class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({ icon:'', title:'', desc:'' })">
                        + ADD_ITEM
                    </button>
                </div>

                {{-- Column labels --}}
                <div class="hidden md:grid md:grid-cols-12 gap-3 mb-2">
                    <p class="md:col-span-1 text-[11px] font-mono text-slate-500">ICON</p>
                    <p class="md:col-span-2 text-[11px] font-mono text-slate-500">TITLE</p>
                    <p class="md:col-span-8 text-[11px] font-mono text-slate-500">DESCRIPTION</p>
                    <span class="md:col-span-1"></span>
                </div>

                {{-- Rows (STATS STYLE) --}}
                <template x-for="(w,i) in items" :key="i">
                    <div class="mb-3 grid grid-cols-1 md:grid-cols-12 gap-3 items-start">

                        {{-- ICON --}}
                        <input
                            class="md:col-span-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`why_choose_me[${i}][icon]`"
                            x-model="w.icon"
                            placeholder="🔒">

                        {{-- TITLE --}}
                        <input
                            class="md:col-span-2 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`why_choose_me[${i}][title]`"
                            x-model="w.title"
                            placeholder="Fast & Secure">

                        {{-- DESCRIPTION --}}
                        <textarea rows="1"
                            class="md:col-span-8 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`why_choose_me[${i}][desc]`"
                            x-model="w.desc"
                            placeholder="Short description"></textarea>

                        {{-- REMOVE --}}
                        <div class="md:col-span-1 flex md:justify-center md:pt-2">
                            <button type="button"
                                class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="items.splice(i,1)">
                                REMOVE
                            </button>
                        </div>
                    </div>
                </template>

                {{-- Validation errors (Stats style) --}}
                <template x-for="(w,i) in items" :key="'err-'+i">
                    <div class="mb-2">
                        <p class="text-[11px] text-red-300 font-mono"
                            x-text="$root.err(`why_choose_me.${i}.icon`)"></p>
                        <p class="text-[11px] text-red-300 font-mono"
                            x-text="$root.err(`why_choose_me.${i}.title`)"></p>
                        <p class="text-[11px] text-red-300 font-mono"
                            x-text="$root.err(`why_choose_me.${i}.desc`)"></p>
                    </div>
                </template>

            </div>
        </form>
    </section>


    {{-- ======================================================================
    PROCESS TAB 
    ====================================================================== --}}
    <section x-show="tab==='process'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PROCESS</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveProcess()" :disabled="saving.process"
                x-text="saving.process ? 'SAVING...' : 'SAVE_PROCESS'">
            </button>
        </div>

        <form id="processForm" class="mt-4" @submit.prevent="saveProcess()">
            @csrf

            <div x-data="{ items: @js($settings->process ?? []) }"
                class="rounded-md border border-white/10 bg-slate-950/30 p-4">

                {{-- Header --}}
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">PROCESS STEPS</p>

                    <button type="button"
                        class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({ step:'', title:'', desc:'' })">
                        + ADD_STEP
                    </button>
                </div>

                {{-- Rows (STATS STYLE | GRID BASED) --}}
                <template x-for="(p,i) in items" :key="i">
                    <div class="mb-3 grid grid-cols-1 md:grid-cols-12 gap-3 items-start">

                        {{-- step --}}
                        <input
                            class="md:col-span-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`process[${i}][step]`"
                            x-model="p.step"
                            placeholder="1">

                        {{-- title --}}
                        <input
                            class="md:col-span-2 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`process[${i}][title]`"
                            x-model="p.title"
                            placeholder="Title">

                        {{-- desc --}}
                        <textarea rows="1"
                            class="md:col-span-8 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`process[${i}][desc]`"
                            x-model="p.desc"
                            placeholder="Description"></textarea>

                        {{-- remove --}}
                        <div class="md:col-span-1 flex md:justify-center md:pt-2">
                            <button type="button"
                                class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="items.splice(i,1)">
                                REMOVE
                            </button>
                        </div>
                    </div>
                </template>

                {{-- Validation errors (optional | same as stats) --}}
                <template x-for="(p,i) in items" :key="'err-'+i">
                    <div class="mb-2">
                        {{-- ✅ nested scope, so use $root.err --}}
                        <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`process.${i}.step`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`process.${i}.title`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`process.${i}.desc`)"></p>
                    </div>
                </template>

            </div>
        </form>
    </section>

    {{-- ======================================================================
    TECH STACK TAB
    ====================================================================== --}}
    <section x-show="tab==='tech_stack'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; TECH_STACK</p>
                <p class="mt-1 text-[11px] text-slate-400 font-mono">Add items as tags for each category.</p>
            </div>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveTechStack()" :disabled="saving.tech_stack"
                x-text="saving.tech_stack ? 'SAVING...' : 'SAVE_TECH_STACK'"></button>
        </div>

        @php $ts = $settings->tech_stack ?? []; @endphp

        <form id="techStackForm" class="mt-4" @submit.prevent="saveTechStack()">
            @csrf

            <div class="grid md:grid-cols-2 gap-5">

                {{-- BACKEND --}}
                <div x-data="window.tagInput({
                        initial: @js(data_get($ts,'backend', [])),
                        namePrefix: 'tech_stack[backend]',
                        placeholder: 'Write here..'
                    })"
                    class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-mono text-slate-400">BACKEND</p>
                    </div>

                    <div class="mt-2 flex flex-wrap items-center gap-2 rounded-md border border-white/10 bg-slate-950/30 p-3">
                        <template x-for="(t,i) in tags" :key="t + '-' + i">
                            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-2 py-1 text-[11px] border border-white/10 text-white">
                                <span class="max-w-[180px] truncate" x-text="t"></span>
                                <button type="button" class="text-slate-300 hover:text-red-300" @click="remove(i)">×</button>
                                <input type="hidden" :name="`${namePrefix}[${i}]`" :value="t">
                            </span>
                        </template>

                        <input type="text" x-ref="input" x-model="q" @keydown.enter.prevent="add()"
                            :placeholder="placeholder"
                            class="flex-1 min-w-[140px] bg-transparent text-white outline-none border-0 focus:ring-0 text-sm placeholder:text-slate-500" />
                    </div>

                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-show="error" x-text="error"></p>
                </div>

                {{-- FRONTEND --}}
                <div x-data="window.tagInput({
                        initial: @js(data_get($ts,'frontend', [])),
                        namePrefix: 'tech_stack[frontend]',
                        placeholder: 'Write here..'
                    })"
                    class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-mono text-slate-400">FRONTEND</p>
                    </div>

                    <div class="mt-2 flex flex-wrap items-center gap-2 rounded-md border border-white/10 bg-slate-950/30 p-3">
                        <template x-for="(t,i) in tags" :key="t + '-' + i">
                            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-2 py-1 text-[11px] border border-white/10 text-white">
                                <span class="max-w-[180px] truncate" x-text="t"></span>
                                <button type="button" class="text-slate-300 hover:text-red-300" @click="remove(i)">×</button>
                                <input type="hidden" :name="`${namePrefix}[${i}]`" :value="t">
                            </span>
                        </template>

                        <input type="text" x-ref="input" x-model="q" @keydown.enter.prevent="add()"
                            :placeholder="placeholder"
                            class="flex-1 min-w-[140px] bg-transparent text-white outline-none border-0 focus:ring-0 text-sm placeholder:text-slate-500" />
                    </div>

                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-show="error" x-text="error"></p>
                </div>

                {{-- WORDPRESS --}}
                <div x-data="window.tagInput({
                        initial: @js(data_get($ts,'wordpress', [])),
                        namePrefix: 'tech_stack[wordpress]',
                        placeholder: 'Write here..'
                    })"
                    class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-mono text-slate-400">WORDPRESS</p>
                    </div>

                    <div class="mt-2 flex flex-wrap items-center gap-2 rounded-md border border-white/10 bg-slate-950/30 p-3">
                        <template x-for="(t,i) in tags" :key="t + '-' + i">
                            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-2 py-1 text-[11px] border border-white/10 text-white">
                                <span class="max-w-[180px] truncate" x-text="t"></span>
                                <button type="button" class="text-slate-300 hover:text-red-300" @click="remove(i)">×</button>
                                <input type="hidden" :name="`${namePrefix}[${i}]`" :value="t">
                            </span>
                        </template>

                        <input type="text" x-ref="input" x-model="q" @keydown.enter.prevent="add()"
                            :placeholder="placeholder"
                            class="flex-1 min-w-[140px] bg-transparent text-white outline-none border-0 focus:ring-0 text-sm placeholder:text-slate-500" />
                    </div>

                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-show="error" x-text="error"></p>
                </div>

                {{-- TOOLS --}}
                <div x-data="window.tagInput({
                        initial: @js(data_get($ts,'tools', [])),
                        namePrefix: 'tech_stack[tools]',
                        placeholder: 'Write here..'
                    })"
                    class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-mono text-slate-400">TOOLS</p>
                    </div>

                    <div class="mt-2 flex flex-wrap items-center gap-2 rounded-md border border-white/10 bg-slate-950/30 p-3">
                        <template x-for="(t,i) in tags" :key="t + '-' + i">
                            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-2 py-1 text-[11px] border border-white/10 text-white">
                                <span class="max-w-[180px] truncate" x-text="t"></span>
                                <button type="button" class="text-slate-300 hover:text-red-300" @click="remove(i)">×</button>
                                <input type="hidden" :name="`${namePrefix}[${i}]`" :value="t">
                            </span>
                        </template>

                        <input type="text" x-ref="input" x-model="q" @keydown.enter.prevent="add()"
                            :placeholder="placeholder"
                            class="flex-1 min-w-[140px] bg-transparent text-white outline-none border-0 focus:ring-0 text-sm placeholder:text-slate-500" />
                    </div>

                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-show="error" x-text="error"></p>
                </div>

                {{-- SQA (FULL WIDTH) --}}
                <div class="md:col-span-2"
                    x-data="window.tagInput({
                        initial: @js(data_get($ts,'sqa', [])),
                        namePrefix: 'tech_stack[sqa]',
                        placeholder: 'Write here..'
                    })">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-mono text-slate-400">SQA</p>
                    </div>

                    <div class="mt-2 flex flex-wrap items-center gap-2 rounded-md border border-white/10 bg-slate-950/30 p-3">
                        <template x-for="(t,i) in tags" :key="t + '-' + i">
                            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-2 py-1 text-[11px] border border-white/10 text-white">
                                <span class="max-w-[180px] truncate" x-text="t"></span>
                                <button type="button" class="text-slate-300 hover:text-red-300" @click="remove(i)">×</button>
                                <input type="hidden" :name="`${namePrefix}[${i}]`" :value="t">
                            </span>
                        </template>

                        <input type="text" x-ref="input" x-model="q" @keydown.enter.prevent="add()"
                            :placeholder="placeholder"
                            class="flex-1 min-w-[140px] bg-transparent text-white outline-none border-0 focus:ring-0 text-sm placeholder:text-slate-500" />
                    </div>

                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-show="error" x-text="error"></p>
                </div>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    STATS TAB
    ====================================================================== --}}
    <section x-show="tab==='stats'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; STATS</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveStats()" :disabled="saving.stats"
                x-text="saving.stats ? 'SAVING...' : 'SAVE_STATS'">
            </button>
        </div>

        <form id="statsForm" class="mt-4" @submit.prevent="saveStats()">
            @csrf

            <div x-data="{ items: @js($settings->stats ?? []) }" class="rounded-md border border-white/10 bg-slate-950/30 p-4">

                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">STATS ITEMS</p>

                    <button type="button"
                        class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({ value: 0, suffix: '', label: '' })">
                        + ADD_STAT
                    </button>
                </div>

                <template x-for="(s,i) in items" :key="i">
                    <div class="mb-3 flex flex-wrap md:flex-nowrap items-center gap-3">
                        <input type="number"
                            class="w-full md:w-28 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`stats[${i}][value]`" x-model.number="s.value" placeholder="20">

                        <input class="w-full md:w-20 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`stats[${i}][suffix]`" x-model="s.suffix" placeholder="+">

                        <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`stats[${i}][label]`" x-model="s.label" placeholder="Projects Completed">

                        <button type="button"
                            class="shrink-0 text-[11px] font-mono text-red-300 hover:text-red-200"
                            @click="items.splice(i,1)">
                            REMOVE
                        </button>
                    </div>
                </template>

                <template x-for="(s,i) in items" :key="'err-'+i">
                    <div class="mb-2">
                        <p class="text-[11px] text-red-300 font-mono" x-text="err(`stats.${i}.value`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="err(`stats.${i}.label`)"></p>
                    </div>
                </template>

            </div>
        </form>
    </section>

    {{-- ======================================================================
    CTA 2 TAB
    ====================================================================== --}}
    <section x-show="tab==='cta_2'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; CTA_2</p>
            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveCtaBottom()" :disabled="saving.cta_2"
                x-text="saving.cta_2 ? 'SAVING...' : 'SAVE_CTA_2'"></button>
        </div>

        <form id="ctaBottomForm" class="mt-4 grid md:grid-cols-2 gap-3" @submit.prevent="saveCtaBottom()">
            @csrf

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">TITLE</label>
                <input name="cta_2[title]" value="{{ data_get($settings->cta_2,'title') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('cta_2.title')"></p>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">SUBTITLE</label>
                <textarea name="cta_2[subtitle]" rows="2"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ data_get($settings->cta_2,'subtitle') }}</textarea>
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('cta_2.subtitle')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">BUTTON TEXT 1</label>
                <input name="cta_2[button_text_1]" value="{{ data_get($settings->cta_2,'button_text_1') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('cta_2.button_text_1')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">BUTTON TEXT 2</label>
                <input name="cta_2[button_text_2]" value="{{ data_get($settings->cta_2,'button_text_2') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('cta_2.button_text_2')"></p>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    TESTIMONIALS TAB
    ====================================================================== --}}
    <section x-show="tab==='testimonials'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; TESTIMONIALS</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveTestimonials()" :disabled="saving.testimonials"
                x-text="saving.testimonials ? 'SAVING...' : 'SAVE_TESTIMONIALS'">
            </button>
        </div>

        <form id="testimonialsForm" class="mt-4" @submit.prevent="saveTestimonials()">
            @csrf

            <div x-data="{ items: @js($settings->testimonials ?? []) }"
                class="rounded-md border border-white/10 bg-slate-950/30 p-4">

                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">TESTIMONIALS ITEMS</p>

                    <button type="button"
                        class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({ text: '', name: '', role: '' })">
                        + ADD_TESTIMONIAL
                    </button>
                </div>

                <template x-for="(t,i) in items" :key="i">
                    <div class="mb-3 grid grid-cols-1 md:grid-cols-12 gap-3 items-start">
                        <input class="md:col-span-2 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`testimonials[${i}][name]`" x-model="t.name" placeholder="Client Name">

                        <input class="md:col-span-2 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`testimonials[${i}][role]`" x-model="t.role" placeholder="Designation (CTO)">

                        <textarea rows="1" class="md:col-span-7 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`testimonials[${i}][text]`" x-model="t.text" placeholder="Testimonial text"></textarea>

                        <div class="md:col-span-1 flex md:justify-center md:pt-2">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="items.splice(i,1)">
                                REMOVE
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    FAQ TAB
    ====================================================================== --}}
    <section x-show="tab==='faq'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; FAQ</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveFaq()" :disabled="saving.faq"
                x-text="saving.faq ? 'SAVING...' : 'SAVE_FAQ'">
            </button>
        </div>

        <form id="faqForm" class="mt-4" @submit.prevent="saveFaq()">
            @csrf

            <div x-data="{ items: @js($settings->faq ?? []) }"
                class="rounded-md border border-white/10 bg-slate-950/30 p-4">

                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">FAQ ITEMS</p>

                    <button type="button"
                        class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({ q: '', a: '' })">
                        + ADD_FAQ
                    </button>
                </div>

                <template x-for="(f,i) in items" :key="i">
                    <div class="mb-3 grid grid-cols-1 md:grid-cols-12 gap-3 items-start">
                        <input class="md:col-span-3 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`faq[${i}][q]`" x-model="f.q" placeholder="Question">

                        <textarea rows="1" class="md:col-span-8 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`faq[${i}][a]`" x-model="f.a" placeholder="Answer"></textarea>

                        <div class="md:col-span-1 flex md:justify-center md:pt-2">
                            <button type="button"
                                class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="items.splice(i,1)">
                                REMOVE
                            </button>
                        </div>
                    </div>
                </template>

                <template x-for="(f,i) in items" :key="'err-'+i">
                    <div class="mb-2">
                        <p class="text-[11px] text-red-300 font-mono" x-text="err(`faq.${i}.q`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="err(`faq.${i}.a`)"></p>
                    </div>
                </template>
            </div>
        </form>
    </section>

</div>
@endsection

@push('scripts')

<script>
function hpSettings(){
    return {
        tab: 'meta',
        saving: {
            meta:false, hero:false, services:false, featured_projects:false, cta_1:false,
            why_choose:false, process:false, tech_stack:false, stats:false, cta_2:false,
            testimonials:false, faq:false
        },
        errors: {},

        init(){
            const saved = localStorage.getItem('hp_tab');
            if(saved) this.tab = saved;
        },

        setTab(t){
            this.tab = t;
            this.errors = {};
            localStorage.setItem('hp_tab', t);
        },

        err(key){
            return (this.errors && this.errors[key]) ? this.errors[key][0] : '';
        },

        showToast(type, message){
            if (window.toast) window.toast(type, message);
        },

        async postForm(url, formId){
            this.errors = {};
            const formEl = document.getElementById(formId);
            if(!formEl) throw new Error(`Form not found: ${formId}`);

            const fd = new FormData(formEl);

            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if(token) axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

            const res = await axios.post(url, fd, { headers: { 'Content-Type': 'multipart/form-data' }});
            return res.data;
        },

        async handleSave(key, routeUrl, formId){
            if (window.validateFormAndMark && !window.validateFormAndMark(formId)) return;

            try{
                this.saving[key] = true;
                const data = await this.postForm(routeUrl, formId);
                this.showToast('success', data.message || 'Saved');
            }catch(e){
                if(e.response && e.response.status === 422){
                    this.errors = e.response.data.errors || {};
                    this.showToast('error', 'Please fix the highlighted fields.');
                }else{
                    this.showToast('error', 'Something went wrong.');
                    console.error(e);
                }
            }finally{
                this.saving[key] = false;
            }
        },

        // Save handlers
        saveMeta(){ return this.handleSave('meta', "{{ route('admin.homepage.section_meta') }}", 'metaForm'); },
        saveHero(){ return this.handleSave('hero', "{{ route('admin.homepage.hero') }}", 'heroForm'); },
        saveServices(){ return this.handleSave('services', "{{ route('admin.homepage.services') }}", 'servicesForm'); },
        saveFeaturedProjects(){ return this.handleSave('featured_projects', "{{ route('admin.homepage.featured_projects') }}", 'featuredProjectsForm'); },
        saveCtaTop(){ return this.handleSave('cta_1', "{{ route('admin.homepage.cta_1') }}", 'ctaTopForm'); },
        saveWhyChoose(){ return this.handleSave('why_choose', "{{ route('admin.homepage.why_choose') }}", 'whyChooseForm'); },
        saveProcess(){ return this.handleSave('process', "{{ route('admin.homepage.process') }}", 'processForm'); },
        saveTechStack(){ return this.handleSave('tech_stack', "{{ route('admin.homepage.tech_stack') }}", 'techStackForm'); },
        saveStats(){ return this.handleSave('stats', "{{ route('admin.homepage.stats') }}", 'statsForm'); },
        saveCtaBottom(){ return this.handleSave('cta_2', "{{ route('admin.homepage.cta_2') }}", 'ctaBottomForm'); },
        saveTestimonials(){ return this.handleSave('testimonials', "{{ route('admin.homepage.testimonials') }}", 'testimonialsForm'); },
        saveFaq(){ return this.handleSave('faq', "{{ route('admin.homepage.faq') }}", 'faqForm'); },
    }
}
</script>
@endpush
