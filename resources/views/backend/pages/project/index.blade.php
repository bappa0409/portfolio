@extends('layouts.app')
@section('title','Admin | Projects')
@section('breadcrumb','Projects')

@section('content')

<div x-data="projectsIndex()" x-init="init()">

    {{-- Header --}}
    <div class="flex items-center justify-between gap-4">
        <div>
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PROJECT_CONTROL</p>
            <h1 class="mt-2 text-2xl font-extrabold text-white cyber-text tracking-wide">PROJECTS</h1>
            <p class="mt-2 text-sm text-slate-300">Manage website projects from here.</p>
        </div>

        <div class="flex items-center gap-2">
            <button type="button"
                class="rounded-md border border-red-400/20 bg-red-400/10 px-3 py-1.5 text-[11px] font-mono font-semibold text-red-200 hover:border-red-400/35 hover:bg-red-400/15 transition cyber-glow disabled:opacity-60 disabled:cursor-not-allowed"
                :disabled="busy || selected.length === 0"
                @click="multiDelete()"
                x-text="busy ? 'PROCESSING...' : 'DELETE_SELECTED'">
            </button>

            <a href="{{ route('admin.projects.create') }}"
               class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-3 py-1.5 text-[11px] font-mono font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
                + NEW_PROJECT
            </a>
        </div>
    </div>

    {{-- Message --}}
    <div class="mt-4 text-xs font-mono text-slate-300" x-text="message"></div>

    {{-- Table --}}
    <div class="mt-3 rounded-md glass cyber-glow p-5 relative w-full">
        <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

        <div class="mt-1 overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-slate-300 font-mono text-xs">
                <tr class="border-b border-white/10">
                    <th class="py-3 px-3 text-left">
                        <input type="checkbox"
                               class="rounded border-white/20 bg-slate-950/40 text-emerald-400"
                               :checked="checkAll"
                               @change="toggleAll($event)">
                    </th>
                    <th class="py-3 px-3 text-left">TITLE</th>
                    <th class="py-3 px-3 text-left">STATUS</th>
                    <th class="py-3 px-3 text-left">VISIBILITY</th>
                    <th class="py-3 px-3 text-left">UPDATED</th>
                    <th class="py-3 px-3 text-right">ACTIONS</th>
                </tr>
                </thead>

                <tbody class="text-slate-200">
                @forelse($projects as $p)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition" id="row-{{ $p->id }}">
                        <td class="py-3 px-3">
                            <input type="checkbox"
                                   class="row-check rounded border-white/20 bg-slate-950/40 text-emerald-400"
                                   value="{{ $p->id }}"
                                   @change="toggleOne($event)">
                        </td>

                        <td class="py-3 px-3">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-md border border-white/10 bg-white/5 overflow-hidden">
                                    @if($p->image)
                                        <img src="{{ asset('images/projects/'.$p->image) }}"
                                             alt="{{ $p->title }}"
                                             class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full bg-gradient-to-br from-emerald-400/15 to-white/0"></div>
                                    @endif
                                </div>

                                <div>
                                    <div class="font-semibold text-white">{{ $p->title }}</div>
                                    <div class="text-xs font-mono text-slate-400">{{ $p->slug }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="py-3 px-3">
                            <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-2 py-1 text-xs font-mono text-slate-200">
                                {{ $p->status }}
                            </span>
                        </td>

                        <td class="py-3 px-3">
                            <button type="button"
                                    class="vis-btn rounded-full border px-2 py-1 text-xs font-mono transition
                                    {{ $p->visibility ? 'border-emerald-400/25 bg-emerald-400/10 text-emerald-200' : 'border-red-400/25 bg-red-400/10 text-red-200' }}"
                                    :disabled="busy"
                                    @click="toggleVisibility({{ $p->id }}, $event)">
                                {{ $p->visibility ? 'ACTIVE' : 'HIDDEN' }}
                            </button>
                        </td>

                        <td class="py-3 px-3 font-mono text-xs text-slate-400">
                            {{ $p->updated_at?->format('d M Y') }}
                        </td>

                        <td class="py-3 px-3 text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ route('admin.projects.edit', $p->id) }}"
                                   class="rounded-md border border-white/10 bg-white/5 px-2.5 py-1.5 text-xs font-mono text-slate-200 hover:border-emerald-400/25 hover:text-emerald-200 transition">
                                    Edit
                                </a>

                                <button type="button"
                                        class="rounded-md border border-red-400/20 bg-red-400/10 px-2.5 py-1.5 text-xs font-mono text-red-200 hover:border-red-400/35 hover:bg-red-400/15 transition"
                                        :disabled="busy"
                                        @click="singleDelete({{ $p->id }}, '{{ route('admin.projects.destroy', $p->id) }}')">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-10 text-center text-slate-400">No projects found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $projects->links() }}
        </div>
    </div>

    {{-- Alpine Confirm Modal --}}
    <div x-show="confirm.open"
         x-transition.opacity
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">

        <div @click.away="confirm.open = false"
             class="w-full max-w-sm rounded-md border border-white/10 bg-slate-900 p-6 cyber-glow">

            <p class="text-xs font-mono text-emerald-200/80 tracking-widest">
                &gt; CONFIRM_ACTION
            </p>

            <h3 class="mt-2 text-lg font-bold text-white">
                Are you sure?
            </h3>

            <p class="mt-2 text-sm text-slate-300" x-text="confirm.message"></p>

            <div class="mt-5 flex justify-end gap-2">
                <button type="button"
                    class="rounded-md border border-white/10 bg-white/5 px-4 py-2
                           text-xs font-mono text-slate-300 hover:bg-white/10 transition"
                    @click="confirm.open = false">
                    CANCEL
                </button>

                <button type="button"
                    class="rounded-md border border-red-400/30 bg-red-400/15 px-4 py-2
                           text-xs font-mono text-red-200 hover:bg-red-400/20 transition"
                    @click="confirmYes()">
                    CONFIRM
                </button>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
function projectsIndex(){
    return {
        busy:false,
        message:'',
        checkAll:false,
        selected: [],

        confirm: {
            open: false,
            message: '',
            action: null,
        },

        init(){
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if(token) axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

            this.syncFromDom();
        },

        toast(type, msg){
            this.message = msg || '';
            if (window.toast) window.toast(type, msg);
        },

        openConfirm(message, action){
            this.confirm.message = message;
            this.confirm.action = action;
            this.confirm.open = true;
        },

        confirmYes(){
            if (typeof this.confirm.action === 'function') {
                this.confirm.action();
            }
            this.confirm.open = false;
        },

        syncFromDom(){
            const ids = Array.from(document.querySelectorAll('.row-check:checked')).map(el => el.value);
            this.selected = ids;

            const all = Array.from(document.querySelectorAll('.row-check'));
            this.checkAll = (all.length > 0 && ids.length === all.length);
        },

        toggleAll(e){
            this.checkAll = !!e.target.checked;
            document.querySelectorAll('.row-check').forEach(cb => cb.checked = this.checkAll);
            this.syncFromDom();
        },

        toggleOne(){
            this.syncFromDom();
        },

        removeRow(id){
            const row = document.getElementById('row-' + id);
            if(!row) return;
            row.style.transition = 'opacity .2s ease';
            row.style.opacity = 0;
            setTimeout(() => row.remove(), 200);
        },

        singleDelete(id, url){
            this.openConfirm('Delete this project permanently?', async () => {
                try{
                    this.busy = true;
                    const res = await axios.delete(url);

                    this.toast('success', res.data?.message || 'Deleted');
                    this.removeRow(id);

                    setTimeout(() => this.syncFromDom(), 250);

                }catch(e){
                    this.toast('error', e.response?.data?.message || 'Something went wrong.');
                    console.error(e);
                }finally{
                    this.busy = false;
                }
            });
        },

        multiDelete(){
            if(this.selected.length === 0){
                this.toast('error', 'No project selected.');
                return;
            }

            this.openConfirm(`Delete ${this.selected.length} selected projects permanently?`, async () => {
                try{
                    this.busy = true;

                    const ids = [...this.selected];
                    const res = await axios.delete("{{ route('admin.projects.multi_destroy') }}", {
                        data: { ids }
                    });

                    this.toast('success', res.data?.message || 'Deleted');
                    ids.forEach(id => this.removeRow(id));

                    this.selected = [];
                    this.checkAll = false;

                }catch(e){
                    this.toast('error', e.response?.data?.message || 'Something went wrong.');
                    console.error(e);
                }finally{
                    this.busy = false;
                }
            });
        },

        async toggleVisibility(id, ev){
            const btn = ev.currentTarget;

            try{
                this.busy = true;
                const res = await axios.post("{{ route('admin.projects.visibility', ':id') }}".replace(':id', id));
                if(!res.data?.status) return;

                const isOn = !!res.data.visibility;
                btn.textContent = isOn ? 'ACTIVE' : 'HIDDEN';

                btn.classList.remove(
                    'border-emerald-400/25','bg-emerald-400/10','text-emerald-200',
                    'border-red-400/25','bg-red-400/10','text-red-200'
                );

                if(isOn){
                    btn.classList.add('border-emerald-400/25','bg-emerald-400/10','text-emerald-200');
                }else{
                    btn.classList.add('border-red-400/25','bg-red-400/10','text-red-200');
                }

                this.toast('success', res.data?.message || 'Updated');

            }catch(e){
                this.toast('error', e.response?.data?.message || 'Something went wrong.');
                console.error(e);
            }finally{
                this.busy = false;
            }
        },
    }
}
</script>
@endpush
