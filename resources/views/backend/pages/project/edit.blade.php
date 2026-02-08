@extends('layouts.app')
@section('title', 'Admin | Edit Project')
@section('breadcrumb', 'Projects / Edit')

@section('content')
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PROJECT_CONTROL</p>
            <h1 class="mt-2 text-2xl font-extrabold text-white cyber-text tracking-wide">EDIT_PROJECT</h1>
            <p class="mt-2 text-sm text-slate-300">Update website project from here.</p>
        </div>
        <a href="{{ route('admin.projects.index') }}"
           class="text-xs font-mono text-emerald-200 hover:text-emerald-100">← Back</a>
    </div>

    <div class="mt-4 rounded-md glass cyber-glow p-6 relative" x-data="projectEditForm()" x-cloak>
        <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

        <form id="projectEditForm"
              method="POST"
              action="{{ route('admin.projects.update', $project->id) }}"
              class="mt-6 grid md:grid-cols-2 gap-3"
              enctype="multipart/form-data"
              @submit.prevent="submit()">

            @csrf
            <input type="hidden" name="_method" value="PUT">

            {{-- TITLE --}}
            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">TITLE</label>
                <input name="title" value="{{ old('title', $project->title) }}" required
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('title')"></p>
                @error('title') <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p> @enderror
            </div>

            {{-- SUBTITLE --}}
            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">SUBTITLE</label>
                <input name="subtitle" value="{{ old('subtitle', $project->subtitle) }}"
                       class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('subtitle')"></p>
                @error('subtitle') <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p> @enderror
            </div>

            {{-- MAIN IMAGE --}}
            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">MAIN IMAGE</label>

                <label for="main_image"
                       class="mt-2 block rounded-md border border-dashed border-white/15 bg-slate-950/30
                              hover:border-emerald-400/30 transition p-4 cursor-pointer relative overflow-hidden">
                    <div class="absolute inset-0 scanline opacity-30 pointer-events-none"></div>

                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-md border border-white/10 bg-white/5 flex items-center justify-center text-white/70">
                                ⧉
                            </div>
                            <div>
                                <p class="text-sm text-white/85 font-semibold">Drag & Drop image</p>
                                <p class="text-[11px] text-slate-400 font-mono">or click to upload (replace)</p>
                            </div>
                        </div>

                        <span class="text-[10px] px-2 py-1 rounded bg-emerald-400/15 text-emerald-200 border border-emerald-400/20">
                            MAIN
                        </span>
                    </div>

                    <input id="main_image" type="file" name="image" accept="image/*" class="hidden">
                </label>

                {{-- Existing + New preview --}}
                <div class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                    <div class="relative rounded-md border border-white/10 bg-white/5 overflow-hidden">
                        @if($project->image)
                                 <img src="{{ Storage::url($project->image) }}" class="h-24 w-full object-cover">
                        @else
                            <div class="w-full h-24 bg-gradient-to-br from-emerald-400/15 to-white/0"></div>
                        @endif
                        <div class="px-2 py-1 text-[10px] font-mono text-slate-300 truncate">Current</div>
                    </div>

                    <div id="mainImagePreviewBox" class="relative rounded-md border border-white/10 bg-white/5 overflow-hidden hidden">
                        <img id="mainImagePreviewImg" src="" class="w-full h-24 object-cover" alt="New main">
                        <div id="mainImagePreviewCap" class="px-2 py-1 text-[10px] font-mono text-slate-300 truncate"></div>
                        <div class="absolute top-1 right-1 text-[10px] px-1.5 py-0.5 rounded bg-emerald-400/30 text-emerald-100">New</div>
                    </div>
                </div>

                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('image')"></p>
                @error('image') <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p> @enderror
            </div>

            {{-- STACK --}}
            <div>
                <label class="text-xs font-mono text-slate-400">STACK <span class="text-red-300">*</span></label>

                <select name="stack[]" multiple required
                        class="select2 mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    @foreach (['Laravel', 'CodeIgniter', 'PHP', 'MySQL', 'REST API', 'WordPress', 'JavaScript', 'React', 'Bootstrap', 'Tailwind CSS'] as $st)
                        <option value="{{ $st }}" @selected(collect(old('stack', $stackOld))->contains($st))>{{ $st }}</option>
                    @endforeach
                </select>

                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('stack') || err('stack.0')"></p>
                @error('stack') <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p> @enderror
                @error('stack.*') <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p> @enderror
            </div>

            {{-- STATUS --}}
            <div>
                <label class="text-xs font-mono text-slate-400">STATUS</label>
                <select name="status" required
                        class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <option value="" @selected(old('status', $project->status)==='')>Select Status</option>
                    @foreach (['Live', 'Private', 'In Progress'] as $st)
                        <option value="{{ $st }}" @selected(old('status', $project->status) === $st)>{{ $st }}</option>
                    @endforeach
                </select>

                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('status')"></p>
                @error('status') <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p> @enderror
            </div>

            {{-- GALLERY --}}
            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">GALLERY (add/replace images)</label>

                <label for="gallery"
                       class="mt-2 group block rounded-md border border-dashed border-white/15 bg-slate-950/30
                              hover:border-emerald-400/30 transition p-5 cursor-pointer relative overflow-hidden">
                    <div class="absolute inset-0 scanline opacity-30 pointer-events-none"></div>

                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-md border border-white/10 bg-white/5 flex items-center justify-center text-white/70">⧉</div>
                            <div>
                                <p class="text-sm text-white/85 font-semibold">Drag & Drop gallery images</p>
                                <p class="text-[11px] text-slate-400 font-mono">or click to browse (multiple)</p>
                            </div>
                        </div>

                        <span class="text-[10px] px-2 py-1 rounded bg-blue-500/15 text-blue-200 border border-blue-400/20">MULTI</span>
                    </div>

                    <input id="gallery" type="file" name="gallery[]" accept="image/*" multiple class="hidden">
                </label>

                {{-- Existing gallery thumbnails --}}
                @if(!empty($project->gallery))
                    <div class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
                        @foreach(($project->gallery ?? []) as $img)
                            <div class="rounded-md border border-white/10 bg-white/5 overflow-hidden">
                                <img src="{{ Storage::url($img) }}" class="w-full h-24 object-cover" alt="Gallery">
                                <div class="px-2 py-1 text-[10px] font-mono text-slate-300 truncate">Existing</div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div id="galleryPreview" class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3"></div>

                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('gallery') || err('gallery.0')"></p>
                @error('gallery') <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p> @enderror
                @error('gallery.*') <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p> @enderror
            </div>

            {{-- CHECKBOXES --}}
            <div class="md:col-span-2 grid sm:grid-cols-2 gap-4">
                <label class="flex items-center gap-2 text-xs font-mono text-slate-300">
                    <input type="checkbox" name="visibility" value="1"
                           @checked(old('visibility', $project->visibility) ? true : false)
                           class="rounded border-white/20 bg-slate-950/40 text-emerald-400">
                    Visible (show on website)
                </label>

                <label class="flex items-center gap-2 text-xs font-mono text-slate-300">
                    <input type="checkbox" name="is_featured" value="1"
                           @checked(old('is_featured', $project->is_featured) ? true : false)
                           class="rounded border-white/20 bg-slate-950/40 text-emerald-400">
                    Featured
                </label>
            </div>

            {{-- OVERVIEW --}}
            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">OVERVIEW</label>
                <textarea name="overview" rows="5"
                          class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ old('overview', $project->overview) }}</textarea>

                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="err('overview')"></p>
                @error('overview') <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p> @enderror
            </div>

            {{-- FEATURES (dynamic) --}}
            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">FEATURES</label>

                <div x-data="{ items: @js(old('features', $featuresArr ?? [])) }"
                     class="mt-2 rounded-md border border-white/10 bg-slate-950/30 p-4">

                    <div class="flex items-center justify-between mb-3">
                        <p class="text-xs font-mono text-slate-400">FEATURE ITEMS</p>

                        <button type="button"
                            class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                            @click="items.push('')">
                            + ADD_FEATURE
                        </button>
                    </div>

                    <template x-for="(f,i) in items" :key="i">
                        <div class="mb-3 flex flex-wrap md:flex-nowrap items-center gap-3">
                            <input class="flex-1 rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                   :name="`features[${i}]`"
                                   x-model="items[i]"
                                   placeholder="e.g. Role based access">

                            <button type="button"
                                class="shrink-0 text-[11px] font-mono text-red-300 hover:text-red-200"
                                @click="items.splice(i,1)">
                                REMOVE
                            </button>
                        </div>
                    </template>

                    <template x-for="(f,i) in items" :key="'err-'+i">
                        <p class="text-[11px] text-red-300 font-mono" x-text="$root.__pf_err?.(`features.${i}`)"></p>
                    </template>

                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="$root.__pf_err?.('features')"></p>
                </div>

                @error('features') <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p> @enderror
                @error('features.*') <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p> @enderror
            </div>

            {{-- PROCESS (dynamic) --}}
            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">DEVELOPMENT PROCESS</label>

                <div
                    x-data="{
                        items: @js(old('process', ($processArr ?? []) ?: [
                            ['title' => 'Planning',    'desc' => 'Requirements & architecture'],
                            ['title' => 'Development', 'desc' => 'Modules, APIs, integrations'],
                            ['title' => 'Testing',     'desc' => 'Manual & regression checks'],
                            ['title' => 'Deploy',      'desc' => 'Production + support'],
                        ]))
                    }"
                    class="mt-2 rounded-md border border-white/10 bg-slate-950/30 p-4"
                >
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-xs font-mono text-slate-400">PROCESS STEPS</p>

                        <button type="button"
                            class="text-[11px] font-mono text-emerald-200 hover:text-emerald-100"
                            @click="items.push({ title: '', desc: '' })">
                            + ADD_STEP
                        </button>
                    </div>

                    <template x-for="(p,i) in items" :key="i">
                        <div class="mb-3 grid md:grid-cols-12 gap-3 items-start">
                            <div class="md:col-span-4">
                                <label class="text-[10px] font-mono text-slate-400">TITLE</label>
                                <input class="mt-1 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                       :name="`process[${i}][title]`"
                                       x-model="p.title"
                                       placeholder="Planning">
                                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="$root.__pf_err?.(`process.${i}.title`)"></p>
                            </div>

                            <div class="md:col-span-7">
                                <label class="text-[10px] font-mono text-slate-400">DESCRIPTION</label>
                                <input class="mt-1 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                                       :name="`process[${i}][desc]`"
                                       x-model="p.desc"
                                       placeholder="Requirements & architecture">
                                <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="$root.__pf_err?.(`process.${i}.desc`)"></p>
                            </div>

                            <div class="md:col-span-1 flex md:justify-end pt-5">
                                <button type="button"
                                    class="shrink-0 text-[11px] font-mono text-red-300 hover:text-red-200"
                                    @click="items.splice(i,1)">
                                    REMOVE
                                </button>
                            </div>
                        </div>
                    </template>

                    <p class="mt-1 text-[11px] text-red-300 font-mono" x-text="$root.__pf_err?.('process')"></p>
                </div>

                @error('process') <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p> @enderror
                @error('process.*.title') <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p> @enderror
                @error('process.*.desc') <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p> @enderror
            </div>

            

            <div class="md:col-span-2 flex gap-3">
                <button type="submit"
                        :disabled="submitting"
                        class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-6 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow disabled:opacity-60 disabled:cursor-not-allowed"
                        x-text="submitting ? 'UPDATING...' : 'UPDATE_PROJECT'">
                </button>

                <a href="{{ route('admin.projects.index') }}"
                   class="rounded-md border border-white/10 bg-white/5 px-6 py-3 font-semibold text-white hover:border-emerald-400/25 transition">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
(() => {
    const bindDropZone = (zoneEl, inputEl, { multiple = false } = {}) => {
        if (!zoneEl || !inputEl) return;

        const setActive = (on) => {
            zoneEl.classList.toggle('border-emerald-400/50', on);
            zoneEl.classList.toggle('bg-emerald-400/5', on);
        };

        ['dragenter', 'dragover'].forEach(evt => {
            zoneEl.addEventListener(evt, (e) => { e.preventDefault(); e.stopPropagation(); setActive(true); });
        });

        ['dragleave', 'drop'].forEach(evt => {
            zoneEl.addEventListener(evt, (e) => { e.preventDefault(); e.stopPropagation(); setActive(false); });
        });

        zoneEl.addEventListener('drop', (e) => {
            const files = Array.from(e.dataTransfer.files || []).filter(f => f.type.startsWith('image/'));
            if (!files.length) return;

            const dt = new DataTransfer();
            if (multiple) files.forEach(f => dt.items.add(f));
            else dt.items.add(files[0]);

            inputEl.files = dt.files;
            inputEl.dispatchEvent(new Event('change', { bubbles: true }));
        });
    };

    const mainInput = document.getElementById('main_image');
    const mainWrap  = mainInput?.closest('label');
    const mainBox   = document.getElementById('mainImagePreviewBox');
    const mainImg   = document.getElementById('mainImagePreviewImg');
    const mainCap   = document.getElementById('mainImagePreviewCap');

    if (mainInput && mainBox && mainImg && mainCap) {
        mainInput.addEventListener('change', () => {
            const file = mainInput.files?.[0];
            if (!file || !file.type.startsWith('image/')) {
                mainBox.classList.add('hidden');
                return;
            }
            mainImg.src = URL.createObjectURL(file);
            mainCap.textContent = file.name;
            mainBox.classList.remove('hidden');
        });

        bindDropZone(mainWrap, mainInput, { multiple: false });
    }

    const gallery = document.getElementById('gallery');
    const galWrap = gallery?.closest('label');
    const preview = document.getElementById('galleryPreview');

    if (gallery && preview) {
        gallery.addEventListener('change', () => {
            preview.innerHTML = '';
            const files = Array.from(gallery.files || []);
            files.forEach((file) => {
                if (!file.type.startsWith('image/')) return;

                const wrap = document.createElement('div');
                wrap.className = 'rounded-md border border-white/10 bg-white/5 overflow-hidden';

                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.alt = file.name;
                img.className = 'w-full h-24 object-cover';

                const cap = document.createElement('div');
                cap.className = 'px-2 py-1 text-[10px] font-mono text-slate-300 truncate';
                cap.title = file.name;
                cap.textContent = file.name;

                wrap.appendChild(img);
                wrap.appendChild(cap);
                preview.appendChild(wrap);
            });
        });

        bindDropZone(galWrap, gallery, { multiple: true });
    }
})();
</script>

<script>
function projectEditForm(){
    return {
        submitting: false,
        errors: {},

        init(){
            this.__pf_err = (key) => this.err(key);
        },

        err(key){
            return (this.errors && this.errors[key]) ? this.errors[key][0] : '';
        },

        showToast(type, message){
            if (window.toast) window.toast(type, message);
        },

        async submit(){
            if (window.validateFormAndMark && !window.validateFormAndMark('projectEditForm')) return;

            this.errors = {};
            const formEl = document.getElementById('projectEditForm');
            const url = formEl.getAttribute('action');
            const fd  = new FormData(formEl);

            if (!fd.has('_method')) fd.append('_method', 'PUT');

            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if(token) axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

            try{
                this.submitting = true;
                const res = await axios.post(url, fd, { headers: { 'Content-Type': 'multipart/form-data' } });

                this.showToast('success', res.data?.message || 'Updated');

                if (res.data?.redirect) window.location.href = res.data.redirect;

            }catch(e){
                if(e.response && e.response.status === 422){
                    this.errors = e.response.data.errors || {};
                    this.showToast('error', 'Please fix the highlighted fields.');
                }else{
                    this.showToast('error', 'Something went wrong.');
                    console.error(e);
                }
            }finally{
                this.submitting = false;
            }
        }
    }
}
</script>
@endpush
