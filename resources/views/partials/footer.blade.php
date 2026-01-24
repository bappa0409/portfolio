<footer class="border-t border-emerald-400/15 mt-16">
    <div class="mx-auto max-w-6xl px-4 py-10
                flex flex-col md:flex-row gap-6
                items-start md:items-center justify-between">

        <!-- BRAND -->
        <div>
            <div class="font-extrabold text-lg text-white">
                <span>Bappa</span>
                <span class="text-emerald-400">Sutradhar</span>
            </div>

            <p class="text-white/60 text-sm mt-2">
                Laravel Developer — Web Apps, APIs, Admin Panels.
            </p>
        </div>

        <!-- LINKS -->
        <div class="flex gap-5 text-sm text-white/70">
            <a class="hover:text-emerald-300 transition" href="{{ route('projects') }}">Projects</a>
            <a class="hover:text-emerald-300 transition" href="{{ route('about') }}">About</a>
            <a class="hover:text-emerald-300 transition" href="{{ route('contact') }}">Contact</a>
        </div>

        <!-- COPYRIGHT -->
        <p class="text-white/50 text-sm">
            © {{ date('Y') }} Bappa Sutradhar. All rights reserved.
        </p>
    </div>
</footer>
