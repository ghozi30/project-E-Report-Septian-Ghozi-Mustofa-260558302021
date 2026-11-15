<div>
    <div class="mb-5">
        <nav aria-label="Breadcrumb" class="mb-2 flex items-center gap-1.5 text-xs font-medium text-stone-500">
            <a href="{{ route('warga.dashboard') }}" class="transition-colors hover:text-emerald-700">Dashboard</a>
            <i data-lucide="chevron-right" aria-hidden="true" class="size-3.5 text-stone-400"></i>
            <span class="font-semibold text-stone-800">Pengaduan Saya</span>
        </nav>
        <div class="flex flex-col gap-3.5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="font-display text-xl font-extrabold tracking-tight text-stone-900 sm:text-2xl">Pengaduan Saya</h1>
                <p class="mt-1 text-xs leading-relaxed text-stone-500 sm:text-sm">Riwayat pengaduan, status penanganan, dan pengelolaan laporan Anda.</p>
            </div>
            <a
                href="{{ route('warga.laporan.create') }}"
                class="inline-flex min-h-10 shrink-0 items-center justify-center gap-2 rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-4 py-2.5 text-sm font-bold text-white shadow-sm shadow-emerald-950/15 transition-all duration-200 hover:-translate-y-0.5 hover:from-emerald-700 hover:to-teal-800 active:scale-[0.98] motion-reduce:transform-none"
            >
                <i data-lucide="plus" aria-hidden="true" class="size-4 shrink-0"></i>
                Buat Pengaduan
            </a>
        </div>
    </div>

    <x-toast />

    {{-- Pencarian, tab cepat, dan filter status --}}
    <div class="mb-5 space-y-3 rounded-2xl border border-stone-200/80 bg-white p-4 shadow-2xs">
        <div class="flex flex-col gap-3 sm:flex-row">
            <div class="relative flex-1">
                <label for="search" class="sr-only">Cari pengaduan</label>
                <span class="pointer-events-none absolute top-3 left-3.5 text-stone-400">
                    <i data-lucide="search" aria-hidden="true" class="size-4 shrink-0"></i>
                </span>
                <input
                    id="search"
                    type="search"
                    wire:model.live.debounce.350ms="search"
                    placeholder="Cari berdasarkan judul pengaduan…"
                    class="min-h-10 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 py-2 pr-4 pl-10 text-base text-stone-900 placeholder:text-stone-400 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 sm:text-sm"
                >
            </div>
            <div>
                <label for="status" class="sr-only">Filter status</label>
                <select id="status" wire:model.live="status" class="min-h-10 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 px-3.5 py-2 text-sm font-medium text-stone-700 transition-colors outline-none focus:border-emerald-600 focus:bg-white sm:w-48">
                    <option value="">Semua status</option>
                    @foreach(\App\Models\Laporan::STATUSES as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-2">
            <div class="flex flex-wrap gap-1.5" role="group" aria-label="Filter cepat status">
                <button
                    type="button"
                    wire:click="$set('status', '')"
                    @class([
                        'min-h-8 rounded-full px-3 py-1 text-xs font-bold transition-colors',
                        'bg-stone-900 text-white' => $status === '',
                        'bg-stone-100 text-stone-600 hover:bg-stone-200/70' => $status !== '',
                    ])
                >Semua</button>
                @foreach(\App\Models\Laporan::STATUSES as $value => $label)
                    <button
                        type="button"
                        wire:click="$set('status', '{{ $value }}')"
                        @class([
                            'min-h-8 rounded-full px-3 py-1 text-xs font-bold transition-colors',
                            'bg-emerald-600 text-white shadow-xs' => $status === $value,
                            'bg-stone-100 text-stone-600 hover:bg-stone-200/70' => $status !== $value,
                        ])
                    >{{ $label }}</button>
                @endforeach
            </div>
            <span wire:loading role="status" class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700">
                <i data-lucide="loader-circle" aria-hidden="true" class="size-3.5 animate-spin motion-reduce:animate-none"></i>
                Memuat…
            </span>
        </div>
    </div>

    {{-- Daftar pengaduan dan pagination --}}
    <div class="overflow-hidden rounded-2xl border border-stone-200/80 bg-white shadow-xs">
        @if($laporans->isEmpty())
            <div class="px-5 py-12 text-center">
                <div class="mx-auto mb-4 flex size-14 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-200/60">
                    <i data-lucide="inbox" aria-hidden="true" class="size-7 shrink-0"></i>
                </div>
                <h2 class="font-display text-base font-bold text-stone-900">Belum ada pengaduan yang ditemukan</h2>
                <p class="mx-auto mt-1.5 max-w-sm text-xs leading-relaxed text-stone-500 sm:text-sm">Coba kata kunci atau filter status lain, atau mulai kirim pengaduan baru.</p>
                <div class="mt-5 flex flex-wrap justify-center gap-2.5">
                    @if($search !== '' || $status !== '')
                        <button
                            type="button"
                            wire:click="$set('search', ''); $set('status', '')"
                            class="inline-flex min-h-10 items-center justify-center rounded-xl border border-stone-200 bg-white px-4 py-2 text-sm font-bold text-stone-700 transition-colors hover:bg-stone-50"
                        >Reset Filter</button>
                    @endif
                    <a
                        href="{{ route('warga.laporan.create') }}"
                        class="inline-flex min-h-10 items-center justify-center gap-2 rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-4 py-2 text-sm font-bold text-white shadow-sm shadow-emerald-950/15 transition-all duration-200 hover:-translate-y-0.5 hover:from-emerald-700 hover:to-teal-800 motion-reduce:transform-none"
                    >Buat Pengaduan</a>
                </div>
            </div>
        @else
            {{-- Mobile Card List --}}
            <div class="divide-y divide-stone-100 md:hidden">
                @foreach($laporans as $laporan)
                    <div wire:key="laporan-card-{{ $laporan->id }}" class="space-y-3 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-[10px] font-bold tracking-wider text-stone-400 tabular-nums"># {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</p>
                                <a
                                    href="{{ route('warga.laporan.show', $laporan) }}"
                                    class="mt-0.5 block text-sm font-bold wrap-anywhere text-stone-900 hover:text-emerald-700"
                                >{{ $laporan->judul }}</a>
                            </div>
                            <span @class([
                                'inline-flex shrink-0 items-center gap-1.5 whitespace-nowrap rounded-full px-2.5 py-1 text-[11px] font-bold',
                                'bg-amber-50 text-amber-800 ring-1 ring-inset ring-amber-200/80' => $laporan->status === 'pending',
                                'bg-sky-50 text-sky-800 ring-1 ring-inset ring-sky-200/80' => $laporan->status === 'proses',
                                'bg-emerald-50 text-emerald-800 ring-1 ring-inset ring-emerald-200/80' => $laporan->status === 'selesai',
                            ])>
                                <span class="size-1.5 rounded-full bg-current"></span>
                                {{ \App\Models\Laporan::STATUSES[$laporan->status] ?? $laporan->status }}
                            </span>
                        </div>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-stone-500 tabular-nums">
                            <span>Kejadian: <strong class="font-semibold text-stone-700">{{ $laporan->tanggal->translatedFormat('d M Y') }}</strong></span>
                            <span>Diajukan: <strong class="font-semibold text-stone-700">{{ $laporan->created_at->translatedFormat('d M Y') }}</strong></span>
                        </div>
                        <div class="flex flex-wrap items-center justify-end gap-2">
                            <a
                                href="{{ route('warga.laporan.show', $laporan) }}"
                                class="inline-flex min-h-9 items-center gap-1.5 rounded-xl border border-stone-200 bg-white px-3 py-1.5 text-xs font-bold text-stone-700 transition-colors hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700"
                            >
                                <i data-lucide="eye" aria-hidden="true" class="size-3.5 shrink-0"></i>
                                Detail
                            </a>
                            @can('update', $laporan)
                                <a
                                    href="{{ route('warga.laporan.edit', $laporan) }}"
                                    class="inline-flex min-h-9 items-center gap-1.5 rounded-xl border border-stone-200 bg-white px-3 py-1.5 text-xs font-bold text-stone-700 transition-colors hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700"
                                >
                                    <i data-lucide="pencil" aria-hidden="true" class="size-3.5 shrink-0"></i>
                                    Edit
                                </a>
                                <button
                                    type="button"
                                    wire:click="delete({{ $laporan->id }})"
                                    wire:confirm="Hapus pengaduan ini? Foto bukti juga akan dihapus. Tindakan ini tidak dapat dibatalkan."
                                    wire:loading.attr="disabled"
                                    class="inline-flex min-h-9 items-center gap-1.5 rounded-xl border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700 transition-colors hover:bg-red-100"
                                >
                                    <i data-lucide="trash-2" aria-hidden="true" class="size-3.5 shrink-0"></i>
                                    Hapus
                                </button>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Desktop Table --}}
            <div class="hidden overflow-x-auto md:block">
                <table class="w-full min-w-[720px] text-left text-sm">
                    <thead class="border-b border-stone-100 bg-stone-50/80 text-[11px] uppercase tracking-wider text-stone-500">
                        <tr>
                            <th class="px-5 py-3.5 font-semibold">ID / Judul Pengaduan</th>
                            <th class="px-4 py-3.5 font-semibold">Tanggal Kejadian</th>
                            <th class="px-4 py-3.5 font-semibold">Tanggal Pengajuan</th>
                            <th class="px-4 py-3.5 font-semibold">Status</th>
                            <th class="px-5 py-3.5 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @foreach($laporans as $laporan)
                            <tr wire:key="laporan-row-{{ $laporan->id }}" class="transition-colors hover:bg-stone-50/80">
                                <td class="max-w-xs px-5 py-3.5">
                                    <p class="text-[10px] font-bold tracking-wider text-stone-400 tabular-nums"># {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</p>
                                    <a
                                        href="{{ route('warga.laporan.show', $laporan) }}"
                                        class="mt-0.5 block truncate font-bold text-stone-900 hover:text-emerald-700"
                                    >{{ $laporan->judul }}</a>
                                </td>
                                <td class="px-4 py-3.5 text-xs font-medium text-stone-600 tabular-nums">{{ $laporan->tanggal->translatedFormat('d M Y') }}</td>
                                <td class="px-4 py-3.5 text-xs font-medium text-stone-500 tabular-nums">{{ $laporan->created_at->translatedFormat('d M Y') }}</td>
                                <td class="px-4 py-3.5">
                                    <span @class([
                                        'inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-2.5 py-1 text-xs font-bold',
                                        'bg-amber-50 text-amber-800 ring-1 ring-inset ring-amber-200/80' => $laporan->status === 'pending',
                                        'bg-sky-50 text-sky-800 ring-1 ring-inset ring-sky-200/80' => $laporan->status === 'proses',
                                        'bg-emerald-50 text-emerald-800 ring-1 ring-inset ring-emerald-200/80' => $laporan->status === 'selesai',
                                    ])>
                                        <span class="size-1.5 rounded-full bg-current"></span>
                                        {{ \App\Models\Laporan::STATUSES[$laporan->status] ?? $laporan->status }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <div class="flex justify-end gap-1.5">
                                        <a
                                            href="{{ route('warga.laporan.show', $laporan) }}"
                                            aria-label="Detail {{ $laporan->judul }}"
                                            title="Detail"
                                            class="flex size-9 items-center justify-center rounded-xl border border-stone-200 text-stone-500 transition-colors hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700"
                                        >
                                            <i data-lucide="eye" aria-hidden="true" class="size-4 shrink-0"></i>
                                        </a>
                                        @can('update', $laporan)
                                            <a
                                                href="{{ route('warga.laporan.edit', $laporan) }}"
                                                aria-label="Edit {{ $laporan->judul }}"
                                                title="Edit"
                                                class="flex size-9 items-center justify-center rounded-xl border border-stone-200 text-stone-500 transition-colors hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700"
                                            >
                                                <i data-lucide="pencil" aria-hidden="true" class="size-4 shrink-0"></i>
                                            </a>
                                            <button
                                                type="button"
                                                wire:click="delete({{ $laporan->id }})"
                                                wire:confirm="Hapus pengaduan ini? Foto bukti juga akan dihapus. Tindakan ini tidak dapat dibatalkan."
                                                wire:loading.attr="disabled"
                                                aria-label="Hapus {{ $laporan->judul }}"
                                                title="Hapus"
                                                class="flex size-9 items-center justify-center rounded-xl border border-stone-200 text-stone-500 transition-colors hover:border-red-200 hover:bg-red-50 hover:text-red-600"
                                            >
                                                <i data-lucide="trash-2" aria-hidden="true" class="size-4 shrink-0"></i>
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-t border-stone-100 bg-stone-50/50 px-5 py-3.5">
                @if($laporans->hasPages())
                    <nav role="navigation" aria-label="Halaman pengaduan" class="flex flex-wrap items-center justify-between gap-4 text-xs">
                        <p class="text-stone-600 tabular-nums">Menampilkan {{ $laporans->firstItem() }} – {{ $laporans->lastItem() }} dari {{ $laporans->total() }} pengaduan</p>
                        <div class="flex items-center gap-2">
                            <button
                                type="button"
                                wire:click="previousPage('{{ $laporans->getPageName() }}')"
                                wire:loading.attr="disabled"
                                @disabled($laporans->onFirstPage())
                                class="min-h-9 rounded-xl border border-stone-200 bg-white px-3 py-1.5 font-semibold text-stone-700 transition-colors hover:bg-stone-50 disabled:opacity-40"
                            >Sebelumnya</button>
                            <span class="px-1 font-bold text-emerald-700 tabular-nums">{{ $laporans->currentPage() }} / {{ $laporans->lastPage() }}</span>
                            <button
                                type="button"
                                wire:click="nextPage('{{ $laporans->getPageName() }}')"
                                wire:loading.attr="disabled"
                                @disabled(!$laporans->hasMorePages())
                                class="min-h-9 rounded-xl border border-stone-200 bg-white px-3 py-1.5 font-semibold text-stone-700 transition-colors hover:bg-stone-50 disabled:opacity-40"
                            >Berikutnya</button>
                        </div>
                    </nav>
                @else
                    <p class="text-xs font-medium text-stone-500 tabular-nums">{{ $laporans->total() }} pengaduan ditampilkan</p>
                @endif
            </div>
        @endif
    </div>
</div>
