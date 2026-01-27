<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-white">

<div class="relative min-h-screen">
    <div class="absolute inset-0 cyber-grid opacity-30 pointer-events-none"></div>

    <div class="site-bg relative overflow-hidden relative z-10 flex">

        <!-- SIDEBAR -->
        @include('backend.partials.sidebar')
        
        <!-- MAIN -->
        <main class="flex-1">

            <!-- TOPBAR -->
            @include('backend.partials.header')

            <div class="max-w-6xl mx-auto px-4 py-8">
                @if(session('success'))
                    <div class="mb-5 rounded-md border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-emerald-100">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</div>

</body>
</html>
