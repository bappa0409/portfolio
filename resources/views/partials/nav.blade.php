<nav
    class="fixed top-0 inset-x-0 z-50
            bg-black/60 backdrop-blur-lg
            border-b border-emerald-400/20">
    <div class="mx-auto max-w-6xl px-4 py-3 flex items-center justify-between gap-3">

        <!-- LOGO -->
        <a href="{{ route('home') }}" class="flex items-center gap-4 group select-none focus:outline-none focus-visible:outline-none">
            <!-- LOGO BOX -->
            <div class="relative w-14 h-10 shrink-0">
                <!-- Outer Frame -->
                <div class="absolute inset-0 rounded-md border-2 border-emerald-400/60 bg-white/5 backdrop-blur-sm">
                    <!-- Corner lines -->
                    <div class="absolute -top-1 -left-1 w-3 h-3 border-t-2 border-l-2 border-emerald-400"></div>
                    <div class="absolute -top-1 -right-1 w-3 h-3 border-t-2 border-r-2 border-emerald-400"></div>
                    <div class="absolute -bottom-1 -left-1 w-3 h-3 border-b-2 border-l-2 border-emerald-400"></div>
                    <div class="absolute -bottom-1 -right-1 w-3 h-3 border-b-2 border-r-2 border-emerald-400"></div>
                </div>

                <!-- Inner box -->
                <div class="absolute inset-1 rounded-md bg-emerald-400/10 flex items-center justify-center">
                    <span class="text-2xl font-bold font-mono text-emerald-300 tracking-widest tracking-[-2px]">
                        B.S
                    </span>
                </div>
            </div>

            <!-- TEXT PART -->
            <div class="hidden sm:block leading-tight">
                <div
                    class="text-xl font-bold font-mono bg-gradient-to-r from-emerald-400 via-cyan-300 to-emerald-400 bg-clip-text text-transparent">
                    BAPPA SUTRADHAR
                </div>
                <div class="text-xs text-emerald-300/80 font-mono tracking-wider">
                    &gt; Laravel Developer<span class="animate-pulse">_</span>
                </div>
            </div>
        </a>

        <!-- DESKTOP MENU -->
        <div class="hidden md:flex items-center gap-2 text-sm font-mono">
            @php
                $linkBase = 'relative rounded-md px-3 py-2 transition border border-transparent';
                $linkHover = 'hover:border-emerald-400/20 hover:bg-emerald-400/5 hover:text-emerald-200';
                $linkIdle = 'text-white/70';
                $linkActive = 'text-emerald-200 border-emerald-400/25 bg-emerald-400/10';
            @endphp

            <a href="{{ route('home') }}"
                class="{{ $linkBase }} {{ request()->routeIs('home') ? $linkActive : $linkIdle . ' ' . $linkHover }}">
                <span class="text-emerald-200/90">&gt;</span> home
            </a>

            <a href="{{ route('projects') }}"
                class="{{ $linkBase }} {{ request()->routeIs('projects*') ? $linkActive : $linkIdle . ' ' . $linkHover }}">
                <span class="text-emerald-200/90">&gt;</span> projects
            </a>

            <a href="{{ route('about') }}"
                class="{{ $linkBase }} {{ request()->routeIs('about') ? $linkActive : $linkIdle . ' ' . $linkHover }}">
                <span class="text-emerald-200/90">&gt;</span> about
            </a>

            <a href="{{ route('contact') }}"
                class="{{ $linkBase }} {{ request()->routeIs('contact') ? $linkActive : $linkIdle . ' ' . $linkHover }}">
                <span class="text-emerald-200/90">&gt;</span> contact
            </a>

            <div class="w-px h-6 bg-white/10 mx-2"></div>

            <!-- DOWNLOAD CV (secondary) -->
            <a href="{{ asset('cv/Bappa_Sutradhar_CV.pdf') }}" target="_blank"
                class="rounded-md border border-cyan-400/30 bg-cyan-400/10 px-4 py-2 font-semibold text-cyan-200
                      hover:bg-cyan-400/20 hover:border-cyan-400/40 transition focus:outline-none focus:ring-2 focus:ring-cyan-400/30">
                ⭳ Download CV
            </a>

            <!-- HIRE ME (primary) -->
            <a href="{{ route('contact') }}"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 font-semibold text-emerald-100
                      hover:bg-emerald-400/30 hover:border-emerald-400/40 transition cyber-glow focus:outline-none focus:ring-2 focus:ring-emerald-400/30">
                Hire Me
            </a>
        </div>

        <!-- MOBILE ACTIONS -->
        <div class="md:hidden flex items-center gap-2">
            <a href="{{ asset('cv/Bappa_Sutradhar_CV.pdf') }}" target="_blank"
                class="rounded-md border border-cyan-400/30 bg-cyan-400/10 px-3 py-2 text-xs font-semibold text-cyan-200
                      hover:bg-cyan-400/20 transition">
                ⭳ CV
            </a>

            <a href="{{ route('contact') }}"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-3 py-2 text-xs font-semibold text-emerald-100
                      hover:bg-emerald-400/30 transition cyber-glow">
                Hire Me
            </a>
        </div>

    </div>
</nav>
