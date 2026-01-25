@extends('layouts.app')
@section('title', $project['title'].' | Project')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-12">
    <a href="{{ route('projects') }}" class="text-sm text-blue-400 hover:text-blue-300">← Back to Projects</a>

    <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 overflow-hidden">
        <div class="h-44 bg-gradient-to-br from-blue-500/20 to-slate-950"></div>
        <div class="p-7">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
                <div>
                    <h1 class="text-3xl font-extrabold">{{ $project['title'] }}</h1>
                    <p class="mt-2 text-slate-300">{{ $project['subtitle'] }}</p>

                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($project['stack'] as $tag)
                            <span class="text-xs rounded-full bg-slate-950/60 border border-white/10 px-3 py-1 text-slate-200">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-md border border-white/10 bg-slate-950/40 p-4 min-w-[220px]">
                    <p class="text-xs text-slate-400">Status</p>
                    <p class="font-semibold">{{ $project['status'] }}</p>
                    <p class="mt-3 text-xs text-slate-400">Impact</p>
                    <p class="text-sm text-slate-200">{{ $project['impact'] }}</p>
                </div>
            </div>

            <div class="mt-8 grid md:grid-cols-2 gap-6">
                <div class="rounded-2xl border border-white/10 bg-slate-950/30 p-6">
                    <h2 class="font-bold text-lg">Overview</h2>
                    <p class="mt-2 text-slate-300 text-sm">{{ $project['overview'] }}</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-slate-950/30 p-6">
                    <h2 class="font-bold text-lg">Key Features</h2>
                    <ul class="mt-3 space-y-2 text-sm text-slate-300 list-disc list-inside">
                        @foreach ($project['features'] as $f)
                            <li>{{ $f }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ route('contact') }}"
                   class="inline-block rounded-md bg-blue-500 hover:bg-blue-400 px-5 py-3 font-semibold text-slate-950">
                    Build something like this
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
