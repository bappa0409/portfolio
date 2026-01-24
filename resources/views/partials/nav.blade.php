<nav class="fixed top-0 inset-x-0 z-50 border-b border-white/10 bg-slate-950/60 backdrop-blur">
    <div class="mx-auto max-w-6xl px-4 py-3 flex items-center justify-between">
        <a href="{{ route('home') }}" class="font-extrabold tracking-wide text-lg">
            <span class="text-white">Bappa</span><span class="text-blue-400">Sutradhar</span>
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
