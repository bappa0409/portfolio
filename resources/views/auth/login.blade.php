<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Auth')</title>

    <!-- FAVICONS -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-192x192.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-white">

<div class="site-bg relative min-h-screen overflow-hidden">

    <div class="absolute inset-0 bg-black/70"></div>

    <div class="absolute inset-0 cyber-grid opacity-40 pointer-events-none"></div>

    <div class="relative z-10 min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-sm">
            <div class="rounded-md glass cyber-glow p-6 relative">
                <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                <div class="text-center">
                    <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; AUTH_PROTOCOL</p>
                    <h1 class="mt-2 text-2xl font-extrabold text-white cyber-text tracking-wide">
                        SYSTEM_LOGIN
                    </h1>
                    <p class="mt-2 text-sm text-slate-400">
                        Authorized access only.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mt-4 rounded-md border border-red-400/30 bg-red-400/10 px-3 py-2 text-sm text-red-200">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">
                            EMAIL_ADDRESS
                        </label>
                        <input type="email" name="email" required autofocus
                               class="w-full rounded-md border border-white/10 bg-slate-950/50 px-3 py-1 text-white">
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">
                            ACCESS_KEY
                        </label>
                        <input type="password" name="password" required
                               class="w-full rounded-md border border-white/10 bg-slate-950/50 px-3 py-1 text-white">
                    </div>

                    <div class="flex items-center justify-between text-xs font-mono text-slate-400">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="remember"
                                   class="rounded border-white/20 bg-slate-950/40 text-emerald-400">
                            Remember session
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="hover:text-emerald-200 transition">
                                Recover access
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                            class="w-full rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
                        INITIATE_LOGIN
                    </button>
                </form>

                <p class="mt-6 text-center text-xs text-slate-500 font-mono">
                    ⌁ Secure channel • encrypted handshake
                </p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
