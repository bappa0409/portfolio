<nav class="fixed top-0 inset-x-0 z-50 border-b border-emerald-400/15
            bg-black/45 backdrop-blur-md">
    <div class="mx-auto max-w-6xl px-4 py-3 flex items-center justify-between">

        <!-- LOGO -->
        <a href="{{ route('home') }}"
           class="flex items-center space-x-4 group select-none">

            <!-- LOGO BOX -->
            <div class="relative w-14 h-10">

                <!-- Outer Frame -->
                <div class="absolute inset-0 border-2 border-emerald-400/60 rounded-md
                            bg-white/5 backdrop-blur-sm">

                    <!-- Corner lines -->
                    <div class="absolute -top-1 -left-1 w-3 h-3 border-t-2 border-l-2 border-emerald-400"></div>
                    <div class="absolute -top-1 -right-1 w-3 h-3 border-t-2 border-r-2 border-emerald-400"></div>
                    <div class="absolute -bottom-1 -left-1 w-3 h-3 border-b-2 border-l-2 border-emerald-400"></div>
                    <div class="absolute -bottom-1 -right-1 w-3 h-3 border-b-2 border-r-2 border-emerald-400"></div>
                </div>

                <!-- Inner box -->
                <div class="absolute inset-1 bg-emerald-400/10 rounded-md
                            flex items-center justify-center">

                    <span class="text-2xl font-bold font-mono text-emerald-400 tracking-widest">
                        B.S
                    </span>
                </div>
            </div>

            <!-- TEXT PART -->
            <div class="hidden sm:block leading-tight">
                <div class="text-xl font-bold font-mono
                            bg-gradient-to-r from-emerald-400 via-cyan-300 to-emerald-400
                            bg-clip-text text-transparent">
                    BAPPA SUTRADHAR
                </div>
                <div class="text-xs text-emerald-300/80 font-mono tracking-wider">
                    &gt; Laravel Developer_
                </div>
            </div>
        </a>


        <!-- DESKTOP MENU -->
        <div class="hidden md:flex items-center gap-6 text-sm text-white/70">
            <a class="hover:text-emerald-200 transition" href="{{ route('home') }}">Home</a>
            <a class="hover:text-emerald-200 transition" href="{{ route('projects') }}">Projects</a>
            <a class="hover:text-emerald-200 transition" href="{{ route('about') }}">About</a>
            <a class="hover:text-emerald-200 transition" href="{{ route('contact') }}">Contact</a>

            <a href="{{ route('contact') }}"
               class="rounded-md bg-emerald-400/20 border border-emerald-400/30
                      px-4 py-2 font-semibold text-emerald-100
                      hover:bg-emerald-400/30 transition cyber-glow">
                Hire Me
            </a>
        </div>

        <!-- MOBILE CTA -->
        <a href="{{ route('contact') }}"
           class="md:hidden rounded-md bg-emerald-400/20 border border-emerald-400/30
                  px-3 py-2 text-sm font-semibold text-emerald-100
                  hover:bg-emerald-400/30 cyber-glow">
            Hire Me
        </a>
    </div>
</nav>
