<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description', 'Laravel developer portfolio: web apps, APIs, admin panels, ecommerce.')">

    <!-- FAVICONS -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-192x192.png') }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen text-slate-100">
    <div class="site-bg relative overflow-hidden">

        <!-- GRID OVERLAY -->
        <div class="absolute inset-0 cyber-grid opacity-60 pointer-events-none"></div>

        @include('partials.nav')

        <main class="pt-16 relative z-10">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>
