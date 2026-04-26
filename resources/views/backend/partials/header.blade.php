<header class="sticky top-0 z-20 border-b border-white/10 bg-slate-950/60 backdrop-blur">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between gap-3">

        <div class="font-mono text-sm text-slate-300">
            <span class="text-emerald-200/80">⌁</span>
            @yield('breadcrumb', 'Dashboard')
        </div>

        <div class="flex items-center gap-3">

            <div class="relative">
                @php
                    $user = auth()->user();
                    $photo = null;

                    if ($user && method_exists($user, 'profile_photo_url')) {
                        $photo = $user->profile_photo_url;
                    }
                @endphp

                @if($photo)
                    <img src="{{ $photo }}"
                         alt="{{ $user->name }}"
                         class="h-9 w-9 rounded-full object-cover border border-white/10 bg-white/5">
                @else
                    <div class="h-9 w-9 rounded-full border border-white/10 bg-white/5 flex items-center justify-center text-xs font-mono text-emerald-200">
                        {{ strtoupper(substr($user->name ?? 'A', 0, 2)) }}
                    </div>
                @endif
            </div>

            <span class="text-xs font-mono text-slate-400 hidden sm:block">
                {{ $user->name ?? 'Admin' }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="px-3 py-2 rounded-md border border-white/10 bg-white/5 hover:border-emerald-400/25 hover:text-emerald-200 transition font-mono text-xs">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>
