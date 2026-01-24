@extends('layouts.app')

@section('title','Bappa Sutradhar | Home')

@section('content')

<!-- HERO SECTION -->
<section class="mx-auto max-w-6xl px-4 py-8">
    <div class="grid md:grid-cols-[7fr_3fr] items-center gap-10">

        <!-- LEFT CONTENT -->
        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-white">
                Laravel Developer — Build Fast, Secure Web Apps
            </h1>

            <p class="mt-4 text-lg text-slate-300">
                I build scalable Laravel web apps, APIs, admin panels, ERP solutions, news portals, ecommerce platforms, business websites, and custom management systems. I also work with WordPress customization and theme development.
            </p>

            <div class="mt-7 flex gap-3">
                <a href="{{ route('contact') }}"
                   class="rounded-lg bg-blue-500 hover:bg-blue-400 px-5 py-3 font-semibold text-slate-950">
                    Hire Me
                </a>

                <a href="{{ route('projects') }}"
                   class="rounded-lg border border-white/15 hover:border-white/30 px-5 py-3 font-semibold text-white">
                    View Projects
                </a>
            </div>

            <div class="mt-7 flex flex-wrap gap-3 text-sm">
                <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-slate-200">
                    3+ Years Experience
                </span>
                <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-slate-200">
                    Laravel • Codeigniter • PHP • MySQL
                </span>
                <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-slate-200">
                    REST APIs
                </span>
                <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-slate-200">
                    JaraScript
                </span>
            </div>
        </div>

        <!-- RIGHT CARD WITH IMAGE -->
        <div class="rounded-lg border border-white/10 bg-white/5 p-4 text-white">

            <!-- PROFILE IMAGE -->
            <div class="flex justify-center mb-3">
                <img
                    src="{{ asset('images/profile.jpg') }}"
                    alt="Laravel Developer"
                    class="max-h-[300px] rounded-lg object-cover shadow-lg"
                >
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-300 text-sm">Available for</p>
                    <p class="text-xl font-bold">Freelance</p>
                </div>

                <span class="text-xs rounded-full bg-emerald-500/15 border border-emerald-400/20 px-3 py-1 text-emerald-300">
                    Open
                </span>
            </div>

            <div class="mt-3 grid grid-cols-3 gap-2 text-center">
                <div class="rounded-lg border border-white/10 bg-slate-950/40 p-2">
                    <p class="text-sm font-semibold">20+</p>
                    <p class="text-xs text-slate-400">Projects</p>
                </div>

                <div class="rounded-lg border border-white/10 bg-slate-950/40 p-2">
                    <p class="text-sm font-semibold">Fast</p>
                    <p class="text-xs text-slate-400">Delivery</p>
                </div>

                <div class="rounded-lg border border-white/10 bg-slate-950/40 p-2">
                    <p class="text-sm font-semibold">Clean</p>
                    <p class="text-xs text-slate-400">Code</p>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('contact') }}"
                   class="block text-center rounded-lg bg-white text-slate-950 font-semibold px-4 py-2 hover:bg-slate-100">
                    Get a Free Quote
                </a>
            </div>
        </div>
    </div>
</section>


<!-- SERVICES -->
<section class="mx-auto max-w-6xl px-4 py-12">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">Services</h2>
        <p class="mt-2 text-slate-300 max-w-2xl">
            I provide complete web development and quality assurance services,
            focused on scalable architecture, clean code, and reliable delivery.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">

        <!-- Laravel Web Applications (Includes Ecommerce) -->
        <div class="rounded-md border border-white/10 bg-white/5 p-6 hover:border-blue-500/40 transition">
            <div class="text-3xl mb-3">🧩</div>
            <h3 class="font-semibold text-lg text-white">Laravel Web Applications</h3>
            <p class="mt-2 text-slate-300 text-sm">
                Custom Laravel web applications including ecommerce platforms,
                admin panels, dashboards, authentication, roles & permissions,
                and scalable backend systems.
            </p>
        </div>

        <!-- ERP & Management Systems -->
        <div class="rounded-md border border-white/10 bg-white/5 p-6 hover:border-blue-500/40 transition">
            <div class="text-3xl mb-3">🏢</div>
            <h3 class="font-semibold text-lg text-white">ERP & Management Systems</h3>
            <p class="mt-2 text-slate-300 text-sm">
                ERP solutions, inventory management, HR, accounting modules,
                and custom business management systems tailored to your workflow.
            </p>
        </div>

        <!-- REST API Development -->
        <div class="rounded-md border border-white/10 bg-white/5 p-6 hover:border-blue-500/40 transition">
            <div class="text-3xl mb-3">🔗</div>
            <h3 class="font-semibold text-lg text-white">REST API Development</h3>
            <p class="mt-2 text-slate-300 text-sm">
                Secure REST APIs for mobile apps, third-party integrations,
                authentication systems, and scalable backend services.
            </p>
        </div>

        <!-- CMS & News Portals -->
        <div class="rounded-md border border-white/10 bg-white/5 p-6 hover:border-blue-500/40 transition">
            <div class="text-3xl mb-3">📰</div>
            <h3 class="font-semibold text-lg text-white">CMS & News Portals</h3>
            <p class="mt-2 text-slate-300 text-sm">
                News portals and CMS platforms with role-based editors,
                SEO-friendly URLs, media management, and publishing workflows.
            </p>
        </div>

        <!-- WordPress Customization -->
        <div class="rounded-md border border-white/10 bg-white/5 p-6 hover:border-blue-500/40 transition">
            <div class="text-3xl mb-3">🎨</div>
            <h3 class="font-semibold text-lg text-white">WordPress Customization</h3>
            <p class="mt-2 text-slate-300 text-sm">
                WordPress theme development and customization, performance optimization,
                plugin integration, and business website development.
            </p>
        </div>

        <!-- Software Quality Assurance -->
        <div class="rounded-md border border-white/10 bg-white/5 p-6 hover:border-blue-500/40 transition">
            <div class="text-3xl mb-3">✅</div>
            <h3 class="font-semibold text-lg text-white">Software Quality Assurance (SQA)</h3>
            <p class="mt-2 text-slate-300 text-sm">
                Manual testing, functional and regression testing, bug reporting,
                and quality checks to ensure stable, secure, and reliable applications.
            </p>
        </div>

    </div>

    <!-- CTA -->
    <div class="mt-10 text-center">
        <a href="{{ route('contact') }}"
           class="inline-block rounded-lg bg-blue-500 hover:bg-blue-400 px-6 py-3 font-semibold text-slate-950">
            Discuss Your Project
        </a>
    </div>
</section>


<!-- PROJECTS -->
<section class="mx-auto max-w-6xl px-4 py-10">
    <div class="flex items-end justify-between gap-4">
        <h2 class="text-2xl font-bold text-white">Featured Projects</h2>
        <a href="{{ route('projects') }}"
           class="text-sm font-semibold text-blue-400 hover:text-blue-300">
            See all →
        </a>
    </div>

    <div class="mt-6 grid md:grid-cols-3 gap-5">
        @foreach ($projects as $p)
            <a href="{{ route('projects.show', $p['slug']) }}"
               class="block rounded-md border border-white/10 bg-white/5 overflow-hidden hover:border-white/20 transition">
                <div class="h-36 bg-gradient-to-br from-blue-500/20 to-slate-950"></div>

                <div class="p-5">
                    <h3 class="font-semibold text-white">{{ $p['title'] }}</h3>
                    <p class="mt-2 text-slate-300 text-sm">{{ $p['subtitle'] }}</p>

                    <div class="mt-4 flex flex-wrap gap-1">
                        @foreach ($p['stack'] as $tag)
                            <span class="text-xs rounded-full bg-slate-950/60 border border-white/10 px-2 py-1 text-slate-200">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>

                    <p class="mt-4 text-xs text-slate-400">
                        Status: {{ $p['status'] }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>
</section>

<!-- CTA -->
<section class="mx-auto max-w-6xl px-4 py-10">
    <div class="rounded-md border border-white/10 bg-gradient-to-br from-blue-500/15 to-white/5 p-8
                flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div>
            <h3 class="text-xl font-bold text-white">Have a project in mind?</h3>
            <p class="text-slate-300 mt-2">
                Let’s discuss your requirements and build something great.
            </p>
        </div>

        <a href="{{ route('contact') }}"
           class="rounded-lg bg-blue-500 hover:bg-blue-400 px-5 py-3 font-semibold text-slate-950">
            Let’s Talk
        </a>
    </div>
</section>

@endsection
