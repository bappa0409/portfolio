<aside class="w-72 hidden md:flex flex-col h-screen border-r border-white/10 bg-slate-950/40">

    {{-- BRAND --}}
    <div class="p-6">
        <div class="rounded-md glass cyber-glow p-4">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; ADMIN_PANEL</p>
            <p class="mt-2 text-xl font-extrabold cyber-text">CONTROL_NEXUS</p>
        </div>
    </div>

    {{-- NAV --}}
    <div class="flex-1 overflow-y-auto px-6 pb-6 font-mono text-sm">
        <div class="mb-2 text-xs tracking-widest text-white/40">PAGES</div>

        <nav class="space-y-2">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2 px-4 py-2 rounded-md border transition
               {{ request()->routeIs('admin.dashboard')
                    ? 'border-emerald-400/40 text-emerald-200 bg-emerald-400/25'
                    : 'border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200'
               }}">
                <span class="text-base">🏠</span>
                <span>Dashboard</span>
            </a>

            {{-- Projects --}}
            <a href="{{ route('admin.projects.index') }}"
               class="flex items-center gap-2 px-4 py-2 rounded-md border transition
               {{ request()->routeIs('admin.project.*')
                    ? 'border-emerald-400/40 text-emerald-200 bg-emerald-400/20'
                    : 'border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200'
               }}">
                <span class="text-base">📦</span>
                <span>Projects</span>
            </a>

            {{-- Homepage Settings --}}
            <a href="{{ route('admin.homepage.settings.edit') }}"
               class="flex items-center gap-2 px-4 py-2 rounded-md border transition
               {{ request()->routeIs('admin.homepage.settings.edit')
                    ? 'border-emerald-400/40 text-emerald-200 bg-emerald-400/25'
                    : 'border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200'
               }}">
                <span class="text-base">🛠️</span>
                <span>Homepage Settings</span>
            </a>

            {{-- About Settings --}}
            <a href="{{ route('admin.about.settings.edit') }}"
               class="flex items-center gap-2 px-4 py-2 rounded-md border transition
               {{ request()->routeIs('admin.about.settings.edit')
                    ? 'border-emerald-400/40 text-emerald-200 bg-emerald-400/25'
                    : 'border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200'
               }}">
                <span class="text-base">👤</span>
                <span>About Settings</span>
            </a>

            {{-- Divider --}}
            <div class="my-3 border-t border-white/10"></div>

            {{-- View Site --}}
            <a href="{{ url('/') }}" target="_blank"
               class="flex items-center gap-2 px-4 py-2 rounded-md border border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200 transition">
                <span class="text-base">🌐</span>
                <span>View Site</span>
            </a>

        </nav>
    </div>

</aside>
