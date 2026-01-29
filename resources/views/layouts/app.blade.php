<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon-192x192.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen overflow-hidden bg-slate-950 text-white">

    <div class="relative h-screen overflow-hidden">
        <div class="absolute inset-0 cyber-grid opacity-30 pointer-events-none"></div>

        <div class="site-bg relative z-10 h-screen flex overflow-hidden">

            @include('backend.partials.sidebar')

            <main class="flex-1 min-w-0 h-screen flex flex-col overflow-hidden">

                @include('backend.partials.header')

                <div class="flex-1 overflow-y-auto">
                    <div class="max-w-6xl mx-auto px-4 py-8">
                        @if(session('success'))
                        <div
                            class="mb-5 rounded-md border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-emerald-100">
                            {{ session('success') }}
                        </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> 
     @stack('scripts')
</body>
</html>