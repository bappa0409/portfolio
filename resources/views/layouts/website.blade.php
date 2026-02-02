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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body class="min-h-screen text-slate-100">
    <div class="site-bg relative">

        <!-- GRID OVERLAY -->
        <div class="absolute inset-0 cyber-grid opacity-60 pointer-events-none"></div>

        @include('partials.nav')

        <main class="pt-16 relative z-10">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @stack('scripts')
    <script>
        // ---- Toastify helper
        const toast = (type, message) => {
            const isSuccess = type === 'success';

            Toastify({
                text: `
                    <div style="display:flex;align-items:baseline;gap:6px;">
                        <span style="font-size:15px;">
                            ${isSuccess ? '✔️' : '⚠️'}
                        </span>
                        <span>${message}</span>
                    </div>
                `,
                duration: 5000,
                gravity: "bottom",
                position: "right",
                close: false,
                stopOnFocus: true,
                escapeMarkup: false,
                style: {
                    background: isSuccess ? '#16a34a' : '#dc2626',
                    color: '#ffffff',
                    borderRadius: '0.375rem',
                    fontSize: '14px',
                },
            }).showToast();
        };
    </script>
</body>
</html>