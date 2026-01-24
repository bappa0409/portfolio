<nav class="fixed top-0 inset-x-0 z-50 border-b border-white/10 bg-slate-950/60 backdrop-blur">
    <div class="mx-auto max-w-6xl px-4 py-3 flex items-center justify-between">
        <a href="{{ route('home') }}" class="font-extrabold tracking-wide text-lg">
            <span class="text-white">Bappa</span><span class="text-blue-400">Sutradhar</span>
        </a>
        <a class="flex items-center space-x-4 group" data-cursor="pointer" href="/"><div class="relative w-14 h-14" tabindex="0" style="transform: scale(1.04876);">
            <div class="absolute inset-0 border-2 border-emerald-400/60 rounded-lg bg-slate-900/70 backdrop-blur-sm">
                <div class="absolute -top-1 -left-1 w-3 h-3 border-t-2 border-l-2 border-emerald-400"></div>
                <div class="absolute -top-1 -right-1 w-3 h-3 border-t-2 border-r-2 border-emerald-400"></div>
                <div class="absolute -bottom-1 -left-1 w-3 h-3 border-b-2 border-l-2 border-emerald-400"></div>
                <div class="absolute -bottom-1 -right-1 w-3 h-3 border-b-2 border-r-2 border-emerald-400"></div>
            </div>
            <div class="absolute inset-1 bg-emerald-400/10 rounded-md flex items-center justify-center">
                <span class="text-2xl font-bold font-mono text-emerald-400 transition-colors duration-75" style="transform: translateX(0.93544px) translateY(-0.93544px);">B.C</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-emerald-400/20 to-transparent h-1" style="transform: translateY(36.792px);">
            </div>
        </div>
        <div class="hidden sm:block">
            <div class="text-xl font-bold bg-gradient-to-r from-emerald-400 via-cyan-300 to-emerald-400 bg-clip-text text-transparent font-mono" style="background-position: 55.2333% center;">CHEGEBB</div>
            <div class="text-xs text-emerald-300/80 font-mono tracking-wider">&gt; Full Stack Developer_</div>
        </div>
    </a>

        <div class="hidden md:flex items-center gap-6 text-sm text-slate-200">
            <a class="hover:text-white" href="{{ route('home') }}">Home</a>
            <a class="hover:text-white" href="{{ route('projects') }}">Projects</a>
            <a class="hover:text-white" href="{{ route('about') }}">About</a>
            <a class="hover:text-white" href="{{ route('contact') }}">Contact</a>

            <a href="{{ route('contact') }}"
               class="rounded-lg bg-blue-500 hover:bg-blue-400 px-4 py-2 font-semibold text-slate-950">
                Hire Me
            </a>
        </div>

        <a href="{{ route('contact') }}"
           class="md:hidden rounded-lg bg-blue-500 hover:bg-blue-400 px-3 py-2 text-sm font-semibold text-slate-950">
            Hire Me
        </a>
    </div>
</nav>

