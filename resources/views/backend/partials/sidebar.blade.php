<aside class="w-72 hidden md:block border-r border-white/10 bg-slate-950/40">
    <div class="p-6">
        <div class="rounded-md glass cyber-glow p-4">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; ADMIN_PANEL</p>
            <p class="mt-2 text-xl font-extrabold cyber-text">CONTROL_NEXUS</p>
        </div>

        <nav class="mt-6 space-y-2 font-mono text-sm">
            <a href="{{ route('admin.dashboard') }}"
                class="block px-4 py-3 rounded-md border border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200 transition">
                ⛭ Dashboard
            </a>
            <a href="{{ route('admin.projects.index') }}"
                class="block px-4 py-3 rounded-md border border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200 transition">
                ▣ Projects
            </a>
            <a href="{{ url('/') }}" target="_blank"
                class="block px-4 py-3 rounded-md border border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200 transition">
                ↗ View Site
            </a>
        </nav>
    </div>
</aside>