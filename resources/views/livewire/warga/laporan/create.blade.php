<div>
    <div class="mb-5">
        <nav aria-label="Breadcrumb" class="mb-2 flex items-center gap-1.5 text-xs font-medium text-stone-500">
            <a href="{{ route('warga.dashboard') }}" class="transition-colors hover:text-emerald-700">Dashboard</a>
            <i data-lucide="chevron-right" aria-hidden="true" class="size-3.5 text-stone-400"></i>
            <a href="{{ route('warga.laporan.index') }}" class="transition-colors hover:text-emerald-700">Pengaduan Saya</a>
            <i data-lucide="chevron-right" aria-hidden="true" class="size-3.5 text-stone-400"></i>
            <span class="font-semibold text-stone-800">Buat Pengaduan</span>
        </nav>
        <div class="flex flex-col gap-3.5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="font-display text-xl font-extrabold tracking-tight text-stone-900 sm:text-2xl">Buat Pengaduan</h1>
                <p class="mt-1 text-xs leading-relaxed text-stone-500 sm:text-sm">Sampaikan permasalahan dengan detail jelas dan bukti foto bila tersedia.</p>
            </div>
            <a
                href="{{ route('warga.laporan.index') }}"
                class="inline-flex min-h-10 shrink-0 items-center justify-center gap-2 rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-bold text-stone-700 shadow-2xs transition-colors hover:bg-stone-50 sm:text-sm"
            >
                <i data-lucide="arrow-left" aria-hidden="true" class="size-4 shrink-0"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid items-start gap-5 lg:grid-cols-[1fr_300px]">
        <form wire:submit="save" class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-xs sm:p-6">
            <div class="mb-5 flex items-center justify-between gap-3 border-b border-stone-100 pb-4">
                <div>
                    <h2 class="font-display text-base font-bold text-stone-900">Formulir Pengaduan</h2>
                    <p class="mt-0.5 text-xs text-stone-500">Kolom bertanda <span class="font-bold text-emerald-600">*</span> wajib diisi.</p>
                </div>
                <span class="rounded-full bg-amber-50 px-2.5 py-1 text-[11px] font-bold text-amber-800 ring-1 ring-inset ring-amber-200/80">Status Awal: Menunggu</span>
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
                    <p id="judul-help" class="mt-1.5 text-xs leading-relaxed text-stone-500">Gunakan judul singkat dan padat yang menggambarkan inti masalah.</p>
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
                        placeholder="Ceritakan masalah secara jelas, termasuk patokan lokasi, sejak kapan terjadi, dan dampaknya bagi warga…"
                        maxlength="10000"
                        required
                        class="min-h-28 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 px-3.5 py-2.5 text-base text-stone-900 placeholder:text-stone-400 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 sm:text-sm"
                    ></textarea>
                    <p id="detail-help" class="mt-1.5 text-xs leading-relaxed text-stone-500">Jelaskan lokasi kejadian secara spesifik dalam deskripsi. Maksimal 10.000 karakter.</p>
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
                    <div class="flex items-start gap-3">
                        <span class="hidden size-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/70 sm:flex">
                            <i data-lucide="image-plus" aria-hidden="true" class="size-4 shrink-0"></i>
                        </span>
                        <div class="min-w-0 flex-1">
                            <label for="foto" class="mb-1.5 block text-xs font-semibold text-stone-700 sm:text-sm">Foto bukti (opsional)</label>
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
                            <p id="foto-help" class="mt-1.5 text-xs leading-relaxed text-stone-500">Format JPG, PNG, atau WebP dengan ukuran maksimal 2 MB.</p>
                            @error('foto')
                                <p id="foto-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <p wire:loading wire:target="foto" role="status" class="mt-3 inline-flex items-center gap-2 text-xs font-semibold text-emerald-700">
                        <i data-lucide="loader-circle" aria-hidden="true" class="size-3.5 animate-spin motion-reduce:animate-none"></i>
                        Mengunggah foto bukti…
                    </p>

                    @if($foto && method_exists($foto, 'isPreviewable') && $foto->isPreviewable())
                        <div class="mt-3.5 overflow-hidden rounded-xl border border-stone-200 bg-white p-2.5">
                            <p class="mb-1.5 text-xs font-semibold text-emerald-700">Pratinjau foto yang akan dikirim:</p>
                            <img src="{{ $foto->temporaryUrl() }}" alt="Pratinjau foto bukti" class="max-h-44 w-full rounded-lg object-contain">
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-6 flex flex-wrap justify-end gap-2.5 border-t border-stone-100 pt-5">
                <a
                    href="{{ route('warga.laporan.index') }}"
                    class="inline-flex min-h-10 items-center justify-center gap-2 rounded-xl border border-stone-200 bg-white px-4 py-2 text-sm font-bold text-stone-700 transition-colors hover:bg-stone-50"
                >Batal</a>
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="save,foto"
                    class="inline-flex min-h-10 items-center justify-center gap-2 rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-5 py-2 text-sm font-bold text-white shadow-sm shadow-emerald-950/15 transition-all duration-200 hover:-translate-y-0.5 hover:from-emerald-700 hover:to-teal-800 active:scale-[0.98] motion-reduce:transform-none"
                >
                    <span wire:loading.remove wire:target="save">Kirim Pengaduan</span>
                    <span wire:loading wire:target="save">Mengirim…</span>
                    <i data-lucide="send" aria-hidden="true" class="size-4 shrink-0"></i>
                </button>
            </div>
        </form>

        <aside class="space-y-4 lg:sticky lg:top-20">
            <div class="rounded-2xl border border-emerald-200/75 bg-linear-to-b from-emerald-50/85 to-teal-50/40 p-5 shadow-2xs">
                <span class="mb-3 inline-flex size-10 items-center justify-center rounded-xl bg-linear-to-br from-emerald-600 to-teal-700 text-white shadow-sm shadow-emerald-950/15">
                    <i data-lucide="lightbulb" aria-hidden="true" class="size-5 shrink-0"></i>
                </span>
                <h2 class="font-display text-base font-bold text-stone-900">Panduan Laporan Efektif</h2>
                <ul class="mt-3 space-y-2.5 text-xs leading-5 text-stone-600 sm:text-sm">
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" aria-hidden="true" class="mt-0.5 size-4 shrink-0 text-emerald-600"></i>
                        <span>Sebutkan titik lokasi dan patokan jalan secara jelas.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" aria-hidden="true" class="mt-0.5 size-4 shrink-0 text-emerald-600"></i>
                        <span>Sertakan foto kondisi terkini bila memungkinkan.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" aria-hidden="true" class="mt-0.5 size-4 shrink-0 text-emerald-600"></i>
                        <span>Gunakan bahasa yang santun serta fakta yang akurat.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" aria-hidden="true" class="mt-0.5 size-4 shrink-0 text-emerald-600"></i>
                        <span>Hindari mencantumkan data sensitif milik orang lain.</span>
                    </li>
                </ul>
            </div>

            <div class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-xs">
                <h2 class="font-display text-sm font-bold text-stone-900">Setelah Laporan Dikirim</h2>
                <div class="mt-3.5 space-y-3 text-xs text-stone-600">
                    <div class="flex items-start gap-2.5">
                        <span class="flex size-5 shrink-0 items-center justify-center rounded-full bg-amber-50 text-[11px] font-bold text-amber-800 ring-1 ring-amber-200/80">1</span>
                        <p class="leading-5">Masuk dengan status <strong class="text-stone-800">Menunggu</strong> dan Anda masih dapat mengedit atau menghapusnya.</p>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <span class="flex size-5 shrink-0 items-center justify-center rounded-full bg-sky-50 text-[11px] font-bold text-sky-800 ring-1 ring-sky-200/80">2</span>
                        <p class="leading-5">Admin meninjau lalu mengubah status ke <strong class="text-stone-800">Sedang Diproses</strong> saat ditangani.</p>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <span class="flex size-5 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-[11px] font-bold text-emerald-800 ring-1 ring-emerald-200/80">3</span>
                        <p class="leading-5">Setelah tuntas, status diperbarui menjadi <strong class="text-stone-800">Selesai</strong>.</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
