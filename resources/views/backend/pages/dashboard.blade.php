@extends('admin.layouts.app')
@section('title','Admin | Dashboard')
@section('breadcrumb','Dashboard')

@section('content')
<div class="rounded-md glass cyber-glow p-6 relative">
    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

    <div class="flex items-center justify-between gap-3">
        <div>
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; SYSTEM_STATUS</p>
            <h1 class="mt-2 text-2xl font-extrabold cyber-text">ADMIN_DASHBOARD</h1>
            <p class="mt-2 text-sm text-slate-300">Manage projects, featured items, visibility, and content.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}"
           class="px-4 py-3 rounded-md bg-emerald-400/15 border border-emerald-400/25 text-emerald-100 hover:bg-emerald-400/20 transition font-mono text-xs">
            + NEW_PROJECT
        </a>
    </div>

    <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($cards as $c)
            <div class="rounded-md border border-white/10 bg-slate-950/30 p-5 text-center">
                <div class="text-2xl font-extrabold text-white">{{ $c[0] }}</div>
                <div class="mt-1 text-xs text-slate-400 font-mono">{{ $c[1] }}</div>
            </div>
        @endforeach
    </div>
</div>
@endsection
