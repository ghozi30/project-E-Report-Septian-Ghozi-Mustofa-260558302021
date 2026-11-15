<div>
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="font-display text-2xl font-extrabold tracking-tight text-stone-900 sm:text-3xl">Tinjau Pengaduan</h1>
            <p class="mt-2 text-sm leading-relaxed text-stone-500">Periksa informasi dan tindak lanjuti pengaduan warga.</p>
        </div>
        <a
            href="{{ route('admin.laporan.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-stone-200 bg-white px-5 py-3 text-sm font-bold text-stone-700 shadow-2xs transition hover:bg-stone-50"
        >
            <i data-lucide="arrow-left" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
            Kembali
        </a>
    </div>
    <x-toast />
    <div class="grid items-start gap-6 lg:grid-cols-[1fr_320px]">
        {{-- Informasi lengkap pengaduan --}}
        <article class="overflow-hidden rounded-3xl border border-stone-200/80 bg-white shadow-xs">
            <div class="border-b border-stone-100 bg-stone-50/40 p-6 sm:p-8">
                <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                    <span class="rounded-lg bg-stone-100 px-2.5 py-1 text-xs font-bold tracking-wider text-stone-500">PENGADUAN # {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</span>
                    <span @class([
                    'inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-3.5 py-1.5 text-xs font-bold',
                    'bg-amber-50 text-amber-800 ring-1 ring-inset ring-amber-200' => $laporan->status === 'pending',
                    'bg-sky-50 text-sky-800 ring-1 ring-inset ring-sky-200' => $laporan->status === 'proses',
                    'bg-emerald-50 text-emerald-800 ring-1 ring-inset ring-emerald-200' => $laporan->status === 'selesai',
                    ])>
                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                        {{ \App\Models\Laporan::STATUSES[$laporan->status] ?? $laporan->status }}
                    </span>
                </div>
                <h2 class="font-display text-2xl leading-snug font-extrabold break-words text-stone-900">{{ $laporan->judul }}</h2>
                <div class="mt-6 grid gap-4 text-xs text-stone-500 sm:grid-cols-2">
                    <div class="flex items-center gap-2.5 rounded-xl border border-stone-200/70 bg-white px-3.5 py-2.5">
                        <i data-lucide="calendar-days" aria-hidden="true" class="h-4 w-4 shrink-0 text-emerald-600"></i>
                        <span>
                            Kejadian:
                            <strong class="font-bold text-stone-700">{{ $laporan->tanggal->translatedFormat('d F Y') }}</strong>
                        </span>
                    </div>
                    <div class="flex items-center gap-2.5 rounded-xl border border-stone-200/70 bg-white px-3.5 py-2.5">
                        <i data-lucide="clock-3" aria-hidden="true" class="h-4 w-4 shrink-0 text-emerald-600"></i>
                        <span>Diajukan: <strong class="font-bold text-stone-700">{{ $laporan->created_at->translatedFormat('d M Y, H:i') }}</strong></span>
                    </div>
                </div>
            </div>
            <div class="p-6 sm:p-8">
                <h3 class="mb-4 font-display text-sm font-bold text-stone-900">Deskripsi Pengaduan</h3>
                <p class="text-sm leading-8 break-words whitespace-pre-line text-stone-600">{{ $laporan->detail }}</p>
                <h3 class="mt-8 mb-4 font-display text-sm font-bold text-stone-900">Foto Bukti</h3>
                @if($laporan->foto)
                    <a href="{{ Storage::disk('public')->url($laporan->foto) }}" target="_blank" rel="noopener" class="group block overflow-hidden rounded-2xl border border-stone-200 bg-stone-50">
                        <img src="{{ Storage::disk('public')->url($laporan->foto) }}" alt="Foto bukti: {{ $laporan->judul }}" class="max-h-[500px] w-full object-contain transition duration-300 group-hover:scale-[1.01]">
                    </a>
                    <p class="mt-2 text-xs text-stone-400">Klik foto untuk melihat ukuran penuh.</p>
                @else
                    <div class="flex items-center gap-3 rounded-2xl border border-dashed border-stone-200 bg-stone-50 p-5 text-sm text-stone-400">
                        <i data-lucide="image" aria-hidden="true" class="h-5 w-5 shrink-0"></i>
                        Tidak ada foto bukti dilampirkan.
                    </div>
                @endif
            </div>
        </article>
        <aside class="space-y-5">
            {{-- Tahapan penanganan --}}
            <section class="rounded-3xl border border-stone-200/80 bg-white p-6 shadow-xs">
                <h2 class="font-display font-bold text-stone-900">Progres Pengaduan</h2>
                <div class="mt-6 space-y-6">
                    @foreach(['pending' => ['clock-3', 'Menunggu Peninjauan'], 'proses' => ['loader-circle', 'Sedang Diproses'], 'selesai' => ['circle-check', 'Selesai Ditangani']] as $status => [$icon, $label])
                        @php $reached = array_search($laporan->status, ['pending','proses','selesai']) >= $loop->index; @endphp
                        <div class="flex items-center gap-3.5">
                            <span @class(['flex h-10 w-10 shrink-0 items-center justify-center rounded-xl transition', 'bg-gradient-to-br from-emerald-600 to-teal-700 text-white shadow-sm shadow-emerald-900/15' => $reached, 'bg-stone-100 text-stone-400' => !$reached])>
                                <i data-lucide="{{ $icon }}" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                            </span>
                            <p @class(['text-xs font-bold', 'text-stone-800' => $reached, 'text-stone-400' => !$reached])>
                                {{ $label }}
                                @if($laporan->status === $status)
                                    <span class="mt-1 block text-[11px] font-semibold text-emerald-700">Tahap saat ini</span>
                                @endif
                            </p>
                        </div>
                    @endforeach
                </div>
                <p class="mt-6 rounded-2xl bg-stone-50 p-4 text-xs font-medium leading-6 text-stone-600">{{ $laporan->statusDescription() }}</p>
            </section>
            <section class="rounded-3xl border border-stone-200/80 bg-white p-6 shadow-xs">
                <h2 class="font-display font-bold text-stone-900">Tindak Lanjut</h2>
                <p class="mt-2 text-xs leading-6 text-stone-500">Perbarui status sesuai penanganan yang telah dilakukan.</p>
                @if($laporan->status === 'pending')
                    <button
                        type="button"
                        wire:loading.attr="disabled"
                        wire:click="changeStatus('proses')"
                        wire:confirm="Mulai proses penanganan pengaduan ini? Warga tidak dapat mengedit setelahnya."
                        class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-700 px-5 py-3 text-sm font-bold text-white shadow-md shadow-emerald-900/15 transition hover:from-emerald-700 hover:to-teal-800"
                    >
                        Mulai Proses
                        <i data-lucide="arrow-right" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                    </button>
                @elseif($laporan->status === 'proses')
                    <button
                        type="button"
                        wire:loading.attr="disabled"
                        wire:click="changeStatus('selesai')"
                        wire:confirm="Pastikan pengaduan sudah selesai ditangani. Tandai selesai?"
                        class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-700 px-5 py-3 text-sm font-bold text-white shadow-md shadow-emerald-900/15 transition hover:from-emerald-700 hover:to-teal-800"
                    >
                        Tandai Selesai
                        <i data-lucide="check" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                    </button>
                @else
                    <p class="mt-4 rounded-xl bg-emerald-50 p-3.5 text-xs font-bold text-emerald-800 ring-1 ring-emerald-200/60">Pengaduan telah selesai ditangani.</p>
                    <button
                        type="button"
                        wire:loading.attr="disabled"
                        wire:click="delete"
                        wire:confirm="Hapus pengaduan yang sudah selesai ini secara permanen?"
                        class="mt-3 inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50/70 px-5 py-2.5 text-sm font-bold text-red-700 transition hover:bg-red-100"
                    >
                        <i data-lucide="trash-2" aria-hidden="true" class="h-4 w-4 shrink-0"></i>
                        Hapus Pengaduan
                    </button>
                @endif
                <span wire:loading wire:target="changeStatus" role="status" class="mt-3 block text-xs font-semibold text-emerald-700">Memperbarui status…</span>
                @error('status')
                    <p role="alert" class="mt-3 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </section>
            <section class="rounded-3xl border border-stone-200/80 bg-white p-6 shadow-xs">
                <h2 class="mb-5 font-display font-bold text-stone-900">Informasi Pelapor</h2>
                <dl class="space-y-4 text-sm">
                    @foreach(['Nama lengkap' => $laporan->pelapor->name, 'Email' => $laporan->pelapor->email, 'Nomor WhatsApp' => $laporan->pelapor->no_whatsapp, 'Alamat' => $laporan->pelapor->alamat] as $label => $value)
                        <div>
                            <dt class="mb-1 text-xs font-medium text-stone-400">{{ $label }}</dt>
                            <dd class="leading-6 font-semibold break-words text-stone-700">{{ $value ?: 'Belum diisi' }}</dd>
                        </div>
                    @endforeach
                </dl>
            </section>
        </aside>
    </div>
</div>
