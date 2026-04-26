@extends('layouts.app')
@section('title', 'Admin | Contact Settings')
@section('breadcrumb', 'Website / Contact Settings')

@section('content')
<div class="flex items-start justify-between gap-4">
    <div>
        <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; CONTACT_CONTROL</p>
        <h1 class="mt-2 text-2xl font-extrabold text-white cyber-text tracking-wide">CONTACT_SETTINGS</h1>
        <p class="mt-2 text-sm text-slate-300">Manage Contact page content from here.</p>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="text-xs font-mono text-emerald-200 hover:text-emerald-100">← Back</a>
</div>

@php
    $page_meta     = $settings->page_meta ?? [];
    $contact_cards = $settings->contact_cards ?? [];
    $social_links  = $settings->social_links ?? [];
@endphp

<div class="mt-4 rounded-md glass cyber-glow p-6 relative" x-data="contactSettings()" x-init="init()" x-cloak>
    <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

    {{-- Tabs --}}
    <div class="flex flex-wrap gap-2 border-b border-white/10 pb-3">
        @php
            $tabs = [
                'page_meta' => 'PAGE_META',
                'contact_cards' => 'CONTACT_CARDS',
                'social_links' => 'SOCIAL_LINKS',
            ];
        @endphp

        @foreach($tabs as $k => $label)
            <button type="button"
                class="px-2 py-2 text-[11px] font-mono rounded border border-white/10"
                :class="tab==='{{ $k }}'
                    ? 'bg-emerald-400/25 text-emerald-200 border-emerald-400/30'
                    : 'bg-white/5 text-slate-300 hover:text-white'"
                @click="setTab('{{ $k }}')">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- =========================================================
    PAGE META
    ========================================================= --}}
    <section x-show="tab==='page_meta'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PAGE_META</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="savePageMeta()" :disabled="saving.page_meta" x-text="saving.page_meta ? 'SAVING...' : 'SAVE_PAGE_META'"></button>
        </div>

        <form id="pageMetaForm" class="mt-4 grid md:grid-cols-2 gap-3" @submit.prevent="savePageMeta()">
            @csrf
            <div>
                <label class="text-xs font-mono text-slate-400">KICKER</label>
                <input name="page_meta[kicker]" value="{{ data_get($page_meta,'kicker') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('page_meta.kicker')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">HEADING</label>
                <input name="page_meta[heading]" value="{{ data_get($page_meta,'heading') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('page_meta.heading')"></p>
            </div>
        </form>
    </section>

    {{-- =========================================================
    CONTACT CARDS
    ========================================================= --}}
    <section x-show="tab==='contact_cards'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; CONTACT_CARDS</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveContactCards()" :disabled="saving.contact_cards" x-text="saving.contact_cards ? 'SAVING...' : 'SAVE_CARDS'"></button>
        </div>

        <form id="contactCardsForm" class="mt-4 grid md:grid-cols-2 gap-3" @submit.prevent="saveContactCards()">
            @csrf
            <div>
                <label class="text-xs font-mono text-slate-400">EMAIL</label>
                <input name="contact_cards[email]" value="{{ data_get($contact_cards,'email') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('contact_cards.email')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">PHONE</label>
                <input name="contact_cards[phone]" value="{{ data_get($contact_cards,'phone') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('contact_cards.phone')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">LOCATION</label>
                <input name="contact_cards[location]" value="{{ data_get($contact_cards,'location') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('contact_cards.location')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">TIMEZONE</label>
                <input name="contact_cards[timezone]" value="{{ data_get($contact_cards,'timezone') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('contact_cards.timezone')"></p>
            </div>
        </form>
    </section>

    {{-- =========================================================
    SOCIAL LINKS
    ========================================================= --}}
    <section x-show="tab==='social_links'" x-transition class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; SOCIAL_LINKS</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100 hover:bg-emerald-400/25"
                @click="saveSocialLinks()" :disabled="saving.social_links" x-text="saving.social_links ? 'SAVING...' : 'SAVE_LINKS'"></button>
        </div>

        <form id="socialLinksForm" class="mt-4 grid md:grid-cols-2 gap-3" @submit.prevent="saveSocialLinks()">
            @csrf
            <div>
                <label class="text-xs font-mono text-slate-400">LINKEDIN URL</label>
                <input name="social_links[linkedin]" value="{{ data_get($social_links,'linkedin') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('social_links.linkedin')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">FACEBOOK URL</label>
                <input name="social_links[facebook]" value="{{ data_get($social_links,'facebook') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('social_links.facebook')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">WHATSAPP URL</label>
                <input name="social_links[whatsapp]" value="{{ data_get($social_links,'whatsapp') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('social_links.whatsapp')"></p>
            </div>

            <div>
                <label class="text-xs font-mono text-slate-400">TELEGRAM URL</label>
                <input name="social_links[telegram]" value="{{ data_get($social_links,'telegram') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('social_links.telegram')"></p>
            </div>
        </form>
    </section>
</div>
@endsection

@push('scripts')
<script>
function contactSettings(){
    return {
        tab: 'page_meta',
        saving: {
            page_meta:false, contact_cards:false, social_links:false
        },
        errors: {},

        init(){
            const saved = localStorage.getItem('contact_tab');
            if(saved) this.tab = saved;
        },

        setTab(t){
            this.tab = t;
            this.errors = {};
            localStorage.setItem('contact_tab', t);
        },

        err(key){
            return (this.errors && this.errors[key]) ? this.errors[key][0] : '';
        },

        showToast(type, message){
            if (window.toast) window.toast(type, message);
        },

        async postForm(url, formId){
            this.errors = {};
            const formEl = document.getElementById(formId);
            if(!formEl) throw new Error(`Form not found: ${formId}`);

            const fd = new FormData(formEl);

            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if(token) axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

            const res = await axios.post(url, fd, { headers: { 'Content-Type': 'multipart/form-data' }});
            return res.data;
        },

        async handleSave(key, routeUrl, formId){
            if (window.validateFormAndMark && !window.validateFormAndMark(formId)) return;

            try{
                this.saving[key] = true;
                const data = await this.postForm(routeUrl, formId);
                this.showToast('success', data.message || 'Saved');
            }catch(e){
                if(e.response && e.response.status === 422){
                    this.errors = e.response.data.errors || {};
                    this.showToast('error', 'Please fix the highlighted fields.');
                }else{
                    this.showToast('error', 'Something went wrong.');
                    console.error(e);
                }
            }finally{
                this.saving[key] = false;
            }
        },

        savePageMeta(){ return this.handleSave('page_meta', "{{ route('admin.contact.page_meta') }}", 'pageMetaForm'); },
        saveContactCards(){ return this.handleSave('contact_cards', "{{ route('admin.contact.contact_cards') }}", 'contactCardsForm'); },
        saveSocialLinks(){ return this.handleSave('social_links', "{{ route('admin.contact.social_links') }}", 'socialLinksForm'); },
    }
}
</script>
@endpush
