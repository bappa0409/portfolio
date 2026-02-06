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
               {{ request()->routeIs('admin.projects.*')
                    ? 'border-emerald-400/40 text-emerald-200 bg-emerald-400/20'
                    : 'border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200'
               }}">
                <span class="text-base">📦</span>
                <span>Projects</span>
            </a>

           {{-- Website Settings --}}
            @php
                $websiteOpen = request()->routeIs('admin.website.*')
                            || request()->routeIs('admin.homepage.*')
                            || request()->routeIs('admin.about.*')
                            || request()->routeIs('admin.contact.*');
            @endphp

            <div x-data="{ open: {{ $websiteOpen ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-2 rounded-md border
                    {{ $websiteOpen
                        ? 'border-emerald-400/40 text-emerald-200 bg-emerald-400/25'
                        : 'border-white/10 bg-white/5 hover:border-emerald-400/25'
                    }}">
                    <span class="flex items-center gap-2">
                        🛠️ <span>Website Settings</span>
                    </span>
                    <span x-text="open ? '−' : '+'"></span>
                </button>

                <div x-show="open" x-collapse class="mt-2 ml-3 space-y-1">
                    {{-- Homepage --}}
                    <a href="{{ route('admin.homepage.edit') }}"
                    class="group flex items-center gap-2 px-3 py-1 text-sm rounded transition
                            {{ request()->routeIs('admin.homepage.*')
                                    ? 'text-emerald-300'
                                    : 'text-white/60 hover:text-emerald-200'
                            }}">
                        <span class="transition-transform duration-200 group-hover:translate-x-1">→</span>
                        <span>Homepage</span>
                    </a>

                    {{-- About --}}
                    <a href="{{ route('admin.about.edit') }}"
                    class="group flex items-center gap-2 px-3 py-1 text-sm rounded transition
                            {{ request()->routeIs('admin.about.*')
                                    ? 'text-emerald-300'
                                    : 'text-white/60 hover:text-emerald-200'
                            }}">
                        <span class="transition-transform duration-200 group-hover:translate-x-1">→</span>
                        <span>About Page</span>
                    </a>

                    {{-- Contact --}}
                    <a href="{{ route('admin.contact.edit') }}"
                    class="group flex items-center gap-2 px-3 py-1 text-sm rounded transition
                            {{ request()->routeIs('admin.contact.*')
                                    ? 'text-emerald-300'
                                    : 'text-white/60 hover:text-emerald-200'
                            }}">
                        <span class="transition-transform duration-200 group-hover:translate-x-1">→</span>
                        <span>Contact Page</span>
                    </a>
                </div>
            </div>

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
