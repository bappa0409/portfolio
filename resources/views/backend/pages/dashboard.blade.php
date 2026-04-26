@extends('layouts.app')
@section('title', 'Admin | Dashboard')

@section('content')
    {{-- Page header --}}
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; CONTROL_PANEL</p>
            <h1 class="mt-2 text-3xl font-extrabold text-white cyber-text tracking-wide">DASHBOARD</h1>
            <p class="mt-2 text-sm text-slate-300">
                Quick overview of contacts and visitor activity.
            </p>
        </div>

        <div class="hidden sm:flex items-center gap-2 text-xs font-mono text-slate-400">
            <span class="text-emerald-200/80">⌁</span>
            {{ now()->format('d M Y, h:i A') }}
        </div>
    </div>

    {{-- Stat cards --}}
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

        {{-- Total Contacts --}}
        <div class="rounded-md glass-soft cyber-glow border border-white/10 p-5 relative overflow-hidden">
            <div class="absolute inset-0 scanline opacity-60 pointer-events-none"></div>
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-mono text-slate-400">TOTAL_CONTACTS</p>
                    <p class="mt-2 text-3xl font-extrabold text-white">{{ $totalContacts ?? 0 }}</p>
                </div>
                <div class="h-12 w-12 rounded-md border border-amber-400/20 bg-amber-400/10 grid place-items-center text-amber-200">
                    {{-- Users icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M16 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 3-1.34 3-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V20h14v-3.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V20h7v-3.5c0-2.33-4.67-3.5-7-3.5z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Visitors --}}
        <div class="rounded-md glass-soft cyber-glow border border-white/10 p-5 relative overflow-hidden">
            <div class="absolute inset-0 scanline opacity-60 pointer-events-none"></div>
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-mono text-slate-400">TOTAL_VISITORS</p>
                    <p class="mt-2 text-3xl font-extrabold text-white">{{ $totalVisitors ?? 0 }}</p>
                </div>
                <div class="h-12 w-12 rounded-md border border-white/10 bg-white/5 grid place-items-center text-slate-200">
                    {{-- Eye icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 5c-7.633 0-10 7-10 7s2.367 7 10 7 10-7 10-7-2.367-7-10-7zm0 12a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Today Visitors --}}
        <div class="rounded-md glass-soft cyber-glow border border-white/10 p-5 relative overflow-hidden">
            <div class="absolute inset-0 scanline opacity-60 pointer-events-none"></div>
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-mono text-slate-400">TODAY_VISITORS</p>
                    <p class="mt-2 text-3xl font-extrabold text-white">{{ $todayVisitors ?? 0 }}</p>
                </div>
                <div class="h-12 w-12 rounded-md border border-cyan-400/20 bg-cyan-400/10 grid place-items-center text-cyan-200">
                    {{-- Calendar icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M7 2h2v2h6V2h2v2h3a2 2 0 012 2v14a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2h3V2zm15 8H2v10h20V10z"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    {{-- Today Visitors Table --}}
    <div class="mt-8 rounded-md glass cyber-glow p-5 relative">
        <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <span class="text-emerald-200">⛭</span>
                <h2 class="text-white font-bold tracking-wide">TODAY_VISITORS</h2>
            </div>
            <span class="text-xs font-mono text-slate-300 rounded-full border border-white/10 bg-white/5 px-3 py-1">
                {{ now()->format('d M Y') }}
            </span>
        </div>

        <div class="mt-4 overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-slate-300 font-mono text-xs">
                    <tr class="border-b border-white/10">
                        <th class="py-3 px-3 text-left">SL</th>
                        <th class="py-3 px-3 text-left">NAME</th>
                        <th class="py-3 px-3 text-left">IP</th>
                        <th class="py-3 px-3 text-left">VISITS</th>
                        <th class="py-3 px-3 text-left">LAST_SEEN</th>
                    </tr>
                </thead>
                <tbody class="text-slate-200">
                    @forelse($todayVisitorList as $key => $v)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition">
                            <td class="py-3 px-3 font-mono text-xs text-slate-400">{{ $key + 1 }}</td>
                            <td class="py-3 px-3">
                                <div class="font-semibold text-white">{{ $v->name ?? 'Guest' }}</div>
                            </td>
                            <td class="py-3 px-3 font-mono text-xs text-slate-300">{{ $v->ip ?? '—' }}</td>
                            <td class="py-3 px-3">
                                <span class="inline-flex items-center rounded-full border border-cyan-400/20 bg-cyan-400/10 px-2.5 py-1 text-xs font-mono text-cyan-200">
                                    {{ $v->visits ?? 0 }}
                                </span>
                            </td>
                            <td class="py-3 px-3 font-mono text-xs text-slate-300">
                                {{ isset($v->updated_at) ? \Illuminate\Support\Carbon::parse($v->updated_at)->format('h:i A') : '—' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">
                                No visitors today
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
