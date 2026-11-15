<div wire:poll.30s>
    {{-- Header sapaan & CTA utama --}}
    <div class="mb-6 flex flex-col gap-3.5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-0.5 text-[10px] font-bold tracking-widest text-emerald-700 ring-1 ring-emerald-200/70">PORTAL WARGA</span>
            <h1 class="mt-2 font-display text-xl font-extrabold tracking-tight text-balance text-stone-900 sm:text-2xl">{{ 'Selamat Datang, '.auth()->user()->name.'!' }}</h1>
            <p class="mt-1 text-xs leading-relaxed text-stone-500 sm:text-sm">Pantau laporan Anda atau sampaikan pengaduan baru dengan cepat.</p>
        </div>
        <a
            href="{{ route('warga.laporan.create') }}"
            class="inline-flex min-h-10 shrink-0 items-center justify-center gap-2 rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-4 py-2.5 text-sm font-bold text-white shadow-sm shadow-emerald-950/15 transition-all duration-200 hover:-translate-y-0.5 hover:from-emerald-700 hover:to-teal-800 active:scale-[0.98] motion-reduce:transform-none"
        >
            <i data-lucide="plus" aria-hidden="true" class="size-4 shrink-0"></i>
            Buat Pengaduan
        </a>
    </div>

    {{-- Ringkasan statistik dari data Livewire --}}
    <div class="mb-6 grid gap-3.5 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-xs transition-colors hover:border-stone-300">
            <div class="flex items-center justify-between gap-3">
                <span class="text-xs font-semibold text-stone-500 sm:text-sm">Total Pengaduan</span>
                <span class="rounded-xl bg-stone-100 p-2.5 text-stone-700">
                    <i data-lucide="files" aria-hidden="true" class="size-4 shrink-0"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-2xl font-extrabold tracking-tight text-stone-900 tabular-nums sm:text-3xl">{{ number_format($total) }}</p>
            <p class="mt-1 text-[11px] font-medium text-stone-500">Seluruh pengaduan Anda</p>
        </div>

        <div class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-xs transition-colors hover:border-amber-200">
            <div class="flex items-center justify-between gap-3">
                <span class="text-xs font-semibold text-stone-500 sm:text-sm">Menunggu</span>
                <span class="rounded-xl bg-amber-50 p-2.5 text-amber-600 ring-1 ring-amber-200/60">
                    <i data-lucide="clock-3" aria-hidden="true" class="size-4 shrink-0"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-2xl font-extrabold tracking-tight text-stone-900 tabular-nums sm:text-3xl">{{ number_format($stats['pending']) }}</p>
            <p class="mt-1 text-[11px] font-medium text-stone-500">Menunggu peninjauan admin</p>
        </div>

        <div class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-xs transition-colors hover:border-sky-200">
            <div class="flex items-center justify-between gap-3">
                <span class="text-xs font-semibold text-stone-500 sm:text-sm">Sedang Diproses</span>
                <span class="rounded-xl bg-sky-50 p-2.5 text-sky-700 ring-1 ring-sky-200/60">
                    <i data-lucide="loader-circle" aria-hidden="true" class="size-4 shrink-0"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-2xl font-extrabold tracking-tight text-stone-900 tabular-nums sm:text-3xl">{{ number_format($stats['proses']) }}</p>
            <p class="mt-1 text-[11px] font-medium text-stone-500">Sedang ditindaklanjuti</p>
        </div>

        <div class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-xs transition-colors hover:border-emerald-200">
            <div class="flex items-center justify-between gap-3">
                <span class="text-xs font-semibold text-stone-500 sm:text-sm">Selesai</span>
                <span class="rounded-xl bg-emerald-50 p-2.5 text-emerald-600 ring-1 ring-emerald-200/60">
                    <i data-lucide="circle-check" aria-hidden="true" class="size-4 shrink-0"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-2xl font-extrabold tracking-tight text-stone-900 tabular-nums sm:text-3xl">{{ number_format($stats['selesai']) }}</p>
            <p class="mt-1 text-[11px] font-medium text-stone-500">Telah tuntas ditangani</p>
        </div>
    </div>

    {{-- Panduan Alur Pelaporan & CTA Banner --}}
    <div class="mb-6 rounded-2xl border border-emerald-200/75 bg-linear-to-r from-emerald-50/90 via-teal-50/50 to-white p-5 shadow-2xs">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-start gap-3.5">
                <span class="hidden rounded-xl bg-linear-to-br from-emerald-600 to-teal-700 p-3 text-white shadow-sm shadow-emerald-950/15 sm:inline-flex">
                    <i data-lucide="megaphone" aria-hidden="true" class="size-5 shrink-0"></i>
                </span>
                <div>
                    <h2 class="font-display text-base font-bold text-stone-900">Lihat masalah di sekitar Anda?</h2>
                    <div class="mt-2 flex flex-wrap items-center gap-1.5 text-[11px] font-semibold text-stone-700">
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200/70 bg-white px-2.5 py-0.5">
                            <span class="flex size-4 items-center justify-center rounded-full bg-emerald-600 text-[10px] font-bold text-white">1</span>
                            Kirim Laporan
                        </span>
                        <i data-lucide="chevron-right" aria-hidden="true" class="size-3 text-stone-400"></i>
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200/70 bg-white px-2.5 py-0.5">
                            <span class="flex size-4 items-center justify-center rounded-full bg-amber-500 text-[10px] font-bold text-white">2</span>
                            Ditinjau (Bisa Edit/Hapus)
                        </span>
                        <i data-lucide="chevron-right" aria-hidden="true" class="size-3 text-stone-400"></i>
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200/70 bg-white px-2.5 py-0.5">
                            <span class="flex size-4 items-center justify-center rounded-full bg-teal-600 text-[10px] font-bold text-white">3</span>
                            Ditangani Selesai
                        </span>
                    </div>
                </div>
            </div>
            <a href="{{ route('warga.laporan.create') }}" class="inline-flex min-h-10 shrink-0 items-center justify-center gap-1.5 rounded-xl bg-white px-4 py-2 text-xs font-bold text-emerald-700 shadow-2xs ring-1 ring-emerald-200/90 transition-colors hover:bg-emerald-50 sm:text-sm">
                Sampaikan sekarang
                <i data-lucide="arrow-right" aria-hidden="true" class="size-4 shrink-0"></i>
            </a>
        </div>
    </div>

    {{-- Pengaduan terbaru --}}
    <div class="overflow-hidden rounded-2xl border border-stone-200/80 bg-white shadow-xs">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-stone-100 px-5 py-4">
            <div>
                <h2 class="font-display text-sm font-bold text-stone-900 sm:text-base">Pengaduan Terbaru</h2>
                <p class="mt-0.5 text-xs text-stone-500">5 pengaduan terakhir yang Anda ajukan</p>
            </div>
            <a href="{{ route('warga.laporan.index') }}" class="inline-flex min-h-9 items-center gap-1.5 rounded-xl bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200/60 transition-colors hover:bg-emerald-100/80">
                Lihat semua
                <i data-lucide="arrow-right" aria-hidden="true" class="size-3.5 shrink-0"></i>
            </a>
        </div>

        @if($recent->isEmpty())
            <div class="px-5 py-12 text-center">
                <div class="mx-auto mb-4 flex size-14 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-200/60">
                    <i data-lucide="inbox" aria-hidden="true" class="size-7 shrink-0"></i>
                </div>
                <h3 class="font-display text-base font-bold text-stone-900">Belum ada pengaduan</h3>
                <p class="mx-auto mt-1.5 max-w-sm text-xs leading-relaxed text-stone-500 sm:text-sm">Ada masalah di lingkungan sekitar? Sampaikan pengaduan pertama Anda sekarang.</p>
                <div class="mt-5">
                    <a
                        href="{{ route('warga.laporan.create') }}"
                        class="inline-flex min-h-10 items-center justify-center gap-2 rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-4 py-2.5 text-sm font-bold text-white shadow-sm shadow-emerald-950/15 transition-all duration-200 hover:-translate-y-0.5 hover:from-emerald-700 hover:to-teal-800 motion-reduce:transform-none"
                    >
                        <i data-lucide="plus" aria-hidden="true" class="size-4 shrink-0"></i>
                        Buat Pengaduan
                    </a>
                </div>
            </div>
        @else
            {{-- Mobile Card List --}}
            <div class="divide-y divide-stone-100 md:hidden">
                @foreach($recent as $laporan)
                    <div wire:key="recent-card-{{ $laporan->id }}" class="space-y-2.5 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-[10px] font-bold tracking-wider text-stone-400 tabular-nums"># {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</p>
                                <p class="mt-0.5 text-sm font-bold wrap-anywhere text-stone-900">{{ $laporan->judul }}</p>
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
                        <div class="flex items-center justify-between gap-3 pt-1">
                            <span class="text-xs font-medium text-stone-500 tabular-nums">Diajukan {{ $laporan->created_at->translatedFormat('d M Y') }}</span>
                            <a
                                href="{{ route('warga.laporan.show', $laporan) }}"
                                class="inline-flex min-h-9 items-center gap-1 rounded-xl border border-stone-200 bg-stone-50/60 px-3 py-1.5 text-xs font-bold text-emerald-700 transition-colors hover:bg-emerald-50"
                            >
                                Detail
                                <i data-lucide="arrow-up-right" aria-hidden="true" class="size-3.5 shrink-0"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Desktop Table --}}
            <div class="hidden overflow-x-auto md:block">
                <table class="w-full text-left text-sm">
                    <thead class="bg-stone-50/80 text-[11px] uppercase tracking-wider text-stone-500">
                        <tr>
                            <th class="px-5 py-3 font-semibold">Pengaduan</th>
                            <th class="px-4 py-3 font-semibold">Tanggal Pengajuan</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                            <th class="px-5 py-3 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @foreach($recent as $laporan)
                            <tr wire:key="recent-row-{{ $laporan->id }}" class="transition-colors hover:bg-stone-50/70">
                                <td class="max-w-xs px-5 py-3.5">
                                    <p class="truncate font-bold text-stone-900">{{ $laporan->judul }}</p>
                                    <p class="mt-0.5 text-[11px] font-medium text-stone-400 tabular-nums"># {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</p>
                                </td>
                                <td class="px-4 py-3.5 text-xs font-medium text-stone-600 tabular-nums">{{ $laporan->created_at->translatedFormat('d M Y') }}</td>
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
                                <td class="px-5 py-3.5 text-right">
                                    <a
                                        href="{{ route('warga.laporan.show', $laporan) }}"
                                        class="inline-flex min-h-9 items-center gap-1 rounded-xl px-3 py-1.5 text-xs font-bold text-emerald-700 transition-colors hover:bg-emerald-50"
                                    >
                                        Detail
                                        <i data-lucide="arrow-up-right" aria-hidden="true" class="size-3.5 shrink-0"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="mt-5 flex items-center gap-2 text-xs font-medium text-stone-500">
        <i data-lucide="info" aria-hidden="true" class="size-4 shrink-0 text-emerald-600"></i>
        <span>Pengaduan dapat diedit atau dihapus selama berstatus Menunggu.</span>
    </div>
</div>
