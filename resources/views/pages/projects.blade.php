@extends('layouts.app')
@section('title','Projects | Portfolio')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-12">
    <h1 class="text-3xl md:text-4xl font-extrabold">Projects</h1>
    <p class="mt-3 text-slate-300">Case-study style projects showing stack, features, and impact.</p>

    <div class="mt-8 grid md:grid-cols-3 gap-5">
        @foreach ($projects as $p)
            <a href="{{ route('projects.show', $p['slug']) }}"
               class="block rounded-2xl border border-white/10 bg-white/5 overflow-hidden hover:border-white/20 transition">
                <div class="h-36 bg-gradient-to-br from-blue-500/20 to-slate-950"></div>
                <div class="p-5">
                    <h3 class="font-semibold">{{ $p['title'] }}</h3>
                    <p class="mt-2 text-slate-300 text-sm">{{ $p['subtitle'] }}</p>

                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($p['stack'] as $tag)
                            <span class="text-xs rounded-full bg-slate-950/60 border border-white/10 px-3 py-1 text-slate-200">{{ $tag }}</span>
                        @endforeach
                    </div>

                    <div class="mt-4 text-xs text-slate-400">Impact: {{ $p['impact'] }}</div>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endsection
