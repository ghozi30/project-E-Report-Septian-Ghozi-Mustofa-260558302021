<div>
    <div class="mb-5">
        <nav aria-label="Breadcrumb" class="mb-2 flex flex-wrap items-center gap-1.5 text-xs font-medium text-stone-500">
            <a href="{{ route('warga.dashboard') }}" class="transition-colors hover:text-emerald-700">Dashboard</a>
            <i data-lucide="chevron-right" aria-hidden="true" class="size-3.5 text-stone-400"></i>
            <a href="{{ route('warga.laporan.index') }}" class="transition-colors hover:text-emerald-700">Pengaduan Saya</a>
            <i data-lucide="chevron-right" aria-hidden="true" class="size-3.5 text-stone-400"></i>
            <a href="{{ route('warga.laporan.show', $laporan) }}" class="transition-colors hover:text-emerald-700 tabular-nums"># {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</a>
            <i data-lucide="chevron-right" aria-hidden="true" class="size-3.5 text-stone-400"></i>
            <span class="font-semibold text-stone-800">Edit</span>
        </nav>

        <div class="flex flex-col gap-3.5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="font-display text-xl font-extrabold tracking-tight text-stone-900 sm:text-2xl">Edit Pengaduan</h1>
                <p class="mt-1 text-xs leading-relaxed text-stone-500 sm:text-sm">Perubahan hanya dapat disimpan selama pengaduan berstatus Menunggu peninjauan.</p>
            </div>
            <a
                href="{{ route('warga.laporan.show', $laporan) }}"
                class="inline-flex min-h-10 shrink-0 items-center justify-center gap-2 rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-bold text-stone-700 shadow-2xs transition-colors hover:bg-stone-50 sm:text-sm"
            >
                <i data-lucide="arrow-left" aria-hidden="true" class="size-4 shrink-0"></i>
                Kembali ke Detail
            </a>
        </div>
    </div>

    <div class="grid items-start gap-5 lg:grid-cols-[1fr_300px]">
        <form wire:submit="save" class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-xs sm:p-6">
            <div class="mb-5 flex items-center justify-between gap-3 border-b border-stone-100 pb-4">
                <div>
                    <h2 class="font-display text-base font-bold text-stone-900">Perbarui Informasi</h2>
                    <p class="mt-0.5 text-xs text-stone-500 tabular-nums">Tiket Pengaduan # {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
                <span class="rounded-full bg-amber-50 px-2.5 py-1 text-[11px] font-bold text-amber-800 ring-1 ring-inset ring-amber-200/80">Menunggu</span>
            </div>

            <div class="space-y-5">
                <div>
                    <label for="judul" class="mb-1.5 block text-xs font-semibold text-stone-700 sm:text-sm">
                        Judul pengaduan <span aria-hidden="true" class="text-emerald-600">*</span>
                    </label>
                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        aria-describedby="judul-help judul-error"
                        @error('judul')
                        aria-invalid="true"
                        @enderror
                        wire:model="judul"
                        placeholder="Contoh: Lampu jalan mati di Jalan Melati"
                        maxlength="255"
                        required
                        class="min-h-10 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 px-3.5 py-2.5 text-base text-stone-900 placeholder:text-stone-400 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 read-only:bg-stone-50 sm:text-sm"
                    >
                    <p id="judul-help" class="mt-1.5 text-xs leading-relaxed text-stone-500">Gunakan judul singkat yang menggambarkan masalah.</p>
                    @error('judul')
                        <p id="judul-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="detail" class="mb-1.5 block text-xs font-semibold text-stone-700 sm:text-sm">
                        Deskripsi pengaduan <span aria-hidden="true" class="text-emerald-600">*</span>
                    </label>
                    <textarea
                        id="detail"
                        name="detail"
                        aria-describedby="detail-help detail-error"
                        @error('detail')
                        aria-invalid="true"
                        @enderror
                        wire:model="detail"
                        rows="5"
                        placeholder="Ceritakan masalah secara jelas, termasuk lokasi dan dampaknya bagi warga…"
                        maxlength="10000"
                        required
                        class="min-h-28 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 px-3.5 py-2.5 text-base text-stone-900 placeholder:text-stone-400 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 sm:text-sm"
                    ></textarea>
                    <p id="detail-help" class="mt-1.5 text-xs leading-relaxed text-stone-500">Jelaskan lokasi kejadian dalam deskripsi. Maksimal 10.000 karakter.</p>
                    @error('detail')
                        <p id="detail-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal" class="mb-1.5 block text-xs font-semibold text-stone-700 sm:text-sm">
                        Tanggal kejadian <span aria-hidden="true" class="text-emerald-600">*</span>
                    </label>
                    <input
                        type="date"
                        id="tanggal"
                        name="tanggal"
                        aria-describedby="tanggal-error"
                        @error('tanggal')
                        aria-invalid="true"
                        @enderror
                        wire:model="tanggal"
                        max="{{ today()->format('Y-m-d') }}"
                        required
                        class="min-h-10 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 px-3.5 py-2.5 text-base text-stone-900 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 read-only:bg-stone-50 sm:max-w-xs sm:text-sm"
                    >
                    @error('tanggal')
                        <p id="tanggal-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-2xl border border-dashed border-stone-300 bg-stone-50/70 p-4">
                    <div>
                        <label for="foto" class="mb-1.5 block text-xs font-semibold text-stone-700 sm:text-sm">Ganti foto bukti (opsional)</label>
                        <input
                            type="file"
                            id="foto"
                            name="foto"
                            aria-describedby="foto-help foto-error"
                            @error('foto')
                            aria-invalid="true"
                            @enderror
                            wire:model="foto"
                            accept="image/jpeg,image/png,image/webp"
                            class="min-h-10 w-full rounded-xl border border-stone-200 bg-white px-3 py-1.5 text-xs text-stone-800 outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 file:mr-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-3 file:py-1.5 file:font-semibold file:text-emerald-700 hover:file:bg-emerald-100 sm:text-sm"
                        >
                        <p id="foto-help" class="mt-1.5 text-xs leading-relaxed text-stone-500">JPG, PNG, atau WebP. Maksimal 2 MB. Kosongkan jika tetap memakai foto lama.</p>
                        @error('foto')
                            <p id="foto-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <p wire:loading wire:target="foto" role="status" class="mt-3 inline-flex items-center gap-2 text-xs font-semibold text-emerald-700">
                        <i data-lucide="loader-circle" aria-hidden="true" class="size-3.5 animate-spin motion-reduce:animate-none"></i>
                        Mengunggah foto…
                    </p>

                    @if($foto && method_exists($foto, 'isPreviewable') && $foto->isPreviewable())
                        <div class="mt-3.5 overflow-hidden rounded-xl border border-stone-200 bg-white p-2.5">
                            <p class="mb-1.5 text-xs font-semibold text-emerald-700">Pratinjau foto baru:</p>
                            <img src="{{ $foto->temporaryUrl() }}" alt="Pratinjau foto baru" class="max-h-44 w-full rounded-lg object-contain">
                        </div>
                    @elseif($laporan->foto)
                        <div class="mt-3.5 overflow-hidden rounded-xl border border-stone-200 bg-white p-2.5">
                            <p class="mb-1.5 text-xs font-medium text-stone-500">Foto bukti saat ini:</p>
                            <img src="{{ Storage::disk('public')->url($laporan->foto) }}" alt="Foto bukti saat ini" class="max-h-40 w-full rounded-lg object-contain">
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-6 flex flex-wrap justify-end gap-2.5 border-t border-stone-100 pt-5">
                <a
                    href="{{ route('warga.laporan.show', $laporan) }}"
                    class="inline-flex min-h-10 items-center justify-center gap-2 rounded-xl border border-stone-200 bg-white px-4 py-2 text-sm font-bold text-stone-700 transition-colors hover:bg-stone-50"
                >Batal</a>
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="save,foto"
                    class="inline-flex min-h-10 items-center justify-center gap-2 rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-5 py-2 text-sm font-bold text-white shadow-sm shadow-emerald-950/15 transition-all duration-200 hover:-translate-y-0.5 hover:from-emerald-700 hover:to-teal-800 active:scale-[0.98] motion-reduce:transform-none"
                >
                    <span wire:loading.remove wire:target="save">Simpan Perubahan</span>
                    <span wire:loading wire:target="save">Menyimpan…</span>
                </button>
            </div>
        </form>

        <aside class="space-y-4 lg:sticky lg:top-20">
            <div class="rounded-2xl border border-amber-200/80 bg-amber-50/70 p-5 shadow-2xs">
                <span class="mb-3 inline-flex size-10 items-center justify-center rounded-xl bg-amber-100 text-amber-800 ring-1 ring-amber-200">
                    <i data-lucide="file-pen-line" aria-hidden="true" class="size-5 shrink-0"></i>
                </span>
                <h2 class="font-display text-sm font-bold text-stone-900 sm:text-base">Ketentuan Pengubahan</h2>
                <p class="mt-1.5 text-xs leading-5 text-stone-600">
                    Jika admin mulai menindaklanjuti laporan dan mengubah status menjadi <strong class="text-stone-800">Sedang Diproses</strong>, perubahan data tidak dapat disimpan lagi demi menjaga integritas catatan penanganan.
                </p>
            </div>
        </aside>
    </div>
</div>
