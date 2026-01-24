<footer class="border-t border-white/10 mt-16">
    <div class="mx-auto max-w-6xl px-4 py-10 flex flex-col md:flex-row gap-6 items-start md:items-center justify-between">
        <div>
            <div class="font-extrabold text-lg">
                <span>Your</span><span class="text-blue-400">Name</span>
            </div>
            <p class="text-slate-400 text-sm mt-2">Laravel Developer — Web Apps, APIs, Admin Panels.</p>
        </div>

        <div class="flex gap-5 text-sm text-slate-300">
            <a class="hover:text-white" href="{{ route('projects') }}">Projects</a>
            <a class="hover:text-white" href="{{ route('about') }}">About</a>
            <a class="hover:text-white" href="{{ route('contact') }}">Contact</a>
        </div>

        <p class="text-slate-500 text-sm">© {{ date('Y') }} YourName. All rights reserved.</p>
    </div>
</footer>
