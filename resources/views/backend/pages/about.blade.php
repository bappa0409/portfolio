@extends('layouts.website')
@section('title', 'Bappa Sutradhar | About')

@section('content')
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 cyber-grid opacity-40 pointer-events-none"></div>

        <section class="relative z-10 mx-auto max-w-6xl px-4 py-10">

            <!-- HEADER -->
            <div class="text-center">
                <p class="text-emerald-200/80 font-mono text-sm tracking-widest">&gt; ABOUT_PROTOCOL</p>
                <h1 class="mt-3 text-4xl md:text-5xl font-extrabold text-white cyber-text tracking-wider">
                    ABOUT_ME.EXE
                </h1>
                <p class="mt-3 text-slate-300 text-sm font-mono">Decoding the human behind the code...</p>
            </div>

            <!-- TOP GRID: TERMINAL + PROFILE -->
            <div class="mt-10 grid md:grid-cols-12 gap-6 items-start">

                <!-- TERMINAL CARD -->
                <div class="md:col-span-7 rounded-md glass cyber-glow p-6 relative">
                    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-emerald-200 font-mono">&gt;</span>
                            <h2 class="text-white font-bold tracking-wide">PROFILE_TERMINAL</h2>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-red-400/80"></span>
                            <span class="h-2 w-2 rounded-full bg-yellow-300/80"></span>
                            <span class="h-2 w-2 rounded-full bg-emerald-400/80"></span>
                        </div>
                    </div>

                    <div
                        class="mt-5 rounded-md border border-white/10 bg-slate-950/30 p-5 font-mono text-sm text-slate-200 leading-relaxed">
                        <p><span class="text-emerald-200">user</span>@<span class="text-emerald-200">bappa</span>:~$ <span
                                class="text-slate-400">whoami</span></p>
                        <p class="mt-2">Bappa Sutradhar — Assistant Programmer / Laravel Developer</p>

                        <p class="mt-4"><span class="text-emerald-200">user</span>@<span
                                class="text-emerald-200">bappa</span>:~$ <span class="text-slate-400">stack</span></p>
                        <p class="mt-2 text-slate-300">
                            Laravel • PHP • CodeIgniter • MySQL • Oracle (data/reporting) • REST API • Git • Tailwind
                        </p>

                        <p class="mt-4"><span class="text-emerald-200">user</span>@<span
                                class="text-emerald-200">bappa</span>:~$ <span class="text-slate-400">current_role</span>
                        </p>
                        <p class="mt-2 text-slate-300">
                            IT BANGLA LTD — School Management System & internal software • bug fixing • testing • production
                            support
                        </p>

                        <p class="mt-4"><span class="text-emerald-200">user</span>@<span
                                class="text-emerald-200">bappa</span>:~$ <span class="text-slate-400">projects --top</span>
                        </p>
                        <ul class="mt-2 text-slate-300 list-disc ml-5 space-y-1">
                            <li>Sales ERP System (HR, Sales, Purchase, Inventory, Accounts, RBAC)</li>
                            <li>Article 71 — News Portal with Admin Panel</li>
                            <li>Clean Solution Limited — Service Website with CMS-like Admin</li>
                        </ul>
                    </div>

                    <div class="mt-5 flex flex-wrap gap-2 text-sm">
                        @foreach (['Laravel', 'PHP', 'MySQL', 'Oracle', 'REST API', 'Git', 'SQA', 'Production Support'] as $t)
                            <span
                                class="rounded-full border border-emerald-400/15 bg-emerald-400/5 px-3 py-1 text-emerald-100/90">
                                {{ $t }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- PROFILE CARD -->
                <div class="md:col-span-5 rounded-md glass cyber-glow p-6 relative">
                    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                    <div class="flex items-center gap-2">
                        <span class="text-emerald-200">◉</span>
                        <h2 class="text-white font-bold tracking-wide">IDENTITY_NODE</h2>
                    </div>

                    <div class="mt-6 flex items-center gap-4">
                        <div class="h-16 w-16 rounded-full border border-emerald-400/20 bg-emerald-400/10 overflow-hidden">
                            {{-- Put your image here --}}
                            <img src="{{ asset('images/profile.jpg') }}" alt="Bappa Sutradhar"
                                class="h-full w-full object-cover">
                        </div>
                        <div>
                            <p class="text-white font-semibold text-lg">Bappa Sutradhar</p>
                            <p class="text-slate-300 text-sm">Assistant Programmer • Laravel Developer</p>
                            <p class="text-xs text-slate-400 font-mono mt-1">Dhaka, Bangladesh • BST (UTC+6)</p>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                            <p class="text-xs text-slate-400 font-mono">Email</p>
                            <p class="text-sm text-slate-200">sutradhar019@gmail.com</p>
                        </div>
                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                            <p class="text-xs text-slate-400 font-mono">GitHub</p>
                            <a href="https://github.com/bappa0409" target="_blank"
                                class="text-sm text-emerald-200 hover:text-emerald-100">
                                github.com/bappa0409
                            </a>
                        </div>
                    </div>

                    <div class="mt-6 rounded-md border border-white/10 bg-slate-950/30 p-5">
                        <p class="text-white font-semibold">STATUS</p>
                        <div class="mt-3 text-sm text-slate-300 space-y-2">
                            <p class="font-mono text-emerald-200">✔ Available for new projects</p>
                            <p class="text-xs text-slate-400">Usually responds within 24h</p>
                            <p class="text-xs text-slate-400">Open to collaboration</p>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('projects') }}"
                            class="flex-1 text-center rounded-md border border-white/10 bg-slate-950/30 px-4 py-3 font-semibold text-white hover:border-emerald-400/25 transition">
                            VIEW_PROJECTS
                        </a>
                        <a href="{{ route('contact') }}"
                            class="flex-1 text-center rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
                            GET_IN_TOUCH
                        </a>
                    </div>
                </div>
            </div>

            <!-- MY JOURNEY -->
            <div class="mt-10 rounded-md glass cyber-glow p-6 relative">
                <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                <div class="flex items-center gap-2">
                    <span class="text-emerald-200 font-mono">&gt;</span>
                    <h2 class="text-white font-bold tracking-wide">MY_JOURNEY.LOG</h2>
                </div>

                <div class="mt-5 text-slate-300 text-sm leading-relaxed">
                    <p>
                        I’m a Laravel-focused developer working as an Assistant Programmer in Dhaka.
                        I enjoy building real-world systems like ERP modules, management dashboards, news portals,
                        and internal business applications.
                    </p>
                    <p class="mt-3">
                        My strength is turning requirements into clean, maintainable features—database design, APIs, admin
                        panels,
                        bug fixing, testing releases, and supporting production users so systems run smoothly.
                    </p>
                </div>
            </div>

            <!-- EDUCATION + EXPERIENCE -->
            <div class="mt-10 grid md:grid-cols-12 gap-6 items-start">

                <!-- EDUCATION -->
                <div class="md:col-span-5 rounded-md glass cyber-glow p-6 relative">
                    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                    <div class="flex items-center gap-2">
                        <span class="text-emerald-200">⟡</span>
                        <h2 class="text-white font-bold tracking-wide">EDUCATION.DAT</h2>
                    </div>

                    <!-- FORMAL EDUCATION -->
                    <div class="mt-6 space-y-4">
                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                            <div class="flex items-center justify-between">
                                <p class="text-white font-semibold">BSc in CSE</p>
                                <p class="text-xs text-slate-400 font-mono">2022 — 2026</p>
                            </div>
                            <p class="text-sm text-slate-300 mt-1">
                                Southeast University (Running • Evening)
                            </p>
                        </div>

                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                            <div class="flex items-center justify-between">
                                <p class="text-white font-semibold">Diploma in Agriculture</p>
                                <p class="text-xs text-slate-400 font-mono">2014 — 2018</p>
                            </div>
                            <p class="text-sm text-slate-300 mt-1">CGPA: 3.24 / 4.00</p>
                        </div>

                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                            <div class="flex items-center justify-between">
                                <p class="text-white font-semibold">SSC</p>
                                <p class="text-xs text-slate-400 font-mono">2009 — 2014</p>
                            </div>
                            <p class="text-sm text-slate-300 mt-1">GPA: 3.81 / 5.00</p>
                        </div>
                    </div>

                    <!-- TRAINING GROUNDS (inside Education) -->
                    <div class="mt-8">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-emerald-200 text-xs font-mono">&gt;</span>
                            <p class="text-white font-semibold tracking-wide text-sm">
                                TRAINING_GROUNDS
                            </p>
                        </div>

                        <div class="space-y-3">
                            <div class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                                <p class="text-white font-semibold">Web Design</p>
                                <p class="mt-1 text-sm text-slate-300">
                                    Bangladesh Korea Technical Training Center (SEIP)
                                </p>
                                <p class="text-xs text-slate-400 font-mono mt-1">
                                    Duration: 6 months
                                </p>
                            </div>

                            <div class="rounded-md border border-white/10 bg-slate-950/30 p-4">
                                <p class="text-white font-semibold">Web Development</p>
                                <p class="mt-1 text-sm text-slate-300">
                                    Learning and Earning Development Project (LEDP)
                                </p>
                                <p class="text-xs text-slate-400 font-mono mt-1">
                                    Duration: 3 months
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- EXPERIENCE -->
                <div class="md:col-span-7 rounded-md glass cyber-glow p-6 relative">
                    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                    <div class="flex items-center gap-2">
                        <span class="text-emerald-200">⛭</span>
                        <h2 class="text-white font-bold tracking-wide">EXPERIENCE_LOG</h2>
                    </div>

                    <div class="mt-6 space-y-4">
                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-5">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="text-white font-semibold">Assistant Programmer</p>
                                    <p class="text-sm text-slate-300">IT BANGLA LTD • Paltan, Dhaka</p>
                                </div>
                                <p class="text-xs text-slate-400 font-mono">Nov 2024 — Present</p>
                            </div>
                            <ul class="mt-3 text-sm text-slate-300 list-disc ml-5 space-y-1">
                                <li>Develop & maintain School Management System and internal software</li>
                                <li>Work with Oracle database: data handling, troubleshooting, reporting</li>
                                <li>Fix bugs, test releases, support users for stable production operation</li>
                            </ul>
                        </div>

                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-5">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="text-white font-semibold">PHP Developer</p>
                                    <p class="text-sm text-slate-300">BDTASK LTD • Khilkhet, Dhaka</p>
                                </div>
                                <p class="text-xs text-slate-400 font-mono">Dec 2022 — Dec 2023</p>
                            </div>
                            <ul class="mt-3 text-sm text-slate-300 list-disc ml-5 space-y-1">
                                <li>Built ERP modules and APIs using Laravel & CodeIgniter</li>
                                <li>Added features, fixed defects, supported production stability</li>
                                <li>Collaborated with team to keep systems scalable</li>
                            </ul>
                        </div>

                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-5">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="text-white font-semibold">Intern (Developer)</p>
                                    <p class="text-sm text-slate-300">EXCEL IT AI • Mogbazar, Dhaka</p>
                                </div>
                                <p class="text-xs text-slate-400 font-mono">Nov 2021 — Apr 2022</p>
                            </div>
                            <ul class="mt-3 text-sm text-slate-300 list-disc ml-5 space-y-1">
                                <li>Learned ASP.NET MVC architecture and CRUD with SQL Server / Entity Framework</li>
                                <li>Worked with Laravel framework and APIs</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SYSTEM METRICS (SKILLS) -->
            <div class="mt-10 rounded-md glass cyber-glow p-6 relative">
                <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                <div class="flex items-center gap-2">
                    <span class="text-emerald-200">⛭</span>
                    <h2 class="text-white font-bold tracking-wide">SYSTEM_METRICS</h2>
                </div>

                <div class="mt-6 grid md:grid-cols-2 gap-6">
                    @foreach ([['Laravel / PHP', 90], ['MySQL / DB Design', 85], ['REST API', 80], ['Oracle (Reporting/Support)', 75], ['Frontend (Bootstrap/Tailwind/JS)', 72], ['SQA / Testing', 70]] as $row)
                        <div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-slate-300">{{ $row[0] }}</span>
                                <span class="text-emerald-200 font-mono">{{ $row[1] }}%</span>
                            </div>
                            <div class="mt-2 h-2 rounded-full bg-slate-950/50 border border-white/10 overflow-hidden">
                                <div class="h-full bg-emerald-400/40" style="width: {{ $row[1] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- CODE PHILOSOPHY + PASSION MODULES -->
            <div class="mt-10 grid md:grid-cols-12 gap-6 items-start">

                <div class="md:col-span-7 rounded-md glass cyber-glow p-6 relative">
                    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                    <div class="flex items-center gap-2">
                        <span class="text-emerald-200 font-mono">&gt;</span>
                        <h2 class="text-white font-bold tracking-wide">CODE_PHILOSOPHY</h2>
                    </div>

                    <div class="mt-5 text-slate-300 text-sm leading-relaxed space-y-3">
                        <p>• Clean code and maintainable structure</p>
                        <p>• Security-first mindset (validation, auth, roles/permissions)</p>
                        <p>• Performance awareness (queries, caching, efficient DB design)</p>
                        <p>• Clear communication and reliable delivery</p>
                    </div>
                </div>

                <div class="md:col-span-5 rounded-md glass cyber-glow p-6 relative">
                    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                    <div class="flex items-center gap-2">
                        <span class="text-emerald-200">⌁</span>
                        <h2 class="text-white font-bold tracking-wide">PASSION_MODULES</h2>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-5">
                            <p class="text-white font-semibold">Clean Architecture</p>
                            <p class="mt-2 text-xs text-slate-400">Readable structure, scalable modules</p>
                        </div>
                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-5">
                            <p class="text-white font-semibold">Problem Solving</p>
                            <p class="mt-2 text-xs text-slate-400">Debugging, fixes, stable releases</p>
                        </div>
                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-5">
                            <p class="text-white font-semibold">ERP Systems</p>
                            <p class="mt-2 text-xs text-slate-400">Modules, reports, business workflows</p>
                        </div>
                        <div class="rounded-md border border-white/10 bg-slate-950/30 p-5">
                            <p class="text-white font-semibold">APIs</p>
                            <p class="mt-2 text-xs text-slate-400">REST APIs for apps & integrations</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FINAL CTA -->
            <div class="mt-10 rounded-md glass cyber-glow p-8 text-center relative">
                <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                <h3 class="text-2xl font-extrabold text-white cyber-text">READY_TO_BUILD_SOMETHING_AMAZING?</h3>
                <p class="mt-3 text-slate-300 max-w-2xl mx-auto">
                    Let’s turn your ideas into reality — whether it’s a web application, business website, ERP system,
                    ecommerce platform, or something completely custom.
                </p>

                <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ route('contact') }}"
                        class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-6 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
                        START_PROJECT
                    </a>
                    <a href="{{ route('projects') }}"
                        class="rounded-md border border-white/10 bg-slate-950/30 px-6 py-3 font-semibold text-white hover:border-emerald-400/25 transition">
                        VIEW_PORTFOLIO
                    </a>
                </div>

                <p class="mt-5 text-xs text-slate-500 font-mono">⌁ Activate neural interface...</p>
            </div>

        </section>
    </div>
@endsection
