@extends('layouts.app')
@section('title','Admin | Create Project')
@section('breadcrumb','Projects / Create')

@section('content')
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PROJECT_CONTROL</p>
            <h1 class="mt-2 text-2xl font-extrabold text-white cyber-text tracking-wide">CREATE_PROJECT</h1>
            <p class="mt-2 text-sm text-slate-300">Manage website projects from here.</p>
        </div>
         <a href="{{ route('admin.project.index') }}"
            class="text-xs font-mono text-emerald-200 hover:text-emerald-100">← Back</a>
    </div>
    <div class="mt-4 rounded-md glass cyber-glow p-6 relative">
        <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>
        <form method="POST" action="{{ route('admin.project.store') }}" class="mt-6 grid md:grid-cols-2 gap-5">
            @csrf

            <div>
                <label class="text-xs font-mono text-slate-400">TITLE</label>
                <input name="title" value="{{ old('title') }}" required
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">SLUG (optional)</label>
                <input name="slug" value="{{ old('slug') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                    placeholder="auto-generate-from-title">
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">SUBTITLE</label>
                <input name="subtitle" value="{{ old('subtitle') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">MAIN IMAGE (filename)</label>
                <input name="image" value="{{ old('image') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                    placeholder="inventory.jpg">
                <p class="mt-1 text-[11px] text-slate-500 font-mono">
                    Put file in: <span class="text-slate-300">public/images/projects/</span>
                </p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">STATUS</label>
                <select name="status"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    @foreach (['Live','Private','In Progress'] as $st)
                        <option value="{{ $st }}" @selected(old('status','Live') === $st)>{{ $st }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">SORT ORDER</label>
                <input type="number" name="sort_order" value="{{ old('sort_order',0) }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div class="md:col-span-2 grid sm:grid-cols-2 gap-4">
                <label class="flex items-center gap-2 text-xs font-mono text-slate-300">
                    <input type="checkbox" name="visibility" value="1" @checked(old('visibility',1))
                        class="rounded border-white/20 bg-slate-950/40 text-emerald-400">
                    Visible (show on website)
                </label>

                <label class="flex items-center gap-2 text-xs font-mono text-slate-300">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured'))
                        class="rounded border-white/20 bg-slate-950/40 text-emerald-400">
                    Featured
                </label>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">IMPACT</label>
                <textarea name="impact" rows="3"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ old('impact') }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">OVERVIEW</label>
                <textarea name="overview" rows="5"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ old('overview') }}</textarea>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">STACK (one per line)</label>
                <textarea name="stack" rows="6"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                        placeholder="Laravel&#10;MySQL&#10;Tailwind">{{ old('stack') }}</textarea>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">FEATURES (one per line)</label>
                <textarea name="features" rows="6"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                        placeholder="Role based access&#10;Reports&#10;API integration">{{ old('features') }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">GALLERY (filenames, one per line)</label>
                <textarea name="gallery" rows="5"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                        placeholder="inv-1.png&#10;inv-2.webp">{{ old('gallery') }}</textarea>
            </div>

            <div class="md:col-span-2 flex gap-3">
                <button class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-6 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
                    SAVE_PROJECT
                </button>

                <a href="{{ route('admin.project.index') }}"
                class="rounded-md border border-white/10 bg-white/5 px-6 py-3 font-semibold text-white hover:border-emerald-400/25 transition">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
@endsection
