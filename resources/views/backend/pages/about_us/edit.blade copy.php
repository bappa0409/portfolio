@extends('layouts.app')
@section('title', 'Admin | About Settings')
@section('breadcrumb', 'Website / About Settings')

@section('content')
<div class="flex items-start justify-between gap-4">
    <div>
        <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; ABOUT_CONTROL</p>
        <h1 class="mt-2 text-2xl font-extrabold text-white cyber-text tracking-wide">ABOUT_SETTINGS</h1>
        <p class="mt-2 text-sm text-slate-300">Manage about page sections content from here.</p>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="text-xs font-mono text-emerald-200 hover:text-emerald-100">← Back</a>
</div>

<div class="mt-4 rounded-md glass cyber-glow p-6 relative" x-data="aboutSettings()" x-init="init()" x-cloak>
    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

    {{-- Tabs --}}
    <div class="flex flex-wrap gap-2 border-b border-white/10 pb-3">
        @php
        $tabs = [
            'header' => 'HEADER',
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
            'final_cta' => 'FINAL_CTA',
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
    HEADER TAB
    ====================================================================== --}}
    <section x-show="tab==='header'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; HEADER</p>
                <p class="mt-1 text-[11px] text-slate-400 font-mono">Controls about page heading section.</p>
            </div>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveHeader()" :disabled="saving.header" x-text="saving.header ? 'SAVING...' : 'SAVE_HEADER'"></button>
        </div>

        @php $header = $settings->header ?? []; @endphp
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
    TERMINAL TAB
    ====================================================================== --}}
    <section x-show="tab==='terminal'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; TERMINAL</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveTerminal()" :disabled="saving.terminal" x-text="saving.terminal ? 'SAVING...' : 'SAVE_TERMINAL'"></button>
        </div>

        @php $terminal = $settings->terminal ?? []; @endphp
        <form id="terminalForm" class="mt-4 grid md:grid-cols-2 gap-3" @submit.prevent="saveTerminal()">
            @csrf

            <div>
                <label class="text-xs font-mono text-slate-400">WHOAMI NAME</label>
                <input name="terminal[whoami_name]" value="{{ data_get($terminal,'whoami_name') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('terminal.whoami_name')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">WHOAMI ROLE</label>
                <input name="terminal[whoami_role]" value="{{ data_get($terminal,'whoami_role') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('terminal.whoami_role')"></p>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">STACK (single line)</label>
                <input name="terminal[stack]" value="{{ data_get($terminal,'stack') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('terminal.stack')"></p>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">CURRENT ROLE (single line)</label>
                <textarea name="terminal[current_role]" rows="2"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ data_get($terminal,'current_role') }}</textarea>
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('terminal.current_role')"></p>
            </div>

            <div class="md:col-span-2" x-data="{ items: @js(data_get($terminal,'projects', [])) }">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-mono text-slate-400">TOP PROJECTS (list)</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push('')">+ ADD</button>
                </div>

                <template x-for="(p,i) in items" :key="i">
                    <div class="mt-2 flex items-center gap-2">
                        <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`terminal[projects][${i}]`" x-model="items[i]" placeholder="Project title">
                        <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                            @click="items.splice(i,1)">REMOVE</button>
                    </div>
                </template>

                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('terminal.projects')"></p>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    TAGS TAB
    ====================================================================== --}}
    <section x-show="tab==='tags'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; TAGS</p>
                <p class="mt-1 text-[11px] text-slate-400 font-mono">These tags appear under terminal block.</p>
            </div>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveTags()" :disabled="saving.tags" x-text="saving.tags ? 'SAVING...' : 'SAVE_TAGS'"></button>
        </div>

        <form id="tagsForm" class="mt-4" @submit.prevent="saveTags()">
            @csrf

            <div x-data="tagInput({
                initial: @js($settings->tags ?? []),
                namePrefix: 'tags',
                placeholder: 'Write tag and press Enter..'
            })" class="rounded-md border border-white/10 bg-slate-950/30 p-4">

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

                <p class="mt-1 text-[11px] text-red-300 font-mono"
                    x-show="error || $root.err('tags')"
                    x-text="error || $root.err('tags')"></p>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    PROFILE TAB
    ====================================================================== --}}
    <section x-show="tab==='profile'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PROFILE</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveProfile()" :disabled="saving.profile" x-text="saving.profile ? 'SAVING...' : 'SAVE_PROFILE'"></button>
        </div>

        @php $profile = $settings->profile ?? []; @endphp

        <form id="profileForm" class="mt-4 grid md:grid-cols-2 gap-3" enctype="multipart/form-data" @submit.prevent="saveProfile()">
            @csrf

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

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">LOCATION (line)</label>
                <input name="profile[location]" value="{{ data_get($profile,'location') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('profile.location')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">EMAIL</label>
                <input name="profile[email]" value="{{ data_get($profile,'email') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('profile.email')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">GITHUB URL</label>
                <input name="profile[github_url]" value="{{ data_get($profile,'github_url') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('profile.github_url')"></p>
            </div>

            {{-- Status --}}
            <div class="md:col-span-2 rounded-md border border-white/10 bg-slate-950/30 p-4">
                <p class="text-xs font-mono text-slate-400 mb-3">STATUS</p>

                <div class="grid md:grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-mono text-slate-400">STATUS TITLE</label>
                        <input name="profile[status_title]" value="{{ data_get($profile,'status_title') }}"
                            class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                        <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('profile.status_title')"></p>
                    </div>

                    <div x-data="{ lines: @js(data_get($profile,'status_lines', [])) }">
                        <label class="text-xs font-mono text-slate-400">STATUS LINES</label>

                        <template x-for="(l,i) in lines" :key="i">
                            <div class="mt-2 flex items-center gap-2">
                                <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                    :name="`profile[status_lines][${i}]`" x-model="lines[i]" placeholder="✔ Available for new projects">
                                <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="lines.splice(i,1)">REMOVE</button>
                            </div>
                        </template>

                        <button type="button" class="mt-2 text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                            @click="lines.push('')">+ ADD_LINE</button>

                        <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="$root.err('profile.status_lines')"></p>
                    </div>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="md:col-span-2 grid md:grid-cols-2 gap-3">
                <div>
                    <label class="text-xs font-mono text-slate-400">PROJECTS BUTTON TEXT</label>
                    <input name="profile_buttons[projects_text]" value="{{ data_get($profile,'buttons.projects_text') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('profile_buttons.projects_text')"></p>
                </div>

                <div>
                    <label class="text-xs font-mono text-slate-400">CONTACT BUTTON TEXT</label>
                    <input name="profile_buttons[contact_text]" value="{{ data_get($profile,'buttons.contact_text') }}"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('profile_buttons.contact_text')"></p>
                </div>
            </div>

            {{-- Profile Image --}}
            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">PROFILE IMAGE</label>

                <label for="about_profile_image" class="mt-2 block rounded-md border border-dashed border-white/15 bg-slate-950/30 hover:border-emerald-400/30 transition p-4 cursor-pointer relative overflow-hidden">
                    <div class="absolute inset-0 scanline opacity-30 pointer-events-none"></div>

                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-md border border-white/10 bg-white/5 flex items-center justify-center text-white/70">⧉</div>
                            <div>
                                <p class="text-sm text-white/85 font-semibold">Drag & Drop image</p>
                                <p class="text-[11px] text-slate-400 font-mono">or click to upload (only one)</p>
                            </div>
                        </div>
                        <span class="text-[10px] px-2 py-1 rounded bg-emerald-400/15 text-emerald-200 border border-emerald-400/20">ABOUT</span>
                    </div>

                    <input id="about_profile_image" type="file" name="profile_image" accept="image/*" class="hidden">
                </label>

                <div id="aboutImagePreview" class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 hidden">
                    <div class="relative rounded-md border border-white/10 bg-white/5 overflow-hidden">
                        <img id="aboutImagePreviewImg" src="" class="w-full h-24 object-cover" alt="About preview">
                        <div class="absolute inset-0 bg-black/20 pointer-events-none"></div>
                        <div id="aboutImagePreviewCap" class="px-2 py-1 text-[10px] font-mono text-slate-300 truncate"></div>
                    </div>
                </div>

                @if($settings->profile_image)
                    <p class="mt-2 text-[11px] text-slate-500 font-mono">Current:</p>
                    <img class="mt-2 h-24 rounded-md border border-white/10"
                        src="{{ asset('storage/'.$settings->profile_image) }}" alt="Current about image">
                @endif

                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('profile_image')"></p>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    JOURNEY TAB
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
            <label class="text-xs font-mono text-slate-400">JOURNEY TEXT</label>
            <textarea name="journey" rows="6"
                class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ $settings->journey }}</textarea>
            <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('journey')"></p>
        </form>
    </section>

    {{-- ======================================================================
    EDUCATION TAB
    ====================================================================== --}}
    <section x-show="tab==='education'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; EDUCATION</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveEducation()" :disabled="saving.education" x-text="saving.education ? 'SAVING...' : 'SAVE_EDUCATION'"></button>
        </div>

        <form id="educationForm" class="mt-4" @submit.prevent="saveEducation()">
            @csrf

            <div x-data="{ items: @js($settings->education ?? []) }" class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">EDUCATION ITEMS</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({degree:'', year:'', meta:''})">+ ADD</button>
                </div>

                <template x-for="(e,i) in items" :key="i">
                    <div class="mb-3 grid grid-cols-1 md:grid-cols-12 gap-3 items-start">
                        <input class="md:col-span-4 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`education[${i}][degree]`" x-model="e.degree" placeholder="BSc in CSE">
                        <input class="md:col-span-2 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`education[${i}][year]`" x-model="e.year" placeholder="2022 — 2026">
                        <input class="md:col-span-5 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`education[${i}][meta]`" x-model="e.meta" placeholder="Southeast University (Running)">
                        <div class="md:col-span-1 flex md:justify-center md:pt-2">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="items.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>

                <template x-for="(e,i) in items" :key="'err-'+i">
                    <div class="mb-2">
                        <p class="text-[11px] text-red-300 font-mono" x-text="err(`education.${i}.degree`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="err(`education.${i}.year`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="err(`education.${i}.meta`)"></p>
                    </div>
                </template>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    TRAINING TAB
    ====================================================================== --}}
    <section x-show="tab==='training'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; TRAINING</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveTraining()" :disabled="saving.training" x-text="saving.training ? 'SAVING...' : 'SAVE_TRAINING'"></button>
        </div>

        <form id="trainingForm" class="mt-4" @submit.prevent="saveTraining()">
            @csrf

            <div x-data="{ items: @js($settings->training ?? []) }" class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">TRAINING ITEMS</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({title:'', place:'', duration:''})">+ ADD</button>
                </div>

                <template x-for="(t,i) in items" :key="i">
                    <div class="mb-3 grid grid-cols-1 md:grid-cols-12 gap-3 items-start">
                        <input class="md:col-span-4 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`training[${i}][title]`" x-model="t.title" placeholder="Web Design">
                        <input class="md:col-span-5 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`training[${i}][place]`" x-model="t.place" placeholder="Bangladesh Korea TTC (SEIP)">
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
                        <p class="text-[11px] text-red-300 font-mono" x-text="err(`training.${i}.title`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="err(`training.${i}.place`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="err(`training.${i}.duration`)"></p>
                    </div>
                </template>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    EXPERIENCE TAB
    ====================================================================== --}}
    <section x-show="tab==='experience'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; EXPERIENCE</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveExperience()" :disabled="saving.experience" x-text="saving.experience ? 'SAVING...' : 'SAVE_EXPERIENCE'"></button>
        </div>

        <form id="experienceForm" class="mt-4" @submit.prevent="saveExperience()">
            @csrf

            <div x-data="{ items: @js($settings->experience ?? []) }" class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">EXPERIENCE ITEMS</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({role:'', company:'', period:'', bullets:['']})">+ ADD</button>
                </div>

                <template x-for="(ex,i) in items" :key="i">
                    <div class="mb-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-start">
                            <input class="md:col-span-4 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                :name="`experience[${i}][role]`" x-model="ex.role" placeholder="Assistant Programmer">
                            <input class="md:col-span-5 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                :name="`experience[${i}][company]`" x-model="ex.company" placeholder="IT BANGLA LTD • Dhaka">
                            <input class="md:col-span-2 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                :name="`experience[${i}][period]`" x-model="ex.period" placeholder="Nov 2024 — Present">
                            <div class="md:col-span-1 flex md:justify-center md:pt-2">
                                <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="items.splice(i,1)">REMOVE</button>
                            </div>
                        </div>

                        <div class="mt-3" x-data="{ bullets: ex.bullets ?? [''] }" x-init="ex.bullets = bullets">
                            <div class="flex items-center justify-between">
                                <p class="text-[11px] font-mono text-slate-400">BULLETS</p>
                                <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                                    @click="bullets.push('')">+ ADD_BULLET</button>
                            </div>

                            <template x-for="(b,bi) in bullets" :key="bi">
                                <div class="mt-2 flex items-center gap-2">
                                    <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                        :name="`experience[${i}][bullets][${bi}]`" x-model="bullets[bi]" placeholder="Did something...">
                                    <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                        @click="bullets.splice(bi,1)">REMOVE</button>
                                </div>
                            </template>
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
    SKILLS TAB
    ====================================================================== --}}
    <section x-show="tab==='skills'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; SKILLS</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveSkills()" :disabled="saving.skills" x-text="saving.skills ? 'SAVING...' : 'SAVE_SKILLS'"></button>
        </div>

        <form id="skillsForm" class="mt-4" @submit.prevent="saveSkills()">
            @csrf

            <div x-data="{ items: @js($settings->skills ?? []) }" class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">SKILL BARS</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({name:'', percent:70})">+ ADD</button>
                </div>

                <template x-for="(s,i) in items" :key="i">
                    <div class="mb-3 flex flex-wrap md:flex-nowrap items-center gap-3">
                        <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`skills[${i}][name]`" x-model="s.name" placeholder="Laravel / PHP">

                        <input type="number" min="0" max="100"
                            class="w-full md:w-28 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`skills[${i}][percent]`" x-model.number="s.percent" placeholder="90">

                        <button type="button" class="shrink-0 text-[11px] font-mono text-red-300 hover:text-red-200"
                            @click="items.splice(i,1)">REMOVE</button>
                    </div>
                </template>

                <template x-for="(s,i) in items" :key="'err-'+i">
                    <div class="mb-2">
                        <p class="text-[11px] text-red-300 font-mono" x-text="err(`skills.${i}.name`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="err(`skills.${i}.percent`)"></p>
                    </div>
                </template>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    PHILOSOPHY TAB
    ====================================================================== --}}
    <section x-show="tab==='philosophy'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PHILOSOPHY</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="savePhilosophy()" :disabled="saving.philosophy" x-text="saving.philosophy ? 'SAVING...' : 'SAVE_PHILOSOPHY'"></button>
        </div>

        <form id="philosophyForm" class="mt-4" @submit.prevent="savePhilosophy()">
            @csrf

            <div x-data="{ items: @js($settings->philosophy ?? []) }" class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">BULLETS</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push('')">+ ADD</button>
                </div>

                <template x-for="(p,i) in items" :key="i">
                    <div class="mb-3 flex items-center gap-2">
                        <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`philosophy[${i}]`" x-model="items[i]" placeholder="• Clean code and maintainable structure">
                        <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                            @click="items.splice(i,1)">REMOVE</button>
                    </div>
                </template>

                <p class="text-[11px] text-red-300 font-mono" x-text="err('philosophy')"></p>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    PASSIONS TAB
    ====================================================================== --}}
    <section x-show="tab==='passions'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PASSIONS</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="savePassions()" :disabled="saving.passions" x-text="saving.passions ? 'SAVING...' : 'SAVE_PASSIONS'"></button>
        </div>

        <form id="passionsForm" class="mt-4" @submit.prevent="savePassions()">
            @csrf

            <div x-data="{ items: @js($settings->passions ?? []) }" class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-mono text-slate-400">PASSION MODULES</p>
                    <button type="button" class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                        @click="items.push({title:'', desc:''})">+ ADD</button>
                </div>

                <template x-for="(p,i) in items" :key="i">
                    <div class="mb-3 grid grid-cols-1 md:grid-cols-12 gap-3 items-start">
                        <input class="md:col-span-4 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`passions[${i}][title]`" x-model="p.title" placeholder="Clean Architecture">
                        <input class="md:col-span-7 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                            :name="`passions[${i}][desc]`" x-model="p.desc" placeholder="Readable structure, scalable modules">
                        <div class="md:col-span-1 flex md:justify-center md:pt-2">
                            <button type="button" class="text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="items.splice(i,1)">REMOVE</button>
                        </div>
                    </div>
                </template>

                <template x-for="(p,i) in items" :key="'err-'+i">
                    <div class="mb-2">
                        <p class="text-[11px] text-red-300 font-mono" x-text="err(`passions.${i}.title`)"></p>
                        <p class="text-[11px] text-red-300 font-mono" x-text="err(`passions.${i}.desc`)"></p>
                    </div>
                </template>
            </div>
        </form>
    </section>

    {{-- ======================================================================
    FINAL CTA TAB
    ====================================================================== --}}
    <section x-show="tab==='final_cta'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; FINAL_CTA</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveFinalCta()" :disabled="saving.final_cta" x-text="saving.final_cta ? 'SAVING...' : 'SAVE_FINAL_CTA'"></button>
        </div>

        @php $cta = $settings->final_cta ?? []; @endphp
        <form id="finalCtaForm" class="mt-4 grid md:grid-cols-2 gap-3" @submit.prevent="saveFinalCta()">
            @csrf

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">TITLE</label>
                <input name="final_cta[title]" value="{{ data_get($cta,'title') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('final_cta.title')"></p>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">SUBTITLE</label>
                <textarea name="final_cta[subtitle]" rows="3"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ data_get($cta,'subtitle') }}</textarea>
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('final_cta.subtitle')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">PRIMARY BUTTON TEXT</label>
                <input name="final_cta[primary_text]" value="{{ data_get($cta,'primary_text') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('final_cta.primary_text')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">SECONDARY BUTTON TEXT</label>
                <input name="final_cta[secondary_text]" value="{{ data_get($cta,'secondary_text') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('final_cta.secondary_text')"></p>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">FOOTER LINE</label>
                <input name="final_cta[footer]" value="{{ data_get($cta,'footer') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('final_cta.footer')"></p>
            </div>
        </form>
    </section>

</div>
@endsection

@push('scripts')
<script>
(() => {
    // ABOUT IMAGE PREVIEW (dropzone)
    const input = document.getElementById('about_profile_image');
    const wrap  = input?.closest('label');
    const prev  = document.getElementById('aboutImagePreview');
    const img   = document.getElementById('aboutImagePreviewImg');
    const cap   = document.getElementById('aboutImagePreviewCap');

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

<script>
function aboutSettings(){
    return {
        tab: 'header',
        saving: {
            header:false, terminal:false, tags:false, profile:false, journey:false,
            education:false, training:false, experience:false, skills:false,
            philosophy:false, passions:false, final_cta:false
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

        // Save handlers
        saveHeader(){ return this.handleSave('header', "{{ route('admin.about.settings.header') }}", 'headerForm'); },
        saveTerminal(){ return this.handleSave('terminal', "{{ route('admin.about.settings.terminal') }}", 'terminalForm'); },
        saveTags(){ return this.handleSave('tags', "{{ route('admin.about.settings.tags') }}", 'tagsForm'); },
        saveProfile(){ return this.handleSave('profile', "{{ route('admin.about.settings.profile') }}", 'profileForm'); },
        saveJourney(){ return this.handleSave('journey', "{{ route('admin.about.settings.journey') }}", 'journeyForm'); },
        saveEducation(){ return this.handleSave('education', "{{ route('admin.about.settings.education') }}", 'educationForm'); },
        saveTraining(){ return this.handleSave('training', "{{ route('admin.about.settings.training') }}", 'trainingForm'); },
        saveExperience(){ return this.handleSave('experience', "{{ route('admin.about.settings.experience') }}", 'experienceForm'); },
        saveSkills(){ return this.handleSave('skills', "{{ route('admin.about.settings.skills') }}", 'skillsForm'); },
        savePhilosophy(){ return this.handleSave('philosophy', "{{ route('admin.about.settings.philosophy') }}", 'philosophyForm'); },
        savePassions(){ return this.handleSave('passions', "{{ route('admin.about.settings.passions') }}", 'passionsForm'); },
        saveFinalCta(){ return this.handleSave('final_cta', "{{ route('admin.about.settings.final_cta') }}", 'finalCtaForm'); },
    }
}
</script>
@endpush
