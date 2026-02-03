@extends('layouts.app')
@section('title', 'Admin | Create Project')
@section('breadcrumb', 'Projects / Create')

@section('content')
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PROJECT_CONTROL</p>
            <h1 class="mt-2 text-2xl font-extrabold text-white cyber-text tracking-wide">CREATE_PROJECT</h1>
            <p class="mt-2 text-sm text-slate-300">Manage website projects from here.</p>
        </div>
        <a href="{{ route('admin.project.index') }}" class="text-xs font-mono text-emerald-200 hover:text-emerald-100">←
            Back</a>
    </div>
    <div class="mt-4 rounded-md glass cyber-glow p-6 relative">
        <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>
        <form method="POST" action="{{ route('admin.project.store') }}" class="mt-6 grid md:grid-cols-2 gap-5"
            enctype="multipart/form-data">
            @csrf

         
            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">TITLE</label>
                <input id="title" name="title" value="{{ old('title') }}" required
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">SUBTITLE</label>
                <input name="subtitle" value="{{ old('subtitle') }}"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">MAIN IMAGE</label>

                <label for="main_image"
                    class="mt-2 block rounded-md border border-dashed border-white/15 bg-slate-950/30
                        hover:border-emerald-400/30 transition p-4 cursor-pointer relative overflow-hidden">

                    <div class="absolute inset-0 scanline opacity-30 pointer-events-none"></div>

                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="h-9 w-9 rounded-md border border-white/10 bg-white/5
                                        flex items-center justify-center text-white/70">
                                ⧉
                            </div>
                            <div>
                                <p class="text-sm text-white/85 font-semibold">Drag & Drop image</p>
                                <p class="text-[11px] text-slate-400 font-mono">
                                    or click to upload (only one)
                                </p>
                            </div>
                        </div>

                        <span
                            class="text-[10px] px-2 py-1 rounded
                                    bg-emerald-400/15 text-emerald-200
                                    border border-emerald-400/20">
                            MAIN
                        </span>
                    </div>

                    <input id="main_image" type="file" name="image" accept="image/*" class="hidden">
                </label>

                <div id="mainImagePreview" class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 hidden">

                    <div class="relative rounded-md border border-white/10 bg-white/5 overflow-hidden">
                        <img id="mainImagePreviewImg" src="" alt="Main image preview"
                            class="w-full h-24 object-cover">

                        <div class="absolute inset-0 bg-black/20 pointer-events-none"></div>

                        <div id="mainImagePreviewCap" class="px-2 py-1 text-[10px] font-mono text-slate-300 truncate">
                        </div>

                        <div
                            class="absolute top-1 right-1 text-[10px]
                                    px-1.5 py-0.5 rounded bg-emerald-400/30 text-emerald-100">
                            Main
                        </div>
                    </div>
                </div>

                <p class="mt-1 text-[11px] text-slate-500 font-mono">
                    Only one image allowed. Uploading a new image will replace the previous one.
                </p>

                @error('image')
                    <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <label class="text-xs font-mono text-slate-400">STACK</label>
                 <select name="stack[]" multiple
                    class="select2 mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    @foreach (['Laravel', 'CodeIgniter', 'PHP', 'MySQL', 'REST API', 'WordPress', 'JavaScript', 'React', 'Bootstrap', 'Tailwind CSS'] as $st)
                        <option value="{{ $st }}">{{ $st }}</option>
                    @endforeach
                </select>
            </div>

            
            <div>
                <label class="text-xs font-mono text-slate-400">STATUS</label>
                <select name="status" class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">
                    <option value="" selected>Select Status</option>
                    @foreach (['Live', 'Private', 'In Progress'] as $st)
                        <option value="{{ $st }}" @selected(old('status', 'Live') === $st)>{{ $st }}</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2 grid sm:grid-cols-2 gap-4">
                <label class="flex items-center gap-2 text-xs font-mono text-slate-300">
                    <input type="checkbox" name="visibility" value="1" @checked(old('visibility', 1))
                        class="rounded border-white/20 bg-slate-950/40 text-emerald-400">
                    Visible (show on website)
                </label>

                <label class="flex items-center gap-2 text-xs font-mono text-slate-300">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured'))
                        class="rounded border-white/20 bg-slate-950/40 text-emerald-400">
                    Featured
                </label>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">OVERVIEW</label>
                <textarea name="overview" rows="5"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white">{{ old('overview') }}</textarea>
            </div>


            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">FEATURES (one per line)</label>
                <textarea name="features" rows="6"
                    class="mt-2 w-full rounded-md border border-white/10 bg-slate-950/40 px-3 py-2 text-white"
                    placeholder="Role based access&#10;Reports&#10;API integration">{{ old('features') }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label class="text-xs font-mono text-slate-400">GALLERY (multiple images)</label>

                <label for="gallery"
                    class="mt-2 group block rounded-md border border-dashed border-white/15 bg-slate-950/30
                        hover:border-emerald-400/30 transition p-5 cursor-pointer relative overflow-hidden">

                    <div class="absolute inset-0 scanline opacity-30 pointer-events-none"></div>

                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="h-10 w-10 rounded-md border border-white/10 bg-white/5 flex items-center justify-center text-white/70">
                                ⧉
                            </div>
                            <div>
                                <p class="text-sm text-white/85 font-semibold">Drag & Drop gallery images</p>
                                <p class="text-[11px] text-slate-400 font-mono">or click to browse (multiple)</p>
                            </div>
                        </div>

                        <span class="text-[10px] px-2 py-1 rounded bg-blue-500/15 text-blue-200 border border-blue-400/20">
                            MULTI
                        </span>
                    </div>

                    <input id="gallery" type="file" name="gallery[]" accept="image/*" multiple class="hidden">
                </label>

                <div id="galleryPreview" class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3"></div>

                @error('gallery')
                    <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
                @error('gallery.*')
                    <p class="mt-1 text-xs text-red-400 font-mono">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 flex gap-3">
                <button
                    class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-6 py-3 font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
                    SAVE_PROJECT
                </button>

                <a href="{{ route('admin.project.index') }}"
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
            const title = document.getElementById('title');
            const slug = document.getElementById('slug');
            let slugTouched = false;

            const slugify = (str) => (str || '')
                .toString().trim().toLowerCase()
                .replace(/&/g, ' and ')
                .replace(/['"]/g, '')
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');

            if (slug) {
                slug.addEventListener('input', () => {
                    slugTouched = slug.value.trim().length > 0;
                });
            }

            if (title && slug) {
                const fillSlug = () => {
                    if (!slugTouched) slug.value = slugify(title.value);
                };
                title.addEventListener('input', fillSlug);
                title.addEventListener('change', fillSlug);
            }

            // ---------- Helpers ----------
            const bindDropZone = (zoneEl, inputEl, {
                multiple = false
            } = {}) => {
                if (!zoneEl || !inputEl) return;

                const setActive = (on) => {
                    zoneEl.classList.toggle('border-emerald-400/50', on);
                    zoneEl.classList.toggle('bg-emerald-400/5', on);
                };

                ['dragenter', 'dragover'].forEach(evt => {
                    zoneEl.addEventListener(evt, (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        setActive(true);
                    });
                });

                ['dragleave', 'drop'].forEach(evt => {
                    zoneEl.addEventListener(evt, (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        setActive(false);
                    });
                });

                zoneEl.addEventListener('drop', (e) => {
                    const files = Array.from(e.dataTransfer.files || []).filter(f => f.type.startsWith(
                        'image/'));
                    if (!files.length) return;

                    // Build a DataTransfer to set input.files
                    const dt = new DataTransfer();
                    if (multiple) {
                        files.forEach(f => dt.items.add(f));
                    } else {
                        dt.items.add(files[0]);
                    }
                    inputEl.files = dt.files;

                    // trigger change
                    inputEl.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                });
            };

            // ---------- Main Image Preview ----------
            const mainInput = document.getElementById('main_image');
            const mainWrap = mainInput?.closest('label');
            const mainPrev = document.getElementById('mainImagePreview');
            const mainImg = document.getElementById('mainImagePreviewImg');
            const mainCap = document.getElementById('mainImagePreviewCap');

            if (mainInput && mainPrev && mainImg && mainCap) {
                mainInput.addEventListener('change', () => {
                    const file = mainInput.files?.[0];
                    if (!file || !file.type.startsWith('image/')) {
                        mainPrev.classList.add('hidden');
                        return;
                    }
                    const url = URL.createObjectURL(file);
                    mainImg.src = url;
                    mainCap.textContent = file.name;
                    mainPrev.classList.remove('hidden');
                });

                bindDropZone(mainWrap, mainInput, {
                    multiple: false
                });
            }

            // ---------- Gallery Preview ----------
            const gallery = document.getElementById('gallery');
            const galWrap = gallery?.closest('label');
            const preview = document.getElementById('galleryPreview');

            if (gallery && preview) {
                gallery.addEventListener('change', () => {
                    preview.innerHTML = '';

                    const files = Array.from(gallery.files || []);
                    files.forEach((file) => {
                        if (!file.type.startsWith('image/')) return;

                        const url = URL.createObjectURL(file);

                        const wrap = document.createElement('div');
                        wrap.className = 'rounded-md border border-white/10 bg-white/5 overflow-hidden';

                        const img = document.createElement('img');
                        img.src = url;
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

                bindDropZone(galWrap, gallery, {
                    multiple: true
                });
            }
        })();
    </script>

    
@endpush
