<div wire:poll.30s>
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="font-display text-2xl font-extrabold tracking-tight text-stone-900 sm:text-3xl">Dashboard Administrator</h1>
            <p class="mt-2 text-sm leading-relaxed text-stone-500">Pantau pengaduan dan tindak lanjuti kebutuhan warga.</p>
        </div>
        <a
            href="{{ route('admin.laporan.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-700 px-5 py-3 text-sm font-bold text-white shadow-md shadow-emerald-900/15 transition hover:from-emerald-700 hover:to-teal-800"
        >
            Kelola Pengaduan
            <i data-lucide="arrow-right" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
        </a>
    </div>
    {{-- Ringkasan dari data yang dikirim oleh class Livewire --}}
    <div class="mb-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
        <div class="rounded-3xl border border-stone-200/80 bg-white p-5 shadow-xs">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm font-medium text-stone-500">Total Pengaduan</span>
                <span class="rounded-2xl bg-stone-100 p-2.5 text-stone-700">
                    <i data-lucide="files" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-extrabold tracking-tight text-stone-900">{{ number_format($total) }}</p>
            <p class="mt-1.5 text-xs font-medium text-stone-400">Pengaduan tercatat</p>
        </div>
        <div class="rounded-3xl border border-stone-200/80 bg-white p-5 shadow-xs">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm font-medium text-stone-500">Menunggu</span>
                <span class="rounded-2xl bg-amber-50 p-2.5 text-amber-600 ring-1 ring-amber-200/60">
                    <i data-lucide="clock-3" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-extrabold tracking-tight text-stone-900">{{ number_format($stats['pending']) }}</p>
            <p class="mt-1.5 text-xs font-medium text-stone-400">Pengaduan tercatat</p>
        </div>
        <div class="rounded-3xl border border-stone-200/80 bg-white p-5 shadow-xs">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm font-medium text-stone-500">Sedang Diproses</span>
                <span class="rounded-2xl bg-sky-50 p-2.5 text-sky-600 ring-1 ring-sky-200/60">
                    <i data-lucide="loader-circle" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-extrabold tracking-tight text-stone-900">{{ number_format($stats['proses']) }}</p>
            <p class="mt-1.5 text-xs font-medium text-stone-400">Pengaduan tercatat</p>
        </div>
        <div class="rounded-3xl border border-stone-200/80 bg-white p-5 shadow-xs">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm font-medium text-stone-500">Selesai</span>
                <span class="rounded-2xl bg-emerald-50 p-2.5 text-emerald-600 ring-1 ring-emerald-200/60">
                    <i data-lucide="circle-check" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-extrabold tracking-tight text-stone-900">{{ number_format($stats['selesai']) }}</p>
            <p class="mt-1.5 text-xs font-medium text-stone-400">Pengaduan tercatat</p>
        </div>
        <div class="rounded-3xl border border-stone-200/80 bg-white p-5 shadow-xs">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm font-medium text-stone-500">Warga Terdaftar</span>
                <span class="rounded-2xl bg-teal-50 p-2.5 text-teal-700 ring-1 ring-teal-200/60">
                    <i data-lucide="users" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-extrabold tracking-tight text-stone-900">{{ number_format($citizens) }}</p>
            <p class="mt-1.5 text-xs font-medium text-stone-400">Akun warga aktif</p>
        </div>
    </div>
    <div class="mb-8 grid gap-6 lg:grid-cols-[1.4fr_1fr]">
        <section class="rounded-3xl border border-stone-200/80 bg-white p-6 shadow-xs">
            <h2 class="font-display font-bold text-stone-900">Ringkasan Status Pengaduan</h2>
            <p class="mt-1 text-xs text-stone-400">Distribusi seluruh pengaduan yang masuk</p>
            <div class="mt-7 space-y-6">
                @foreach(\App\Models\Laporan::STATUSES as $status => $label)
                    <div>
                        <div class="mb-2 flex justify-between text-xs">
                            <span class="font-semibold text-stone-600">{{ $label }}</span>
                            <span class="font-bold text-stone-900">
                                {{ $stats[$status] }}
                                <span class="ml-2 font-normal text-stone-400">( {{ $total ? round($stats[$status] / $total * 100) : 0 }} %)</span>
                            </span>
                        </div>
                        <div class="h-2.5 overflow-hidden rounded-full bg-stone-100" role="meter" aria-label="{{ $label }}" aria-valuenow="{{ $stats[$status] }}" aria-valuemin="0" aria-valuemax="{{ max(1, $total) }}">
                            <div @class(['h-full rounded-full transition-all duration-500', 'bg-amber-400' => $status === 'pending', 'bg-sky-500' => $status === 'proses', 'bg-emerald-500' => $status === 'selesai']) style="width: {{ $total ? $stats[$status] / $total * 100 : 0 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="relative flex flex-col justify-between overflow-hidden rounded-3xl bg-[#07261E] p-7 text-white shadow-xl shadow-emerald-950/20">
            <div class="pointer-events-none absolute -top-20 -right-20 h-60 w-60 rounded-full bg-emerald-500/25 blur-3xl"></div>
            <span class="relative z-10 mb-5 inline-flex w-fit rounded-2xl bg-white/10 p-3 text-amber-300 ring-1 ring-white/15">
                <i data-lucide="clipboard-list" aria-hidden="true" class="h-7 w-7 shrink-0"></i>
            </span>
            <div class="relative z-10">
                <p class="font-display text-xl font-extrabold">{{ $stats['pending'] }} pengaduan menunggu</p>
                <p class="mt-3 text-sm leading-7 text-emerald-100/80">Tinjau laporan yang masuk dan mulai penanganan untuk membantu warga.</p>
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="relative z-10 mt-6 inline-flex w-fit items-center gap-2 rounded-xl bg-amber-300 px-4 py-2.5 text-sm font-bold text-stone-950 transition hover:bg-amber-200">
                Tinjau pengaduan
                <i data-lucide="arrow-right" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
            </a>
        </section>
    </div>
    {{-- Pengaduan terbaru --}}
    <div class="overflow-hidden rounded-3xl border border-stone-200/80 bg-white shadow-xs">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-stone-100 px-6 py-5">
            <div>
                <h2 class="font-display font-bold text-stone-900">Pengaduan Terbaru</h2>
                <p class="mt-1 text-xs text-stone-400">Perkembangan terbaru dari pengaduan warga</p>
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-50 px-3.5 py-2 text-xs font-bold text-emerald-700 transition hover:bg-emerald-100">
                Lihat semua
                <i data-lucide="arrow-right" aria-hidden="true" class="h-3.5 w-3.5 shrink-0"></i>
            </a>
        </div>
        @if($recent->isEmpty())
            <div class="px-6 py-16 text-center">
                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/60">
                    <i data-lucide="inbox" aria-hidden="true" class="h-8 w-8 shrink-0"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-stone-800">Belum ada pengaduan</h3>
                <p class="mx-auto mt-2 max-w-sm text-sm leading-relaxed text-stone-500">Pengaduan dari warga akan muncul di sini.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[580px] text-left text-sm">
                    <thead class="bg-stone-50/80 text-xs uppercase tracking-wider text-stone-400">
                        <tr>
                            <th class="px-6 py-3.5 font-semibold">Pengaduan</th>
                            <th class="px-4 py-3.5 font-semibold">Pelapor</th>
                            <th class="px-4 py-3.5 font-semibold">Tanggal Pengajuan</th>
                            <th class="px-4 py-3.5 font-semibold">Status</th>
                            <th class="px-6 py-3.5 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @foreach($recent as $laporan)
                            <tr class="transition hover:bg-stone-50/70">
                                <td class="max-w-xs px-6 py-5">
                                    <p class="truncate font-bold text-stone-800">{{ $laporan->judul }}</p>
                                    <p class="mt-1 text-xs font-medium text-stone-400"># {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</p>
                                </td>
                                <td class="px-4 py-5 font-medium text-stone-600">{{ $laporan->pelapor->name }}</td>
                                <td class="px-4 py-5 text-xs font-medium text-stone-500">{{ $laporan->created_at->translatedFormat('d M Y') }}</td>
                                <td class="px-4 py-5">
                                    <span @class([
                                    'inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-3 py-1.5 text-xs font-bold',
                                    'bg-amber-50 text-amber-800 ring-1 ring-inset ring-amber-200' => $laporan->status === 'pending',
                                    'bg-sky-50 text-sky-800 ring-1 ring-inset ring-sky-200' => $laporan->status === 'proses',
                                    'bg-emerald-50 text-emerald-800 ring-1 ring-inset ring-emerald-200' => $laporan->status === 'selesai',
                                    ])>
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ \App\Models\Laporan::STATUSES[$laporan->status] ?? $laporan->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <a
                                        href="{{ route('admin.laporan.show', $laporan) }}"
                                        class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-xs font-bold text-emerald-700 transition hover:bg-emerald-50"
                                    >
                                        Detail
                                        <i data-lucide="arrow-up-right" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
