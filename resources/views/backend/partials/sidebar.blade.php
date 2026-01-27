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

        {{-- HEADER --}}
        <div class="mb-2 text-xs tracking-widest text-white/40">PAGES</div>

        <nav class="space-y-2">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded-md border transition
               {{ request()->routeIs('admin.dashboard')
                    ? 'border-emerald-400/40 text-emerald-200 bg-emerald-400/10'
                    : 'border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200'
               }}">
                ⛭ Dashboard
            </a>

            {{-- Projects --}}
            <a href="{{ route('admin.project.index') }}"
               class="block px-4 py-2 rounded-md border transition
               {{ request()->routeIs('admin.project.*')
                    ? 'border-emerald-400/40 text-emerald-200 bg-emerald-400/10'
                    : 'border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200'
               }}">
                ▣ Projects
            </a>
            @php $dashOpen = request()->routeIs('admin.dashboards.*'); @endphp

            <div x-data="sidebarCollapse({ defaultOpen: {{ $dashOpen ? 'true' : 'false' }} })" class="space-y-2">

                <button type="button" @click="toggle()"
                    class="w-full flex items-center justify-between px-4 py-2 rounded-md border transition
                    {{ $dashOpen
                        ? 'border-emerald-400/40 text-emerald-200 bg-emerald-400/10'
                        : 'border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200'
                    }}">
                    <span class="flex items-center gap-3">
                        <span>▦</span>
                        <span>Dashboards</span>
                    </span>

                    <svg class="w-4 h-4 transition-transform duration-300"
                        :class="open ? 'rotate-180 text-emerald-200' : 'text-white/60'"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                {{-- Submenu --}}
                <div x-show="open" x-cloak
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-1"
                    class="ml-4 border-l border-white/10 pl-4">

                    <ul class="space-y-1 py-1">
                        <li>
                            <a href="#"
                            class="flex items-center gap-2 pb-1 text-white/60 transition
                                    hover:text-emerald-200 hover:translate-x-1">
                                <span class="text-white/40">→</span>
                                <span>Analytics</span>
                            </a>
                        </li>

                        <li>
                           <a href="#"
                            class="flex items-center gap-2 pb-1 text-white/60 transition
                                    hover:text-emerald-200 hover:translate-x-1">
                                <span class="text-white/40">→</span>
                                <span>Analytics</span>
                            </a>
                        </li>

                        <li>
                            <a href="#"
                            class="flex items-center gap-2 pb-1 text-white/60 transition
                                    hover:text-emerald-200 hover:translate-x-1">
                                <span class="text-white/40">→</span>
                                <span>Analytics</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- View Site --}}
            <a href="{{ url('/') }}" target="_blank"
               class="block px-4 py-2 rounded-md border border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200 transition">
                ↗ View Site
            </a>

            
            
        </nav>
    </div>
    
   
</aside>
