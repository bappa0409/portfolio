@extends('layouts.app')
@section('title', 'Admin | About Settings')
@section('breadcrumb', 'Website / About Settings')

@section('content')
<div class="flex items-start justify-between gap-4">
    <div>
        <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; ABOUT_CONTROL</p>
        <h1 class="mt-2 text-2xl font-extrabold text-white cyber-text tracking-wide">ABOUT_SETTINGS</h1>
        <p class="mt-2 text-sm text-slate-300">Manage About page fixed sections content from here.</p>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="text-xs font-mono text-emerald-200 hover:text-emerald-100">← Back</a>
</div>

<div class="mt-4 rounded-md glass cyber-glow p-6 relative" x-data="aboutSettings()" x-init="init()" x-cloak>
    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

    {{-- Tabs --}}
    <div class="flex flex-wrap gap-2 border-b border-white/10 pb-3">
        @php
            $tabs = [
                'header' => 'PAGE_META',
                'terminal' => 'TERMINAL',
                'tags' => 'TAGS',
                'profile' => 'PROFILE',
                'journey' => 'JOURNEY',
                'education' => 'EDUCATION',
                'training' => 'TRAINING',
                'experience' => 'EXPERIENCE',
                'skills' => 'SKILLS',
                'philosophy' => 'PHILOSOPHY',
                'passions' => 'PASSIONS',
                'footer_section' => 'FOOTER_SECTION',
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

    @php
        $header = $settings->header ?? [];
        $terminal = $settings->terminal ?? [];
        $tags = $settings->tags ?? [];
        $profile = $settings->profile ?? [];
        $education = $settings->education ?? [];
        $training = $settings->training ?? [];
        $experience = $settings->experience ?? [];
        $skills = $settings->skills ?? [];
        $philosophy = $settings->philosophy ?? [];
        $passions = $settings->passions ?? [];
        $final = $settings->final_cta ?? [];
        $footer = $settings->footer ?? [];
    @endphp

    {{-- ======================================================================
    HEADER
    ====================================================================== --}}
    <section x-show="tab==='header'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; HEADER</p>
            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveHeader()" :disabled="saving.header" x-text="saving.header ? 'SAVING...' : 'SAVE_HEADER'"></button>
        </div>

        <form id="headerForm" class="mt-4 grid md:grid-cols-2 gap-3" @submit.prevent="saveHeader()">
            @csrf
            <div>
                <label class="text-xs font-mono text-slate-400">KICKER</label>
                <input name="header[kicker]" value="{{ data_get($header,'kicker') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('header.kicker')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">TITLE</label>
                <input name="header[title]" value="{{ data_get($header,'title') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('header.title')"></p>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">SUBTITLE</label>
                <input name="header[subtitle]" value="{{ data_get($header,'subtitle') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('header.subtitle')"></p>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    TERMINAL
    ====================================================================== --}}
    <section x-show="tab==='terminal'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; TERMINAL</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveTerminal()" :disabled="saving.terminal" x-text="saving.terminal ? 'SAVING...' : 'SAVE_TERMINAL'"></button>
        </div>

        <form id="terminalForm" class="mt-4" @submit.prevent="saveTerminal()">
            @csrf

            <div class="rounded-md border border-white/10 bg-slate-950/30 p-4 space-y-4">
                <div>
                    <label class="text-xs font-mono text-slate-400">WHOAMI</label>
                    <input name="terminal[whoami]" value="{{ data_get($terminal,'whoami') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('terminal.whoami')"></p>
                </div>

                <div x-data="window.tagInput({
                    initial: @js(data_get($terminal,'stack', [])),
                    namePrefix: 'terminal[stack]',
                    placeholder: 'Add stack item..'
                })">
                    <label class="text-xs font-mono text-slate-400">STACK (TAGS)</label>

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

                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-show="error || $root.err('terminal.stack')"
                        x-text="error || $root.err('terminal.stack')"></p>
                </div>

                <div>
                    <label class="text-xs font-mono text-slate-400">CURRENT ROLE</label>
                    <textarea name="terminal[current_role]" rows="2"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ data_get($terminal,'current_role') }}</textarea>
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('terminal.current_role')"></p>
                </div>

                <div x-data="{ items: @js(data_get($terminal,'projects', [])) }">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-mono text-slate-400">TOP PROJECTS</label>
                        <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                            @click="items.push('')">+ ADD_PROJECT</button>
                    </div>

                    <template x-for="(p,i) in items" :key="i">
                        <div class="mt-2 flex gap-2">
                            <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                :name="`terminal[projects][${i}]`" x-model="items[i]" placeholder="Project title">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="items.splice(i,1)">REMOVE</button>
                        </div>
                    </template>

                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('terminal.projects')"></p>
                </div>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    TAGS
    ====================================================================== --}}
    <section x-show="tab==='tags'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; TAGS</p>
                <p class="mt-1 text-[11px] text-slate-400 font-mono">These are chip tags shown under terminal.</p>
            </div>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveTags()" :disabled="saving.tags" x-text="saving.tags ? 'SAVING...' : 'SAVE_TAGS'"></button>
        </div>

        <form id="tagsForm" class="mt-4" @submit.prevent="saveTags()">
            @csrf

            <div x-data="window.tagInput({
                initial: @js($tags),
                namePrefix: 'tags',
                placeholder: 'Add tag..'
            })"
            class="rounded-md border border-white/10 bg-slate-950/30 p-4">

                <div class="mt-2 flex flex-wrap items-center gap-2 rounded-md border border-white/10 bg-slate-950/30 p-3">
                    <template x-for="(t,i) in tags" :key="t + '-' + i">
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-2 py-1 text-[11px] border border-white/10 text-white">
                            <span class="max-w-[180px] truncate" x-text="t"></span>
                            <button type="button" class="text-slate-300 hover:text-red-300" @click="remove(i)">×</button>
                            <input type="hidden" :name="`tags[${i}]`" :value="t">
                        </span>
                    </template>

                    <input type="text" x-ref="input" x-model="q" @keydown.enter.prevent="add()"
                        :placeholder="placeholder"
                        class="flex-1 min-w-[140px] bg-transparent text-white outline-none border-0 focus:ring-0 text-sm placeholder:text-slate-500" />
                </div>

                <p class="mt-1 text-[11px] text-red-300 font-mono"
                    x-show="error || $root.err('tags')"
                    x-text="error || $root.err('tags')"></p>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    PROFILE
    ====================================================================== --}}
    <section x-show="tab==='profile'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PROFILE</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveProfile()" :disabled="saving.profile" x-text="saving.profile ? 'SAVING...' : 'SAVE_PROFILE'"></button>
        </div>

      
        <form id="profileForm" class="mt-4 grid md:grid-cols-2 gap-3" enctype="multipart/form-data" @submit.prevent="saveProfile()">

            <div>
                <label class="text-xs font-mono text-slate-400">NAME</label>
                <input name="profile[name]" value="{{ data_get($profile,'name') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('profile.name')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">TITLE</label>
                <input name="profile[title]" value="{{ data_get($profile,'title') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('profile.title')"></p>
            </div>

            <div class="md:col-span-2 rounded-md border border-white/10 bg-slate-950/30 p-4">
                <p class="text-xs font-mono text-slate-400 mb-2">STATUS BLOCK</p>

                <div class="grid md:grid-cols-3 gap-3">
                    <div>
                        <label class="text-xs font-mono text-slate-400">AVAILABLE</label>
                        <input name="profile[status][available]" value="{{ data_get($profile,'status.available') }}"
                            class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                        <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('profile.status.available')"></p>
                    </div>

                    <div>
                        <label class="text-xs font-mono text-slate-400">RESPONSE</label>
                        <input name="profile[status][response]" value="{{ data_get($profile,'status.response') }}"
                            class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                        <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('profile.status.response')"></p>
                    </div>

                    <div>
                        <label class="text-xs font-mono text-slate-400">COLLAB</label>
                        <input name="profile[status][collab]" value="{{ data_get($profile,'status.collab') }}"
                            class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                        <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('profile.status.collab')"></p>
                    </div>
                </div>
            </div>
            
            {{-- CV UPLOAD (PDF ONLY)  --}}
            <div class="md:col-span-2"
                x-data="cvUploader({
                    inputId: 'about_cv_file',
                    maxMB: 5,
                    existingUrl: @js(
                        data_get($settings,'profile.cv.path')
                            ? asset('storage/'.data_get($settings,'profile.cv.path'))
                            : ''
                    ),
                    existingName: @js(data_get($settings,'profile.cv.original_name') ?? ''),
                })">

                <label class="text-xs font-mono text-slate-400">CV (PDF)</label>

                <!-- SINGLE BLOCK -->
                <div class="mt-2 rounded-md border border-dashed border-white/15 bg-slate-950/30
                            hover:border-emerald-400/30 transition relative overflow-hidden">
                    <div class="absolute inset-0 scanline opacity-30 pointer-events-none"></div>

                    <!-- two columns inside one block -->
                    <div class="grid md:grid-cols-12">
                        <!-- LEFT: upload -->
                        <label for="about_cv_file"
                                class="md:col-span-9 cursor-pointer p-4 border-b md:border-b-0 md:border-r border-white/10">
                            <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-md border border-white/10 bg-white/5
                                            flex items-center justify-center text-white/70">⧉</div>
                                <div>
                                <p class="text-sm text-white/85 font-semibold">Upload CV (PDF)</p>
                                <p class="text-[11px] text-slate-400 font-mono">click to upload • only .pdf • max 5MB</p>
                                </div>
                            </div>

                            <span class="text-[10px] px-2 py-1 rounded bg-emerald-400/15 text-emerald-200 border border-emerald-400/20">
                                PDF
                            </span>
                            </div>

                            <input id="about_cv_file"
                                type="file"
                                name="cv_file"
                                accept="application/pdf"
                                class="hidden"
                                @change="onPick($event)">
                        </label>

                        <!-- RIGHT: current view -->
                        <div class="md:col-span-3 p-4 flex items-center justify-center">
                            <template x-if="existingUrl">
                            <a :href="existingUrl" target="_blank"
                                class="w-full flex items-center justify-between gap-3
                                        rounded-md px-3">
                                <div class="flex items-center gap-2">
                                <div class="h-8 w-8 rounded-md border border-white/10 bg-slate-950/40
                                            flex items-center justify-center text-white/70 text-xs">PDF</div>
                                <div class="leading-tight">
                                    <p class="text-sm text-white/85 font-semibold">Current CV</p>
                                    <p class="text-[11px] text-slate-400 font-mono">Click to view</p>
                                </div>
                                </div>

                                <span class="text-[10px] px-2 py-1 rounded bg-emerald-400/15 text-emerald-200 border border-emerald-400/20">
                                VIEW
                                </span>
                            </a>
                            </template>

                            <template x-if="!existingUrl">
                            <div class="w-full h-[56px] flex items-center justify-center
                                        rounded-md border border-white/10 bg-white/5">
                                <p class="text-xs font-mono text-slate-400">NO CV</p>
                            </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Selected preview (optional, keep as is) -->
                <div class="mt-3" x-show="picked" x-transition x-cloak>
                    <div class="relative rounded-md border border-white/10 bg-white/5 overflow-hidden p-3">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                        <div class="h-9 w-9 rounded-md border border-white/10 bg-slate-950/40 flex items-center justify-center text-white/70">PDF</div>
                        <div>
                            <p class="text-sm text-white/85 font-semibold truncate max-w-[260px]" x-text="pickedName"></p>
                            <p class="text-[11px] text-slate-400 font-mono" x-text="pickedSize"></p>
                            <p class="text-[11px] text-red-300 font-mono mt-1" x-show="pickedError" x-text="pickedError"></p>
                        </div>
                        </div>

                        <button type="button"
                                class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="clear()">
                        REMOVE
                        </button>
                    </div>
                    </div>
                </div>

                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="$root.err('cv_file')"></p>
            </div>

            

            {{-- PROFILE IMAGE --}}
            <div class="md:col-span-2 grid md:grid-cols-12 gap-4 items-start">
                <div class="md:col-span-9">
                    <label class="text-xs font-mono text-slate-400">PROFILE IMAGE</label>

                    <label for="profile_image"
                        class="js-image-upload mt-2 block rounded-md border border-dashed border-white/15 bg-slate-950/30 hover:border-emerald-400/30 transition p-4 cursor-pointer relative overflow-hidden"
                        data-preview="#aboutProfileImagePreview">

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

                        <input id="profile_image" type="file" name="profile_image" accept="image/*" class="hidden">
                    </label>

                    <div id="aboutProfileImagePreview" class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 hidden">
                        <div class="relative rounded-md border border-white/10 bg-white/5 overflow-hidden">
                            <img data-preview-img src="" class="w-full h-24 object-cover" alt="Hero preview">
                            <div class="absolute inset-0 bg-black/20 pointer-events-none"></div>
                            <div data-preview-cap class="px-2 py-1 text-[10px] font-mono text-slate-300 truncate"></div>
                        </div>
                    </div>

                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('profile_image')"></p>
                </div>

                <div class="md:col-span-3 flex flex-col items-center">
                    @if(data_get($settings->profile,'profile_image'))
                        <img
                            src="{{ asset('storage/'.data_get($settings->profile,'profile_image')) }}"
                            alt="Profile image"
                            class="h-28 w-28 rounded-full object-cover border border-white/10 shadow-md">
                    @else
                        <div
                            class="h-28 w-28 rounded-md border border-white/10 bg-white/5 shadow-md
                                flex items-center justify-center
                                text-xs font-mono text-slate-400">
                            NO IMAGE
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    JOURNEY
    ====================================================================== --}}
    <section x-show="tab==='journey'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; JOURNEY</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveJourney()" :disabled="saving.journey" x-text="saving.journey ? 'SAVING...' : 'SAVE_JOURNEY'"></button>
        </div>

        <form id="journeyForm" class="mt-4" @submit.prevent="saveJourney()">
            @csrf
            <textarea name="journey" rows="7"
                class="w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ $settings->journey }}</textarea>
            <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('journey')"></p>
        </form>
    </section>

    {{-- ======================================================================
    EDUCATION
    ====================================================================== --}}
    <section x-show="tab==='education'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; EDUCATION</p>
            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveEducation()" :disabled="saving.education"
                x-text="saving.education ? 'SAVING...' : 'SAVE_EDUCATION'"></button>
        </div>

        <form id="educationForm" class="mt-4" @submit.prevent="saveEducation()">
            @csrf

            <div x-data="{ items: @js($education ?? []) }"
                class="rounded-md border border-white/10 bg-slate-950/30 p-4">

                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">EDUCATION LIST</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({ title:'', year:'', note:'' })">+ ADD</button>
                </div>

                <template x-for="(e,i) in items" :key="i">
                    <div class="mb-3 grid grid-cols-1 md:grid-cols-12 gap-3 items-start">
                        <input class="md:col-span-3 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`education[${i}][title]`" x-model="e.title" placeholder="BSc in CSE">

                        <input class="md:col-span-2 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`education[${i}][year]`" x-model="e.year" placeholder="2022 — 2026">

                        <input class="md:col-span-6 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`education[${i}][note]`" x-model="e.note" placeholder="Institute / Note">

                        <div class="md:col-span-1 flex md:justify-center md:pt-2">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="items.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>

                <template x-for="(e,i) in items" :key="'err-'+i">
                    <div class="mb-2">
                        <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`education.${i}.title`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`education.${i}.year`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`education.${i}.note`)"></p>
                    </div>
                </template>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    TRAINING
    ====================================================================== --}}
    <section x-show="tab==='training'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; TRAINING</p>
            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveTraining()" :disabled="saving.training"
                x-text="saving.training ? 'SAVING...' : 'SAVE_TRAINING'"></button>
        </div>

        <form id="trainingForm" class="mt-4" @submit.prevent="saveTraining()">
            @csrf

            <div x-data="{ items: @js($training ?? []) }"
                class="rounded-md border border-white/10 bg-slate-950/30 p-4">

                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">TRAINING LIST</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({ title:'', institute:'', duration:'' })">+ ADD</button>
                </div>

                <template x-for="(t,i) in items" :key="i">
                    <div class="mb-3 grid grid-cols-1 md:grid-cols-12 gap-3 items-start">
                        <input class="md:col-span-3 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`training[${i}][title]`" x-model="t.title" placeholder="Web Design">

                        <input class="md:col-span-6 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`training[${i}][institute]`" x-model="t.institute" placeholder="Institute">

                        <input class="md:col-span-2 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`training[${i}][duration]`" x-model="t.duration" placeholder="6 months">

                        <div class="md:col-span-1 flex md:justify-center md:pt-2">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="items.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>

                <template x-for="(t,i) in items" :key="'err-'+i">
                    <div class="mb-2">
                        <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`training.${i}.title`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`training.${i}.institute`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`training.${i}.duration`)"></p>
                    </div>
                </template>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    EXPERIENCE
    ====================================================================== --}}
    <section x-show="tab==='experience'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; EXPERIENCE</p>
            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveExperience()" :disabled="saving.experience"
                x-text="saving.experience ? 'SAVING...' : 'SAVE_EXPERIENCE'"></button>
        </div>

        <form id="experienceForm" class="mt-4" @submit.prevent="saveExperience()">
            @csrf

            <div x-data="{ items: @js($experience ?? []) }"
                class="rounded-md border border-white/10 bg-slate-950/30 p-4">

                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">EXPERIENCE LIST</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({ role:'', company:'', location:'', period:'', tasks:[] })">+ ADD</button>
                </div>

                <template x-for="(x,i) in items" :key="i">
                    <div class="mb-4 rounded-md border border-white/10 bg-slate-950/20 p-4">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                            <input class="md:col-span-3 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                :name="`experience[${i}][role]`" x-model="x.role" placeholder="Assistant Programmer">

                            <input class="md:col-span-3 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                :name="`experience[${i}][company]`" x-model="x.company" placeholder="Company">

                            <input class="md:col-span-3 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                :name="`experience[${i}][location]`" x-model="x.location" placeholder="Dhaka">

                            <input class="md:col-span-2 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                :name="`experience[${i}][period]`" x-model="x.period" placeholder="Nov 2024 — Present">

                            <div class="md:col-span-1 flex md:justify-center md:pt-2">
                                <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="items.splice(i,1)">REMOVE</button>
                            </div>
                        </div>

                        {{-- tasks --}}
                        <div class="mt-3" x-data="{ tasks: x.tasks ?? [] }">
                            <div class="flex items-center justify-between">
                                <p class="text-[11px] font-mono text-slate-400">TASKS</p>
                                <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                                    @click="tasks.push(''); x.tasks = tasks">+ ADD_TASK</button>
                            </div>

                            <template x-for="(t,ti) in tasks" :key="ti">
                                <div class="mt-2 flex gap-2">
                                    <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                        :name="`experience[${i}][tasks][${ti}]`"
                                        x-model="tasks[ti]"
                                        @input="x.tasks = tasks"
                                        placeholder="Task...">
                                    <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                        @click="tasks.splice(ti,1); x.tasks = tasks">REMOVE</button>
                                </div>
                            </template>

                            <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="$root.err(`experience.${i}.tasks`)"></p>
                        </div>

                        <div class="mt-2">
                            <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`experience.${i}.role`)"></p>
                            <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`experience.${i}.company`)"></p>
                            <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`experience.${i}.period`)"></p>
                        </div>
                    </div>
                </template>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    SKILLS
    ====================================================================== --}}
    <section x-show="tab==='skills'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; SKILLS</p>
            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveSkills()" :disabled="saving.skills"
                x-text="saving.skills ? 'SAVING...' : 'SAVE_SKILLS'"></button>
        </div>

        <form id="skillsForm" class="mt-4" @submit.prevent="saveSkills()">
            @csrf

            <div x-data="{ items: @js($skills ?? []) }"
                class="rounded-md border border-white/10 bg-slate-950/30 p-4">

                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">SKILLS LIST</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({ name:'', percent:0 })">+ ADD</button>
                </div>

                <template x-for="(s,i) in items" :key="i">
                    <div class="mb-3 grid grid-cols-1 md:grid-cols-12 gap-3 items-start">
                        <input class="md:col-span-8 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`skills[${i}][name]`" x-model="s.name" placeholder="Laravel / PHP">

                        <input type="number" min="0" max="100"
                            class="md:col-span-3 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`skills[${i}][percent]`" x-model.number="s.percent" placeholder="90">

                        <div class="md:col-span-1 flex md:justify-center md:pt-2">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="items.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>

                <template x-for="(s,i) in items" :key="'err-'+i">
                    <div class="mb-2">
                        <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`skills.${i}.name`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`skills.${i}.percent`)"></p>
                    </div>
                </template>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    PHILOSOPHY
    ====================================================================== --}}
    <section x-show="tab==='philosophy'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PHILOSOPHY</p>
            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="savePhilosophy()" :disabled="saving.philosophy"
                x-text="saving.philosophy ? 'SAVING...' : 'SAVE_PHILOSOPHY'"></button>
        </div>

        <form id="philosophyForm" class="mt-4" @submit.prevent="savePhilosophy()">
            @csrf

            <div x-data="{ items: @js($philosophy ?? []) }"
                class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">PHILOSOPHY LINES</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push('')">+ ADD</button>
                </div>

                <template x-for="(p,i) in items" :key="i">
                    <div class="mb-3 flex gap-2">
                        <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`philosophy[${i}]`" x-model="items[i]" placeholder="Line...">
                        <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                            @click="items.splice(i,1)">REMOVE</button>
                    </div>
                </template>

                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('philosophy')"></p>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    PASSIONS
    ====================================================================== --}}
    <section x-show="tab==='passions'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PASSIONS</p>
            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="savePassions()" :disabled="saving.passions"
                x-text="saving.passions ? 'SAVING...' : 'SAVE_PASSIONS'"></button>
        </div>

        <form id="passionsForm" class="mt-4" @submit.prevent="savePassions()">
            @csrf

            <div x-data="{ items: @js($passions ?? []) }"
                class="rounded-md border border-white/10 bg-slate-950/30 p-4">

                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">PASSION MODULES</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({ title:'', desc:'' })">+ ADD</button>
                </div>

                <template x-for="(p,i) in items" :key="i">
                    <div class="mb-3 grid grid-cols-1 md:grid-cols-12 gap-3 items-start">
                        <input class="md:col-span-3 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`passions[${i}][title]`" x-model="p.title" placeholder="Clean Architecture">

                        <input class="md:col-span-8 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`passions[${i}][desc]`" x-model="p.desc" placeholder="Readable structure, scalable modules">

                        <div class="md:col-span-1 flex md:justify-center md:pt-2">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="items.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>

                <template x-for="(p,i) in items" :key="'err-'+i">
                    <div class="mb-2">
                        <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`passions.${i}.title`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="$root.err(`passions.${i}.desc`)"></p>
                    </div>
                </template>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    FOOTER
    ====================================================================== --}}
    <section x-show="tab==='footer_section'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; FOOTER_SECTION</p>
            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="savePageFooter()" :disabled="saving.footer"
                x-text="saving.footer ? 'SAVING...' : 'SAVE_PAGE_FOOTER'"></button>
        </div>

        <form id="pageFooterForm" class="mt-4 grid md:grid-cols-2 gap-3" @submit.prevent="savePageFooter()">
            @csrf

            <div>
                <label class="text-xs font-mono text-slate-400">BRAND FIRST</label>
                <input name="footer[brand_first]" value="{{ data_get($footer,'brand_first') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                    placeholder="Bappa">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('footer.brand_first')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">BRAND LAST</label>
                <input name="footer[brand_last]" value="{{ data_get($footer,'brand_last') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                    placeholder="Sutradhar">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('footer.brand_last')"></p>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">TAGLINE (without &gt;)</label>
                <input name="footer[tagline]" value="{{ data_get($footer,'tagline') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                    placeholder="Building reliable production-grade software">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('footer.tagline')"></p>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">AVAILABILITY TEXT</label>
                <input name="footer[availability]" value="{{ data_get($footer,'availability') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                    placeholder="Available for new projects">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('footer.availability')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">BUILD</label>
                <input name="footer[build]" value="{{ data_get($footer,'build') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                    placeholder="v1.0">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('footer.build')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">SYSTEM STATUS</label>
                <input name="footer[system_status]" value="{{ data_get($footer,'system_status') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                    placeholder="All systems operational">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('footer.system_status')"></p>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">COPYRIGHT NAME</label>
                <input name="footer[copyright_name]" value="{{ data_get($footer,'copyright_name') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                    placeholder="Bappa Sutradhar">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('footer.copyright_name')"></p>
            </div>
        </form>
    </section>
</div>
@endsection

@push('scripts')

<script>
function aboutSettings(){
    return {
        tab: 'header',
        saving: {
            header:false, terminal:false, tags:false, profile:false, journey:false,
            education:false, training:false, experience:false, skills:false,
            philosophy:false, passions:false, footer:false
        },
        errors: {},

        init(){
            const saved = localStorage.getItem('about_tab');
            if(saved) this.tab = saved;
        },

        setTab(t){
            this.tab = t;
            this.errors = {};
            localStorage.setItem('about_tab', t);
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

        // Save handlers (routes)
        saveHeader(){ return this.handleSave('header', "{{ route('admin.about.header') }}", 'headerForm'); },
        saveTerminal(){ return this.handleSave('terminal', "{{ route('admin.about.terminal') }}", 'terminalForm'); },
        saveTags(){ return this.handleSave('tags', "{{ route('admin.about.tags') }}", 'tagsForm'); },
        saveProfile(){ return this.handleSave('profile', "{{ route('admin.about.profile') }}", 'profileForm'); },
        saveJourney(){ return this.handleSave('journey', "{{ route('admin.about.journey') }}", 'journeyForm'); },
        saveEducation(){ return this.handleSave('education', "{{ route('admin.about.education') }}", 'educationForm'); },
        saveTraining(){ return this.handleSave('training', "{{ route('admin.about.training') }}", 'trainingForm'); },
        saveExperience(){ return this.handleSave('experience', "{{ route('admin.about.experience') }}", 'experienceForm'); },
        saveSkills(){ return this.handleSave('skills', "{{ route('admin.about.skills') }}", 'skillsForm'); },
        savePhilosophy(){ return this.handleSave('philosophy', "{{ route('admin.about.philosophy') }}", 'philosophyForm'); },
        savePassions(){ return this.handleSave('passions', "{{ route('admin.about.passions') }}", 'passionsForm'); },
        savePageFooter(){
            return this.handleSave('footer', "{{ route('admin.about.footer') }}", 'pageFooterForm');
        },
    }
}
</script>

<script>
function cvUploader({ existingUrl = '', existingName = '' } = {}) {
    return {
        existingUrl,
        existingName,

        picked: false,
        pickedName: '',
        pickedSize: '',
        pickedError: '',

        onPick(e) {
            this.pickedError = '';
            const input = e.target;
            const file = input.files && input.files[0] ? input.files[0] : null;

            if (!file) {
                this.clear();
                return;
            }

            const isPdf = file.type === 'application/pdf' || (file.name || '').toLowerCase().endsWith('.pdf');
            if (!isPdf) {
                this.pickedError = 'Only PDF files are allowed.';
                input.value = '';
                this.picked = false;
                return;
            }

            // 5MB client check (backend also validates)
            const maxBytes = 5 * 1024 * 1024;
            if (file.size > maxBytes) {
                this.pickedError = 'Max allowed size is 5MB.';
                input.value = '';
                this.picked = false;
                return;
            }

            this.picked = true;
            this.pickedName = file.name;
            this.pickedSize = `Size: ${(file.size / 1024 / 1024).toFixed(2)} MB`;
        },

        clear() {
            const input = document.getElementById('about_cv_file');
            if (input) input.value = '';
            this.picked = false;
            this.pickedName = '';
            this.pickedSize = '';
            this.pickedError = '';
        },
    }
}
</script>
@endpush
