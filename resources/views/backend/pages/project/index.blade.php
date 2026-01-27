@extends('layouts.app')
@section('title','Admin | Projects')
@section('breadcrumb','Projects')

@section('content')
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-emerald-200/80 font-mono text-xs tracking-widest">&gt; PROJECT_CONTROL</p>
            <h1 class="mt-2 text-2xl font-extrabold text-white cyber-text tracking-wide">PROJECTS</h1>
            <p class="mt-2 text-sm text-slate-300">Manage website projects from here.</p>
        </div>

        <a href="{{ route('admin.project.create') }}"
           class="rounded-md bg-emerald-400/20 border border-emerald-400/30 px-4 py-3 text-sm font-semibold text-emerald-100 hover:bg-emerald-400/25 transition cyber-glow">
            + NEW_PROJECT
        </a>
    </div>

    {{-- Multi actions --}}
    <div class="mt-6 flex items-center justify-between gap-4">
        <button type="button" id="multiDeleteBtn"
                class="rounded-md border border-red-400/20 bg-red-400/10 px-4 py-2 text-xs font-mono text-red-200 hover:border-red-400/35 hover:bg-red-400/15 transition">
            Delete Selected
        </button>

        <div id="msgBox" class="text-xs font-mono text-slate-300"></div>
    </div>

    {{-- Table --}}
    <div class="mt-4 rounded-md glass cyber-glow p-5 relative">
        <div class="absolute inset-0 scanline rounded-md pointer-events-none"></div>

        <div class="mt-1 overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-slate-300 font-mono text-xs">
                <tr class="border-b border-white/10">
                    <th class="py-3 px-3 text-left">
                        <input type="checkbox" id="checkAll"
                               class="rounded border-white/20 bg-slate-950/40 text-emerald-400">
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
                    <tr class="border-b border-white/5 hover:bg-white/5 transition">
                        <td class="py-3 px-3">
                            <input type="checkbox"
                                   class="row-check rounded border-white/20 bg-slate-950/40 text-emerald-400"
                                   value="{{ $p->id }}">
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
                            <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-2.5 py-1 text-xs font-mono text-slate-200">
                                {{ $p->status }}
                            </span>
                        </td>

                        <td class="py-3 px-3">
                            <button type="button"
                                    data-id="{{ $p->id }}"
                                    class="vis-btn rounded-full border px-2.5 py-1 text-xs font-mono transition
                                    {{ $p->visibility ? 'border-emerald-400/25 bg-emerald-400/10 text-emerald-200' : 'border-red-400/25 bg-red-400/10 text-red-200' }}">
                                {{ $p->visibility ? 'ACTIVE' : 'HIDDEN' }}
                            </button>
                        </td>

                        <td class="py-3 px-3 font-mono text-xs text-slate-400">
                            {{ $p->updated_at?->format('d M Y') }}
                        </td>

                        <td class="py-3 px-3 text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ route('admin.project.edit', $p->id) }}"
                                   class="rounded-md border border-white/10 bg-white/5 px-3 py-2 text-xs font-mono text-slate-200 hover:border-emerald-400/25 hover:text-emerald-200 transition">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admin.project.destroy', $p->id) }}"
                                      onsubmit="return confirm('Delete this project?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="rounded-md border border-red-400/20 bg-red-400/10 px-3 py-2 text-xs font-mono text-red-200 hover:border-red-400/35 hover:bg-red-400/15 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-10 text-center text-slate-400">
                            No projects found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $projects->links() }}
        </div>
    </div>

    {{-- jQuery (CDN) --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(function () {

            // CSRF setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Check all
            $('#checkAll').on('change', function () {
                $('.row-check').prop('checked', $(this).prop('checked'));
            });

            // Multi delete
            $('#multiDeleteBtn').on('click', function () {
                let ids = $('.row-check:checked').map(function () {
                    return $(this).val();
                }).get();

                if (ids.length === 0) {
                    $('#msgBox').text('No project selected.');
                    return;
                }

                if (!confirm('Delete selected projects?')) return;

                $.ajax({
                    url: "{{ route('admin.project.multi_destroy') }}",
                    type: "DELETE",
                    data: { ids: ids },
                    success: function (res) {
                        $('#msgBox').text(res.message || 'Deleted.');

                        $('.row-check:checked').each(function () {
                            $(this).closest('tr').fadeOut(200, function () {
                                $(this).remove();
                            });
                        });

                        $('#checkAll').prop('checked', false);
                    },
                    error: function (xhr) {
                        let msg = 'Something went wrong.';
                        if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                        $('#msgBox').text(msg);
                    }
                });
            });

            // Visibility toggle
            $(document).on('click', '.vis-btn', function () {
                let btn = $(this);
                let id = btn.data('id');

                $.ajax({
                    url: "{{ url('project/visibility-change') }}/" + id,
                    type: "GET",
                    success: function (res) {
                        if (!res.status) return;

                        if (res.visibility) {
                            btn.text('ACTIVE')
                                .removeClass('border-red-400/25 bg-red-400/10 text-red-200')
                                .addClass('border-emerald-400/25 bg-emerald-400/10 text-emerald-200');
                        } else {
                            btn.text('HIDDEN')
                                .removeClass('border-emerald-400/25 bg-emerald-400/10 text-emerald-200')
                                .addClass('border-red-400/25 bg-red-400/10 text-red-200');
                        }
                    }
                });
            });

        });
    </script>
@endsection