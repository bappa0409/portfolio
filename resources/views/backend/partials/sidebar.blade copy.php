<aside class="w-72 hidden md:flex flex-col h-screen border-r border-white/10 bg-slate-950/40">
    {{-- Brand --}}
    <div class="p-6">
        <div class="rounded-md glass cyber-glow p-4">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; ADMIN_PANEL</p>
            <p class="mt-2 text-xl font-extrabold cyber-text">CONTROL_NEXUS</p>
        </div>
    </div>

    {{-- Nav --}}
    <div class="flex-1 overflow-y-auto px-6 pb-6">
        <nav class="space-y-2 font-mono text-sm">
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

            {{-- Settings Dropdown --}}
            @php
                $settingsMenus = [
                    ['label' => 'Profile',  'href' => '#', 'badge' => null],
                    ['label' => 'Security', 'href' => '#', 'badge' => 'Pro'],
                    ['label' => 'System',   'href' => '#', 'badge' => 'Pro'],
                ];
            @endphp

            <div x-data="sidebarDropdown({ items: {{ count($settingsMenus) }} })" x-init="init()" class="space-y-2">
                {{-- Parent --}}
                <button type="button"
                        @click="toggle()"
                        class="w-full flex items-center justify-between px-4 py-2 rounded-md border transition
                               border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200">
                    <span class="flex items-center gap-3">
                        <span class="inline-flex items-center justify-center w-5">⚙</span>
                        <span>Settings</span>
                    </span>

                    <svg class="w-4 h-4 transition-transform duration-300"
                         :class="open ? 'rotate-180 text-emerald-200' : 'text-white/60'"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                {{-- Children (stagger open + reverse close) --}}
                <div x-show="open || closing" x-cloak class="pl-10 space-y-1">
                    @foreach($settingsMenus as $i => $item)
                        <a data-dd-item
                           href="{{ $item['href'] }}"
                           x-show="open || closing"
                           x-cloak
                           x-transition:enter="transition ease-out duration-300"
                           x-transition:enter-start="opacity-0 translate-y-2"
                           x-transition:enter-end="opacity-100 translate-y-0"
                           x-transition:leave="transition ease-in duration-200"
                           x-transition:leave-start="opacity-100 translate-y-0"
                           x-transition:leave-end="opacity-0 translate-y-2"
                           :style="`transition-delay: ${delay({{ $i }})}ms`"
                           class="flex items-center justify-between py-2 text-sm text-white/60 hover:text-emerald-200 transition">

                            <span class="flex items-center gap-2">
                                <span class="text-white/40">→</span>
                                {{ $item['label'] }}
                            </span>

                            @if($item['badge'])
                                <span class="text-[10px] px-2 py-0.5 rounded bg-blue-500/20 text-blue-200">
                                    {{ $item['badge'] }}
                                </span>
                            @endif
                        </a>
                    @endforeach
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
