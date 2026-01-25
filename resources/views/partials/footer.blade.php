<footer class="relative border-t border-emerald-400/15 bg-black/50 backdrop-blur-lg mt-20">
    <div class="absolute inset-0 cyber-grid opacity-20 pointer-events-none"></div>

    <div class="relative z-10 mx-auto max-w-6xl px-4 py-12
                grid gap-10 md:grid-cols-4">

        <!-- BRAND -->
        <div>
            <div class="flex items-center gap-2 font-mono">
                <span class="text-xl font-extrabold text-white">Bappa</span>
                <span class="text-xl font-extrabold text-emerald-400">Sutradhar</span>
            </div>

            <p class="mt-2 text-sm text-white/65">
                Laravel Developer • ERP • REST APIs • Web Systems
            </p>

            <p class="mt-3 text-xs text-white/40 font-mono">
                &gt; Building reliable production-grade software
            </p>
        </div>

        <!-- QUICK LINKS -->
        <div>
            <p class="text-sm font-semibold text-white mb-3 font-mono">
                QUICK_LINKS
            </p>

            <ul class="space-y-2 text-sm text-white/70">
                <li><a href="{{ route('home') }}" class="hover:text-emerald-300 transition">&gt; Home</a></li>
                <li><a href="{{ route('projects') }}" class="hover:text-emerald-300 transition">&gt; Projects</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-emerald-300 transition">&gt; About</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-emerald-300 transition">&gt; Contact</a></li>
            </ul>
        </div>

        <!-- SOCIAL + CV -->
        <div>
            <p class="text-sm font-semibold text-white mb-3 font-mono">
                CONNECT
            </p>

            <div class="flex items-center justify-between gap-3">
                
                {{-- <!-- LinkedIn -->
                <a href="https://github.com/bappasutradhar947" target="_blank"
                   class="h-9 w-9 rounded-md bg-slate-950/40 border border-white/10
                          flex items-center justify-center hover:border-emerald-400/40 transition">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.45 20.45h-3.56v-5.57c0-1.33-.03-3.05-1.86-3.05-1.86 0-2.15 1.45-2.15 2.95v5.67H9.32V9h3.42v1.56h.05c.48-.9 1.66-1.86 3.42-1.86 3.66 0 4.33 2.41 4.33 5.55v6.2zM5.34 7.43a2.06 2.06 0 110-4.12 2.06 2.06 0 010 4.12zM7.12 20.45H3.56V9h3.56v11.45z"/>
                        </svg>
                </a>

                <!-- Facebook -->
                <a href="#" target="_blank"
                   class="h-9 w-9 rounded-md bg-slate-950/40 border border-white/10
                          flex items-center justify-center hover:border-emerald-400/40 transition">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.5 22v-8h2.7l.4-3h-3.1V9.1c0-.87.24-1.46 1.5-1.46H16.7V5a23 23 0 00-2.5-.13c-2.47 0-4.16 1.5-4.16 4.28V11H7.5v3h2.54v8h3.46z"/>
                        </svg>
                </a>

                <!-- WhatsApp -->
                <a href="https://wa.me/8801928040976" target="_blank"
                class="h-9 w-9 rounded-md bg-slate-950/40 border border-white/10
                        flex items-center justify-center
                        text-white/80 hover:text-emerald-300
                        hover:border-emerald-400/40 transition">

                    <svg viewBox="0 0 32 32"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 fill-current">
                        <path d="M26.576 5.363c-2.69-2.69-6.406-4.354-10.511-4.354-8.209 0-14.865 6.655-14.865 14.865 0 2.732 0.737 5.291 2.022 7.491l-0.038-0.070-2.109 7.702 7.879-2.067c2.051 1.139 4.498 1.809 7.102 1.809h0.006c8.209-0.003 14.862-6.659 14.862-14.868 0-4.103-1.662-7.817-4.349-10.507zM16.062 28.228h-0.006c-2.319 0-4.489-0.64-6.342-1.753l0.056 0.031-0.451-0.267-4.675 1.227 1.247-4.559-0.294-0.467c-1.185-1.862-1.889-4.131-1.889-6.565 0-6.822 5.531-12.353 12.353-12.353s12.353 5.531 12.353 12.353c0 6.822-5.53 12.353-12.353 12.353zM22.838 18.977c-0.371-0.186-2.197-1.083-2.537-1.208-0.341-0.124-0.589-0.185-0.837 0.187-0.246 0.371-0.958 1.207-1.175 1.455-0.216 0.249-0.434 0.279-0.805 0.094-1.15-0.466-2.138-1.087-2.997-1.852l0.010 0.009c-0.799-0.74-1.484-1.587-2.037-2.521l-0.028-0.052c-0.216-0.371-0.023-0.572 0.162-0.757 0.167-0.166 0.372-0.434 0.557-0.65 0.146-0.179 0.271-0.384 0.366-0.604l0.006-0.017c0.043-0.087 0.068-0.188 0.068-0.296 0-0.131-0.037-0.253-0.101-0.357l0.002 0.003c-0.094-0.186-0.836-2.014-1.145-2.758-0.302-0.724-0.609-0.625-0.836-0.637-0.216-0.010-0.464-0.012-0.712-0.012-0.395 0.010-0.746 0.188-0.988 0.463l-0.001 0.002c-0.802 0.761-1.3 1.834-1.3 3.023 0 0.026 0 0.053 0.001 0.079l-0-0.004c0.131 1.467 0.681 2.784 1.527 3.857l-0.012-0.015c1.604 2.379 3.742 4.282 6.251 5.564l0.094 0.043c0.548 0.248 1.25 0.513 1.968 0.74l0.149 0.041c0.442 0.14 0.951 0.221 1.479 0.221 0.303 0 0.601-0.027 0.889-0.078l-0.031 0.004c1.069-0.223 1.956-0.868 2.497-1.749l0.009-0.017c0.165-0.366 0.261-0.793 0.261-1.242 0-0.185-0.016-0.366-0.047-0.542l0.003 0.019c-0.092-0.155-0.34-0.247-0.712-0.434z"/>
                    </svg>
                </a>
                <!-- Telegram -->
                <a href="https://wa.me/8801928040976" target="_blank"
                   class="h-9 w-9 rounded-md bg-slate-950/40 border border-white/10
                          flex items-center justify-center hover:border-emerald-400/40 transition">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M9.04 15.56l-.38 5.33c.55 0 .78-.24 1.06-.52l2.54-2.44 5.27 3.86c.97.53 1.66.25 1.9-.9L23.9 3.9c.33-1.46-.53-2.03-1.47-1.68L1.63 10.2c-1.42.55-1.4 1.33-.26 1.68l5.33 1.66L19.06 5.8c.68-.42 1.3-.19.79.23z"/>
                        </svg>
                </a> --}}
                

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/in/YOUR_USERNAME" target="_blank"
                class="rounded-md bg-slate-950/30 text-center hover:border-emerald-400/25 transition">
                    <div class="mx-auto h-10 w-10 rounded-md bg-emerald-400/10 border border-emerald-400/15 grid place-items-center text-emerald-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.45 20.45h-3.56v-5.57c0-1.33-.03-3.05-1.86-3.05-1.86 0-2.15 1.45-2.15 2.95v5.67H9.32V9h3.42v1.56h.05c.48-.9 1.66-1.86 3.42-1.86 3.66 0 4.33 2.41 4.33 5.55v6.2zM5.34 7.43a2.06 2.06 0 110-4.12 2.06 2.06 0 010 4.12zM7.12 20.45H3.56V9h3.56v11.45z"/>
                        </svg>
                    </div>
                </a>

                <!-- Facebook -->
                <a href="https://www.facebook.com/YOUR_USERNAME" target="_blank"
                class="rounded-md bg-slate-950/30 text-center hover:border-emerald-400/25 transition">
                    <div class="mx-auto h-10 w-10 rounded-md bg-emerald-400/10 border border-emerald-400/15 grid place-items-center text-emerald-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.5 22v-8h2.7l.4-3h-3.1V9.1c0-.87.24-1.46 1.5-1.46H16.7V5a23 23 0 00-2.5-.13c-2.47 0-4.16 1.5-4.16 4.28V11H7.5v3h2.54v8h3.46z"/>
                        </svg>
                    </div>
                </a>

                <!-- WhatsApp -->
                <a href="https://wa.me/8801928040976" target="_blank"
                class="rounded-md bg-slate-950/30 text-center hover:border-emerald-400/25 transition">
                    <div class="mx-auto h-10 w-10 rounded-md bg-emerald-400/10 border border-emerald-400/15 grid place-items-center text-emerald-200">
                        <svg viewBox="0 0 32 32"
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 fill-current">
                            <path d="M26.576 5.363c-2.69-2.69-6.406-4.354-10.511-4.354-8.209 0-14.865 6.655-14.865 14.865 0 2.732 0.737 5.291 2.022 7.491l-0.038-0.070-2.109 7.702 7.879-2.067c2.051 1.139 4.498 1.809 7.102 1.809h0.006c8.209-0.003 14.862-6.659 14.862-14.868 0-4.103-1.662-7.817-4.349-10.507zM16.062 28.228h-0.006c-2.319 0-4.489-0.64-6.342-1.753l0.056 0.031-0.451-0.267-4.675 1.227 1.247-4.559-0.294-0.467c-1.185-1.862-1.889-4.131-1.889-6.565 0-6.822 5.531-12.353 12.353-12.353s12.353 5.531 12.353 12.353c0 6.822-5.53 12.353-12.353 12.353zM22.838 18.977c-0.371-0.186-2.197-1.083-2.537-1.208-0.341-0.124-0.589-0.185-0.837 0.187-0.246 0.371-0.958 1.207-1.175 1.455-0.216 0.249-0.434 0.279-0.805 0.094-1.15-0.466-2.138-1.087-2.997-1.852l0.010 0.009c-0.799-0.74-1.484-1.587-2.037-2.521l-0.028-0.052c-0.216-0.371-0.023-0.572 0.162-0.757 0.167-0.166 0.372-0.434 0.557-0.65 0.146-0.179 0.271-0.384 0.366-0.604l0.006-0.017c0.043-0.087 0.068-0.188 0.068-0.296 0-0.131-0.037-0.253-0.101-0.357l0.002 0.003c-0.094-0.186-0.836-2.014-1.145-2.758-0.302-0.724-0.609-0.625-0.836-0.637-0.216-0.010-0.464-0.012-0.712-0.012-0.395 0.010-0.746 0.188-0.988 0.463l-0.001 0.002c-0.802 0.761-1.3 1.834-1.3 3.023 0 0.026 0 0.053 0.001 0.079l-0-0.004c0.131 1.467 0.681 2.784 1.527 3.857l-0.012-0.015c1.604 2.379 3.742 4.282 6.251 5.564l0.094 0.043c0.548 0.248 1.25 0.513 1.968 0.74l0.149 0.041c0.442 0.14 0.951 0.221 1.479 0.221 0.303 0 0.601-0.027 0.889-0.078l-0.031 0.004c1.069-0.223 1.956-0.868 2.497-1.749l0.009-0.017c0.165-0.366 0.261-0.793 0.261-1.242 0-0.185-0.016-0.366-0.047-0.542l0.003 0.019c-0.092-0.155-0.34-0.247-0.712-0.434z"/>
                        </svg>
                    </div>
                </a>

                <!-- Telegram -->
                <a href="https://t.me/YOUR_USERNAME" target="_blank"
                class="rounded-md bg-slate-950/30 text-center hover:border-emerald-400/25 transition">
                    <div class="mx-auto h-10 w-10 rounded-md bg-emerald-400/10 border border-emerald-400/15 grid place-items-center text-emerald-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M9.04 15.56l-.38 5.33c.55 0 .78-.24 1.06-.52l2.54-2.44 5.27 3.86c.97.53 1.66.25 1.9-.9L23.9 3.9c.33-1.46-.53-2.03-1.47-1.68L1.63 10.2c-1.42.55-1.4 1.33-.26 1.68l5.33 1.66L19.06 5.8c.68-.42 1.3-.19.79.23z"/>
                        </svg>
                    </div>
                </a>
                
            </div>

            <a href="{{ asset('cv/Bappa_Sutradhar_CV.pdf') }}" target="_blank"
               class="w-full text-center inline-block mt-4 rounded-md border border-cyan-400/30
                      bg-cyan-400/10 px-4 py-2 text-sm text-cyan-200
                      hover:bg-cyan-400/20 transition font-semibold">
                ⭳ Download CV
            </a>
        </div>

        <!-- SYSTEM INFO -->
        <div class="md:text-right">
            <p class="text-sm font-semibold text-white font-mono">
                SYSTEM_STATUS
            </p>

            <p class="mt-2 text-sm text-emerald-300 font-mono">
                ✔ Available for new projects
            </p>

            <p class="mt-3 text-xs text-white/40 font-mono">
                Stack: Laravel • PHP • MySQL • Tailwind
            </p>

            <p class="mt-4 text-xs text-white/30">
                © {{ date('Y') }} Bappa Sutradhar
            </p>

            <p class="text-[11px] text-white/25 font-mono">
                Build v1.0 • All systems operational
            </p>
        </div>

    </div>
</footer>
