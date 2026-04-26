@extends('layouts.app')

@section('title', 'Admin | GitHub Settings')
@section('breadcrumb', 'Website / GitHub Settings')

@section('content')
<div class="flex items-start justify-between gap-4">
    <div>
        <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; GITHUB_CONTROL</p>
        <h1 class="mt-2 text-2xl font-extrabold text-white cyber-text tracking-wide">GITHUB_SETTINGS</h1>
        <p class="mt-2 text-sm text-slate-300">Configure GitHub profile, repository sync & API access.</p>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="text-xs font-mono text-emerald-200 hover:text-emerald-100">← Back</a>
</div>

<div class="mt-4 rounded-md glass cyber-glow p-6 relative"
     x-data="githubSettings()" x-init="init()" x-cloak>

    <section class="mt-6">
        <div class="flex items-center justify-between">
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; CREDENTIALS</p>

            <button type="button"
                class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-2 text-xs font-mono text-emerald-100"
                @click="saveGithubSetting()"
                :disabled="saving.github"
                x-text="saving.github ? 'SAVING...' : 'SAVE_GITHUB'">
            </button>
        </div>

        <form id="githubForm" class="mt-4 grid md:grid-cols-2 gap-3">

            @csrf

            {{-- USERNAME --}}
            <div>
                <label class="text-xs font-mono text-slate-400">USERNAME</label>
                <input name="username"
                       value="{{ old('username', $settings->username ?? '') }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">

                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('username')"></p>
            </div>

            {{-- TOKEN --}}
            <div>
                <label class="text-xs font-mono text-slate-400">API_ACCESS_TOKEN</label>
                <input name="token"
                       value="{{ old('token', $settings->token ?? '') }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">

                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('token')"></p>
            </div>

            {{-- REPO VISIBILITY --}}
            <div>
                <label class="text-xs font-mono text-slate-400">REPO VISIBILITY</label>

                <select name="repo_visibility"
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    @foreach (['all' => 'All', 'public' => 'Public', 'private' => 'Private'] as $value => $label)
                        <option value="{{ $value }}"
                            @selected(old('repo_visibility', $settings->repo_visibility ?? 'public') === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('repo_visibility')"></p>
            </div>

            {{-- SYNC TOGGLE --}}
            <div class="flex items-center justify-between rounded-md border border-white/10 bg-slate-950/40 px-3 py-2">

                <div>
                    <p class="text-xs font-mono text-slate-300">AUTO SYNC</p>
                    <p class="text-[11px] text-slate-500">Enable repo synchronization</p>
                </div>

                <input type="hidden" name="sync_enabled" :value="sync ? 1 : 0">

                <button type="button"
                        @click="sync = !sync"
                        class="px-3 py-1 text-xs font-mono border rounded"
                        :class="sync ? 'bg-emerald-400/30 border-emerald-400/40' : 'bg-white/5 border-white/10'">
                    <span x-text="sync ? 'ON' : 'OFF'"></span>
                </button>
            </div>

        </form>
    </section>
</div>
@endsection

@push('scripts')
<script>
function githubSettings(){
    return {
        saving: {
            github: false
        },

        sync: {{ $settings->sync_enabled ?? 0 ? 'true' : 'false' }},

        errors: {},

        init(){},

        err(key){
            return this.errors?.[key]?.[0] || '';
        },

        showToast(type, message){
            window.toast?.(type, message);
        },

        async postForm(url, formId){
            this.errors = {};

            const formEl = document.getElementById(formId);
            const fd = new FormData(formEl);

            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if(token) axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

            const res = await axios.post(url, fd, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });

            return res.data;
        },

        async handleSave(key, url, formId){
            try{
                this.saving[key] = true;

                const data = await this.postForm(url, formId);

                this.showToast('success', data.message || 'Saved');

            }catch(e){

                if(e.response?.status === 422){
                    this.errors = e.response.data.errors || {};
                    this.showToast('error', 'Fix validation errors');
                }else{
                    this.showToast('error', 'Something went wrong');
                }

            }finally{
                this.saving[key] = false;
            }
        },

        saveGithubSetting(){
            return this.handleSave('github', "{{ route('admin.github.update') }}", 'githubForm');
        }
    }
}
</script>
@endpush