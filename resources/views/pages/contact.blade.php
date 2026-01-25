{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('title', 'Bappa Sutradhar | Contact')

@section('content')
    <div class="relative overflow-hidden page-fade">
        <div class="absolute inset-0 cyber-grid opacity-40 pointer-events-none"></div>

        <section class="relative z-10 mx-auto max-w-6xl px-4 py-10">

            <!-- HEADER -->
            <div class="text-center">
                <p class="text-emerald-200/80 font-mono text-sm tracking-widest">&gt; CONTACT_PROTOCOL</p>
                <h1 class="mt-3 text-4xl md:text-5xl font-extrabold text-white cyber-text">
                    CONTACT_INTERFACE
                </h1>
            </div>

            <!-- MAIN GRID (FIXED: md breakpoint like Home) -->
            <div class="mt-10 grid md:grid-cols-12 gap-6 items-start">

                <!-- LEFT: SEND MESSAGE -->
                <div class="md:col-span-7 rounded-md glass cyber-glow p-6 relative">
                    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                    <div class="flex items-center gap-2">
                        <span class="text-emerald-200 font-mono">&gt;</span>
                        <h2 class="text-white font-bold tracking-wide">SEND_MESSAGE</h2>
                    </div>

                    @if (session('success'))
                        <div
                            class="mt-4 rounded-md border border-emerald-400/20 bg-emerald-400/10 p-4 text-emerald-200 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form class="mt-3 space-y-2" method="POST" action="{{ route('contact.send') }}">
                        @csrf

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-mono text-slate-400">NAME</label>
                                <input name="name" value="{{ old('name') }}"
                                    class="mt-2 w-full rounded-md bg-slate-950/30 border border-white/10 px-4 py-3 text-sm text-slate-200 placeholder:text-slate-500 focus:outline-none focus:border-emerald-400/25"
                                    placeholder="Enter your name">
                                @error('name')
                                    <p class="mt-2 text-xs text-red-300">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-xs font-mono text-slate-400">EMAIL</label>
                                <input name="email" value="{{ old('email') }}"
                                    class="mt-2 w-full rounded-md bg-slate-950/30 border border-white/10 px-4 py-3 text-sm text-slate-200 placeholder:text-slate-500 focus:outline-none focus:border-emerald-400/25"
                                    placeholder="your@email.com">
                                @error('email')
                                    <p class="mt-2 text-xs text-red-300">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="text-xs font-mono text-slate-400">SUBJECT</label>
                            <input name="subject" value="{{ old('subject') }}"
                                class="mt-2 w-full rounded-md bg-slate-950/30 border border-white/10 px-4 py-3 text-sm text-slate-200 placeholder:text-slate-500 focus:outline-none focus:border-emerald-400/25"
                                placeholder="Project discussion">
                            @error('subject')
                                <p class="mt-2 text-xs text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="text-xs font-mono text-slate-400">MESSAGE</label>
                            <textarea name="message" rows="3"
                                class="mt-2 w-full rounded-md bg-slate-950/30 border border-white/10 px-4 py-3 text-sm text-slate-200 placeholder:text-slate-500 focus:outline-none focus:border-emerald-400/25"
                                placeholder="Tell me about your project...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-2 text-xs text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full rounded-md bg-emerald-400/20 border border-emerald-400/30 px-5 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
                            ✈ TRANSMIT_MESSAGE
                        </button>
                    </form>
                </div>

                <!-- RIGHT: CONTACT DATA -->
                <div class="md:col-span-5 space-y-6">
                    <div class="rounded-md glass cyber-glow p-6 relative">
                        <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                        <div class="flex items-center gap-2">
                            <span class="text-emerald-200">📒</span>
                            <h2 class="text-white font-bold tracking-wide">CONTACT_DATA</h2>
                        </div>

                        <div class="mt-6 space-y-4">
                            <div class="flex items-start gap-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                                <div
                                    class="h-10 w-10 rounded-md bg-emerald-400/10 border border-emerald-400/15 grid place-items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l9 6 9-6M4 6h16a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z"/></svg></div>
                                <div>
                                    <p class="text-xs text-slate-400 font-mono">Email</p>
                                    <p class="text-slate-200 text-sm">sutradhar019@gmail.com</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                                <div
                                    class="h-10 w-10 rounded-md bg-emerald-400/10 border border-emerald-400/15 grid place-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h2.28a1 1 0 01.95.68l1.33 3.98a1 1 0 01-.5 1.21l-1.6.8a16 16 0 007.07 7.07l.8-1.6a1 1 0 011.21-.5l3.98 1.33a1 1 0 01.68.95V19a2 2 0 01-2 2h-1C9.82 21 3 14.18 3 6V5z"/></svg></div>
                                <div>
                                    <p class="text-xs text-slate-400 font-mono">Phone</p>
                                    <p class="text-slate-200 text-sm">+880 1928040976</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                                <div
                                    class="h-10 w-10 rounded-md bg-emerald-400/10 border border-emerald-400/15 grid place-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 11.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11c0 7-7 11-7 11S5 18 5 11a7 7 0 1114 0z"/></svg></div>
                                <div>
                                    <p class="text-xs text-slate-400 font-mono">Location</p>
                                    <p class="text-slate-200 text-sm">Dhaka, Bangladesh</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 rounded-md border border-white/10 bg-slate-950/30 p-4">
                                <div
                                    class="h-10 w-10 rounded-md bg-emerald-400/10 border border-emerald-400/15 grid place-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 22a10 10 0 100-20 10 10 0 000 20z"/></svg></div>
                                <div>
                                    <p class="text-xs text-slate-400 font-mono">Timezone</p>
                                    <p class="text-slate-200 text-sm">BST (UTC+6)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SYSTEM STATUS -->
            <div class="mt-10 grid md:grid-cols-12 gap-6 items-start">
                <div class="md:col-span-7 rounded-md glass cyber-glow p-6 relative">
                    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                    <div class="flex items-center gap-2">
                        <span class="text-emerald-200">⛭</span>
                        <h2 class="text-white font-bold tracking-wide">SYSTEM_STATUS</h2>
                    </div>

                    <div class="mt-6 space-y-5">
                        @foreach ([['Full-stack Dev', 95], ['Laravel / PHP', 90], ['UI Design', 82], ['Cloud Services', 78], ['System Load', 28]] as $row)
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

                <!-- SOCIAL NETWORKS -->
                <div class="md:col-span-5 rounded-md glass cyber-glow p-6 relative">
                    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                    <div class="flex items-center gap-2">
                        <span class="text-emerald-200">⌁</span>
                        <h2 class="text-white font-bold tracking-wide">SOCIAL_NETWORKS</h2>
                    </div>

                    <div class="mt-6 grid grid-cols-4 gap-2">
        
                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/in/YOUR_USERNAME" target="_blank"
                        class="rounded-md border border-white/10 bg-slate-950/30 p-4 text-center hover:border-emerald-400/25 transition">
                            <div class="mx-auto h-10 w-10 rounded-md bg-emerald-400/10 border border-emerald-400/15 grid place-items-center text-emerald-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.45 20.45h-3.56v-5.57c0-1.33-.03-3.05-1.86-3.05-1.86 0-2.15 1.45-2.15 2.95v5.67H9.32V9h3.42v1.56h.05c.48-.9 1.66-1.86 3.42-1.86 3.66 0 4.33 2.41 4.33 5.55v6.2zM5.34 7.43a2.06 2.06 0 110-4.12 2.06 2.06 0 010 4.12zM7.12 20.45H3.56V9h3.56v11.45z"/>
                                </svg>
                            </div>
                            <p class="mt-2 text-xs text-slate-300 font-mono">LinkedIn</p>
                        </a>

                        <!-- Facebook -->
                        <a href="https://www.facebook.com/YOUR_USERNAME" target="_blank"
                        class="rounded-md border border-white/10 bg-slate-950/30 p-4 text-center hover:border-emerald-400/25 transition">
                            <div class="mx-auto h-10 w-10 rounded-md bg-emerald-400/10 border border-emerald-400/15 grid place-items-center text-emerald-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M13.5 22v-8h2.7l.4-3h-3.1V9.1c0-.87.24-1.46 1.5-1.46H16.7V5a23 23 0 00-2.5-.13c-2.47 0-4.16 1.5-4.16 4.28V11H7.5v3h2.54v8h3.46z"/>
                                </svg>
                            </div>
                            <p class="mt-2 text-xs text-slate-300 font-mono">Facebook</p>
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://wa.me/8801928040976" target="_blank"
                        class="rounded-md border border-white/10 bg-slate-950/30 p-4 text-center hover:border-emerald-400/25 transition">
                            <div class="mx-auto h-10 w-10 rounded-md bg-emerald-400/10 border border-emerald-400/15 grid place-items-center text-emerald-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.52 3.48A11.75 11.75 0 0012.06 0C5.5 0 .16 5.34.16 11.9c0 2.1.55 4.16 1.6 5.98L0 24l6.29-1.65a11.8 11.8 0 005.77 1.47h.01c6.56 0 11.9-5.34 11.9-11.9 0-3.18-1.24-6.17-3.45-8.44z"/>
                                </svg>
                            </div>
                            <p class="mt-2 text-xs text-slate-300 font-mono">WhatsApp</p>
                        </a>

                        <!-- Telegram -->
                        <a href="https://t.me/YOUR_USERNAME" target="_blank"
                        class="rounded-md border border-white/10 bg-slate-950/30 p-4 text-center hover:border-emerald-400/25 transition">
                            <div class="mx-auto h-10 w-10 rounded-md bg-emerald-400/10 border border-emerald-400/15 grid place-items-center text-emerald-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9.04 15.56l-.38 5.33c.55 0 .78-.24 1.06-.52l2.54-2.44 5.27 3.86c.97.53 1.66.25 1.9-.9L23.9 3.9c.33-1.46-.53-2.03-1.47-1.68L1.63 10.2c-1.42.55-1.4 1.33-.26 1.68l5.33 1.66L19.06 5.8c.68-.42 1.3-.19.79.23z"/>
                                </svg>
                            </div>
                            <p class="mt-2 text-xs text-slate-300 font-mono">Telegram</p>
                        </a>
                    </div>

                    <div class="mt-6 rounded-md border border-white/10 bg-slate-950/30 p-5">
                        <p class="text-white font-semibold">STATUS</p>
                        <div class="mt-3 text-sm text-slate-300 space-y-2">
                            <p class="font-mono text-emerald-200">✔ Available for new projects</p>
                            <p class="text-xs text-slate-400">Usually responds within 24h, Open to collaboration</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TECH STACK -->
            <div class="mt-10 rounded-md glass cyber-glow p-6 relative">
                <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

                <div class="flex items-center gap-2">
                    <span class="text-emerald-200 font-mono">&gt;</span>
                    <h2 class="text-white font-bold tracking-wide">TECH_STACK</h2>
                </div>

                <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
                    @foreach (['Laravel', 'PHP', 'MySQL', 'Tailwind', 'WordPress', 'SQA', 'Git', 'REST API', 'Redis', 'VPS', 'cPanel', 'JavaScript'] as $t)
                        <div
                            class="rounded-md border border-white/10 bg-slate-950/30 p-4 text-center hover:border-emerald-400/25 transition">
                            <p class="text-xs text-slate-200 font-mono">{{ $t }}</p>
                        </div>
                    @endforeach
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
