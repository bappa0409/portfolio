@extends('layouts.app')
@section('title','About | Portfolio')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-12">
    <h1 class="text-3xl md:text-4xl font-extrabold">About Me</h1>
    <p class="mt-3 text-slate-300 max-w-2xl">
        I’m a Laravel developer with 3 years of experience building web apps, APIs, admin panels and ecommerce features.
        I focus on clean architecture, security, and performance.
    </p>

    <div class="mt-10 grid md:grid-cols-2 gap-6">
        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <h2 class="font-bold text-lg">Strengths</h2>
            <ul class="mt-3 space-y-2 text-sm text-slate-300 list-disc list-inside">
                <li>Clean code, reusable components, maintainable structure</li>
                <li>Security best practices (validation, auth, RBAC)</li>
                <li>Performance tuning (queries, caching, indexing)</li>
                <li>Deployment support (cPanel/VPS, SSL setup)</li>
            </ul>
        </div>

        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <h2 class="font-bold text-lg">Timeline</h2>
            <div class="mt-4 space-y-4 text-sm">
                <div class="rounded-xl border border-white/10 bg-slate-950/30 p-4">
                    <p class="text-slate-400 text-xs">2023 – Now</p>
                    <p class="font-semibold">Laravel Developer</p>
                    <p class="text-slate-300">Freelance / Company Projects</p>
                </div>
                <div class="rounded-xl border border-white/10 bg-slate-950/30 p-4">
                    <p class="text-slate-400 text-xs">2022</p>
                    <p class="font-semibold">PHP → Laravel Journey</p>
                    <p class="text-slate-300">Built multiple CRUD systems and APIs</p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mt-12 text-2xl font-bold">Skills</h2>
    <div class="mt-6 grid md:grid-cols-2 gap-5">
        @foreach ($skills as $group => $items)
            <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
                <h3 class="font-semibold">{{ $group }}</h3>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($items as $item)
                        <span class="text-xs rounded-full bg-slate-950/60 border border-white/10 px-3 py-1 text-slate-200">{{ $item }}</span>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
