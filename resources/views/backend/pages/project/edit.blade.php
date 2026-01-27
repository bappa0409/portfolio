@extends('backend.layouts.app')
@section('title','Admin | Edit Project')
@section('breadcrumb','Projects / Edit')

@section('content')
@php
    // Convert arrays to textarea lines
    $stackLines = is_array($project->stack) ? implode("\n", $project->stack) : '';
    $featureLines = is_array($project->features) ? implode("\n", $project->features) : '';
    $galleryLines = is_array($project->gallery) ? implode("\n", $project->gallery) : '';
@endphp

<div class="rounded-md glass cyber-glow p-6 relative">
    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

    <div class="flex items-center justify-between gap-4">
        <div>
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PROJECT_EDIT</p>
            <h1 class="mt-2 text-xl font-extrabold cyber-text">EDIT_PROJECT</h1>
            <p class="mt-1 text-sm text-slate-300">{{ $project->title }}</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('projects.show', $project->slug) }}" target="_blank"
               class="rounded-md border border-white/10 bg-white/5 px-4 py-3 text-xs font-mono text-slate-200 hover:border-emerald-400/25 hover:text-emerald-200 transition">
                View Live
            </a>

            <a href="{{ route('admin.projects.index') }}"
               class="text-xs font-mono text-emerald-200 hover:text-emerald-100 transition">
                ← Back
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="mt-5 rounded-md border border-red-400/30 bg-red-400/10 px-4 py-3 text-sm text-red-200">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.projects.update', $project) }}" class="mt-6 grid md:grid-cols-2 gap-5">
        @csrf
        @method('PUT')

        <div>
            <label class="text-xs font-mono text-slate-400">TITLE</label>
            <input name="title" value="{{ old('title', $project->title) }}" required
                   class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
        </div>

        <div>
            <label class="text-xs font-mono text-slate-400">SLUG (optional)</label>
            <input name="slug" value="{{ old('slug', $project->slug) }}"
                   class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            <p class="mt-1 text-[11px] text-slate-500 font-mono">Unique slug required.</p>
        </div>

        <div class="md:col-span-2">
            <label class="text-xs font-mono text-slate-400">SUBTITLE</label>
            <input name="subtitle" value="{{ old('subtitle', $project->subtitle) }}"
                   class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
        </div>

        <div class="md:col-span-2">
            <label class="text-xs font-mono text-slate-400">MAIN IMAGE (filename)</label>
            <input name="image" value="{{ old('image', $project->image) }}"
                   class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                   placeholder="inventory.jpg">
            <p class="mt-1 text-[11px] text-slate-500 font-mono">
                Put file in: <span class="text-slate-300">public/images/projects/</span>
            </p>

            @if($project->image)
                <div class="mt-3 flex items-center gap-3">
                    <div class="h-14 w-20 rounded-md border border-white/10 bg-white/5 overflow-hidden">
                        <img src="{{ asset('images/projects/'.$project->image) }}" class="h-full w-full object-cover" alt="">
                    </div>
                    <div class="text-xs font-mono text-slate-400">
                        Preview: <span class="text-slate-200">{{ $project->image }}</span>
                    </div>
                </div>
            @endif
        </div>

        <div>
            <label class="text-xs font-mono text-slate-400">STATUS</label>
            <select name="status"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                @foreach (['Live','Private','In Progress'] as $st)
                    <option value="{{ $st }}" @selected(old('status', $project->status) === $st)>{{ $st }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-xs font-mono text-slate-400">SORT ORDER</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}"
                   class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
        </div>

        <div class="md:col-span-2 grid sm:grid-cols-2 gap-4">
            <label class="flex items-center gap-2 text-xs font-mono text-slate-300">
                <input type="checkbox" name="visibility" value="1" @checked(old('visibility', $project->visibility))
                       class="rounded border-white/20 bg-slate-950/40 text-emerald-400">
                Visible (show on website)
            </label>

            <label class="flex items-center gap-2 text-xs font-mono text-slate-300">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $project->is_featured))
                       class="rounded border-white/20 bg-slate-950/40 text-emerald-400">
                Featured
            </label>
        </div>

        <div class="md:col-span-2">
            <label class="text-xs font-mono text-slate-400">IMPACT</label>
            <textarea name="impact" rows="3"
                      class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ old('impact', $project->impact) }}</textarea>
        </div>

        <div class="md:col-span-2">
            <label class="text-xs font-mono text-slate-400">OVERVIEW</label>
            <textarea name="overview" rows="5"
                      class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ old('overview', $project->overview) }}</textarea>
        </div>

        <div>
            <label class="text-xs font-mono text-slate-400">STACK (one per line)</label>
            <textarea name="stack" rows="7"
                      class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                      placeholder="Laravel&#10;MySQL&#10;Tailwind">{{ old('stack', $stackLines) }}</textarea>
        </div>

        <div>
            <label class="text-xs font-mono text-slate-400">FEATURES (one per line)</label>
            <textarea name="features" rows="7"
                      class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                      placeholder="Role based access&#10;Reports&#10;API integration">{{ old('features', $featureLines) }}</textarea>
        </div>

        <div class="md:col-span-2">
            <label class="text-xs font-mono text-slate-400">GALLERY (filenames, one per line)</label>
            <textarea name="gallery" rows="6"
                      class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                      placeholder="inv-1.png&#10;inv-2.webp">{{ old('gallery', $galleryLines) }}</textarea>

            <p class="mt-1 text-[11px] text-slate-500 font-mono">
                These files should exist in <span class="text-slate-300">public/images/projects/</span>
            </p>
        </div>

        <div class="md:col-span-2 flex gap-3">
            <button class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-6 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
                UPDATE_PROJECT
            </button>

            <a href="{{ route('admin.projects.index') }}"
               class="rounded-md border border-white/10 bg-white/5 px-6 py-3 font-semibold text-white hover:border-emerald-400/25 transition">
                CANCEL
            </a>
        </div>
    </form>
</div>
@endsection
