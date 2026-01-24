@extends('layouts.app')
@section('title','Contact | Portfolio')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-12">
    <h1 class="text-3xl md:text-4xl font-extrabold">Get In Touch</h1>
    <p class="mt-3 text-slate-300">Tell me about your project. I usually reply within 24 hours.</p>

    @if (session('success'))
        <div class="mt-6 rounded-xl border border-emerald-400/20 bg-emerald-500/10 p-4 text-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-10 grid md:grid-cols-2 gap-6">
        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <h2 class="font-bold text-lg">Contact</h2>
            <div class="mt-4 space-y-3 text-sm text-slate-300">
                <p><span class="text-slate-400">Email:</span> your@email.com</p>
                <p><span class="text-slate-400">WhatsApp:</span> +8801XXXXXXXXX</p>
                <p><span class="text-slate-400">Location:</span> Dhaka, Bangladesh (GMT+6)</p>
            </div>

            <a href="https://wa.me/8801XXXXXXXXX"
               class="mt-6 inline-block rounded-xl bg-white text-slate-950 font-semibold px-5 py-3 hover:bg-slate-100">
                Chat on WhatsApp
            </a>
        </div>

        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <h2 class="font-bold text-lg">Send a Message</h2>

            <form class="mt-5 space-y-4" method="POST" action="{{ route('contact.send') }}">
                @csrf

                <div>
                    <label class="text-sm text-slate-300">Name</label>
                    <input name="name" value="{{ old('name') }}"
                           class="mt-1 w-full rounded-xl border border-white/10 bg-slate-950/40 px-4 py-3 outline-none focus:border-blue-400"
                           placeholder="Your name">
                    @error('name') <p class="text-xs text-red-300 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm text-slate-300">Email</label>
                    <input name="email" value="{{ old('email') }}"
                           class="mt-1 w-full rounded-xl border border-white/10 bg-slate-950/40 px-4 py-3 outline-none focus:border-blue-400"
                           placeholder="you@email.com">
                    @error('email') <p class="text-xs text-red-300 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm text-slate-300">Message</label>
                    <textarea name="message" rows="5"
                              class="mt-1 w-full rounded-xl border border-white/10 bg-slate-950/40 px-4 py-3 outline-none focus:border-blue-400"
                              placeholder="Tell me about your project...">{{ old('message') }}</textarea>
                    @error('message') <p class="text-xs text-red-300 mt-1">{{ $message }}</p> @enderror
                </div>

                <button class="w-full rounded-xl bg-blue-500 hover:bg-blue-400 px-5 py-3 font-semibold text-slate-950">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
