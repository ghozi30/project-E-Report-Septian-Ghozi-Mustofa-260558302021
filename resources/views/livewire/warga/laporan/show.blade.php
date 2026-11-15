<div wire:poll.15s>
    <x-toast />

    <div class="mb-5">
        <nav aria-label="Breadcrumb" class="mb-2 flex items-center gap-1.5 text-xs font-medium text-stone-500">
            <a href="{{ route('warga.dashboard') }}" class="transition-colors hover:text-emerald-700">Dashboard</a>
            <i data-lucide="chevron-right" aria-hidden="true" class="size-3.5 text-stone-400"></i>
            <a href="{{ route('warga.laporan.index') }}" class="transition-colors hover:text-emerald-700">Pengaduan Saya</a>
            <i data-lucide="chevron-right" aria-hidden="true" class="size-3.5 text-stone-400"></i>
            <span class="font-semibold text-stone-800 tabular-nums"># {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</span>
        </nav>

        <div class="flex flex-col gap-3.5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="font-display text-xl font-extrabold tracking-tight text-stone-900 sm:text-2xl">Detail Pengaduan</h1>
                <p class="mt-1 text-xs leading-relaxed text-stone-500 sm:text-sm">Pantau progres penanganan dan kelengkapan informasi laporan Anda.</p>
            </div>
            <a
                href="{{ route('warga.laporan.index') }}"
                class="inline-flex min-h-10 shrink-0 items-center justify-center gap-2 rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-bold text-stone-700 shadow-2xs transition-colors hover:bg-stone-50 sm:text-sm"
            >
                <i data-lucide="arrow-left" aria-hidden="true" class="size-4 shrink-0"></i>
                Kembali ke Daftar
            </a>
        </div>
    </div>

    <div class="grid items-start gap-5 lg:grid-cols-[1fr_300px]">
        {{-- Informasi lengkap pengaduan --}}
        <article class="overflow-hidden rounded-2xl border border-stone-200/80 bg-white shadow-xs">
            <div class="border-b border-stone-100 bg-stone-50/50 p-5 sm:p-6">
                <div class="mb-3 flex flex-wrap items-center justify-between gap-2.5">
                    <span class="rounded-lg bg-stone-100 px-2.5 py-1 text-[11px] font-bold tracking-wider text-stone-600 tabular-nums">PENGADUAN # {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</span>
                    <span @class([
                        'inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-3 py-1 text-xs font-bold',
                        'bg-amber-50 text-amber-800 ring-1 ring-inset ring-amber-200/80' => $laporan->status === 'pending',
                        'bg-sky-50 text-sky-800 ring-1 ring-inset ring-sky-200/80' => $laporan->status === 'proses',
                        'bg-emerald-50 text-emerald-800 ring-1 ring-inset ring-emerald-200/80' => $laporan->status === 'selesai',
                    ])>
                        <span class="size-1.5 rounded-full bg-current"></span>
                        {{ \App\Models\Laporan::STATUSES[$laporan->status] ?? $laporan->status }}
                    </span>
                </div>

                <h2 class="font-display text-lg leading-snug font-extrabold wrap-anywhere text-stone-900 sm:text-xl">{{ $laporan->judul }}</h2>

                <div class="mt-4 grid gap-3 text-xs text-stone-500 sm:grid-cols-2">
                    <div class="flex items-center gap-2.5 rounded-xl border border-stone-200/75 bg-white px-3.5 py-2.5">
                        <span class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700">
                            <i data-lucide="calendar-days" aria-hidden="true" class="size-4 shrink-0"></i>
                        </span>
                        <div>
                            <span class="block text-[10px] font-medium text-stone-400">Tanggal Kejadian</span>
                            <strong class="block font-bold text-stone-800 tabular-nums">{{ $laporan->tanggal->translatedFormat('d F Y') }}</strong>
                        </div>
                    </div>
                    <div class="flex items-center gap-2.5 rounded-xl border border-stone-200/75 bg-white px-3.5 py-2.5">
                        <span class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700">
                            <i data-lucide="clock-3" aria-hidden="true" class="size-4 shrink-0"></i>
                        </span>
                        <div>
                            <span class="block text-[10px] font-medium text-stone-400">Waktu Diajukan</span>
                            <strong class="block font-bold text-stone-800 tabular-nums">{{ $laporan->created_at->translatedFormat('d M Y, H:i') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-5 sm:p-6">
                <h3 class="mb-2.5 font-display text-sm font-bold tracking-wide text-stone-900">Deskripsi Pengaduan</h3>
                <p class="text-sm leading-7 wrap-anywhere whitespace-pre-line text-stone-700">{{ $laporan->detail }}</p>

                <div class="mt-6 border-t border-stone-100 pt-5">
                    <div class="mb-3 flex items-center justify-between gap-2">
                        <h3 class="font-display text-sm font-bold tracking-wide text-stone-900">Foto Bukti</h3>
                        @if($laporan->foto)
                            <a href="{{ Storage::disk('public')->url($laporan->foto) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 hover:underline">
                                Buka ukuran penuh
                                <i data-lucide="external-link" aria-hidden="true" class="size-3.5 shrink-0"></i>
                            </a>
                        @endif
                    </div>

                    @if($laporan->foto)
                        <a href="{{ Storage::disk('public')->url($laporan->foto) }}" target="_blank" rel="noopener" class="group block overflow-hidden rounded-xl border border-stone-200 bg-stone-50 p-2">
                            <img src="{{ Storage::disk('public')->url($laporan->foto) }}" alt="Foto bukti: {{ $laporan->judul }}" class="max-h-[380px] w-full rounded-lg object-contain transition-transform duration-300 group-hover:scale-[1.01] motion-reduce:transform-none">
                        </a>
                        <p class="mt-2 text-xs text-stone-400">Klik gambar untuk membuka pratinjau ukuran penuh di tab baru.</p>
                    @else
                        <div class="flex items-center gap-3 rounded-xl border border-dashed border-stone-200 bg-stone-50/80 p-4 text-xs text-stone-500 sm:text-sm">
                            <i data-lucide="image" aria-hidden="true" class="size-4 shrink-0 text-stone-400"></i>
                            <span>Tidak ada foto bukti yang dilampirkan pada pengaduan ini.</span>
                        </div>
                    @endif
                </div>
            </div>
        </article>

        <aside class="space-y-4 lg:sticky lg:top-20">
            {{-- Tahapan penanganan --}}
            <section class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-xs">
                <h2 class="font-display text-base font-bold text-stone-900">Progres Pengaduan</h2>
                <p class="mt-0.5 text-xs text-stone-500">Status diperbarui otomatis secara berkala.</p>

                <ol class="relative mt-5 space-y-5">
                    @foreach([
                        'pending' => ['clock-3', 'Menunggu Peninjauan', 'Laporan diterima sistem'],
                        'proses' => ['loader-circle', 'Sedang Diproses', 'Ditindaklanjuti pengelola'],
                        'selesai' => ['circle-check', 'Selesai Ditangani', 'Penanganan rampung']
                    ] as $status => [$icon, $label, $sub])
                        @php
                            $currentIndex = array_search($laporan->status, ['pending', 'proses', 'selesai']);
                            $reached = $currentIndex >= $loop->index;
                            $isCurrent = $laporan->status === $status;
                        @endphp
                        <li class="relative flex items-start gap-3">
                            @if(!$loop->last)
                                <span aria-hidden="true" @class([
                                    'absolute top-9 left-4.5 -ml-px h-5 w-0.5',
                                    'bg-emerald-500' => $currentIndex > $loop->index,
                                    'bg-stone-200' => $currentIndex <= $loop->index,
                                ])></span>
                            @endif
                            <span @class([
                                'relative z-10 flex size-9 shrink-0 items-center justify-center rounded-xl transition-colors',
                                'bg-linear-to-br from-emerald-600 to-teal-700 text-white shadow-sm shadow-emerald-950/15 ring-4 ring-emerald-50' => $isCurrent,
                                'bg-emerald-100 text-emerald-700' => $reached && !$isCurrent,
                                'bg-stone-100 text-stone-400' => !$reached,
                            ])>
                                <i data-lucide="{{ $icon }}" aria-hidden="true" class="size-4 shrink-0"></i>
                            </span>
                            <div class="min-w-0 pt-0.5">
                                <p @class(['text-xs font-bold', 'text-stone-900' => $reached, 'text-stone-400' => !$reached])>{{ $label }}</p>
                                <p class="mt-0.5 text-[11px] text-stone-500">{{ $sub }}</p>
                                @if($isCurrent)
                                    <span class="mt-1 inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-bold text-emerald-700 ring-1 ring-emerald-200/70">
                                        <span class="size-1.5 rounded-full bg-emerald-600"></span>
                                        Tahap saat ini
                                    </span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ol>

                <div class="mt-5 rounded-xl border border-stone-200/70 bg-stone-50 p-3.5 text-xs font-medium leading-5 text-stone-600">
                    {{ $laporan->statusDescription() }}
                </div>
            </section>

            @can('update', $laporan)
                <section class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-xs">
                    <h2 class="font-display text-sm font-bold text-stone-900">Kelola Pengaduan</h2>
                    <p class="mt-1 text-xs leading-5 text-stone-500">Selama status masih Menunggu, Anda bebas memperbarui isi laporan atau menghapusnya.</p>
                    <a
                        href="{{ route('warga.laporan.edit', $laporan) }}"
                        class="mt-3.5 inline-flex min-h-10 w-full items-center justify-center gap-2 rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-bold text-stone-700 shadow-2xs transition-colors hover:border-emerald-200 hover:bg-emerald-50/60 hover:text-emerald-800 sm:text-sm"
                    >
                        <i data-lucide="pencil" aria-hidden="true" class="size-4 shrink-0"></i>
                        Edit Pengaduan
                    </a>
                    <button
                        type="button"
                        wire:loading.attr="disabled"
                        wire:click="delete"
                        wire:confirm="Hapus pengaduan beserta foto buktinya? Tindakan ini tidak dapat dibatalkan."
                        class="mt-2.5 inline-flex min-h-10 w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-xs font-bold text-red-700 transition-colors hover:bg-red-100 sm:text-sm"
                    >
                        <i data-lucide="trash-2" aria-hidden="true" class="size-4 shrink-0"></i>
                        Hapus Pengaduan
                    </button>
                </section>
            @endcan
        </aside>
    </div>
</div>
