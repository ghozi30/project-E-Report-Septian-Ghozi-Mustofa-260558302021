<div>
    <div class="mb-5">
        <nav aria-label="Breadcrumb" class="mb-2 flex items-center gap-1.5 text-xs font-medium text-stone-500">
            <a href="{{ route('warga.dashboard') }}" class="transition-colors hover:text-emerald-700">Dashboard</a>
            <i data-lucide="chevron-right" aria-hidden="true" class="size-3.5 text-stone-400"></i>
            <span class="font-semibold text-stone-800">Profil Saya</span>
        </nav>
        <div>
            <h1 class="font-display text-xl font-extrabold tracking-tight text-stone-900 sm:text-2xl">Profil Saya</h1>
            <p class="mt-1 text-xs leading-relaxed text-stone-500 sm:text-sm">Kelola data identitas warga dan keamanan kata sandi akun Anda.</p>
        </div>
    </div>

    <x-toast />

    <div class="grid items-start gap-5 lg:grid-cols-[270px_1fr]">
        <aside class="rounded-2xl border border-stone-200/80 bg-white p-5 text-center shadow-xs lg:sticky lg:top-20">
            @if(auth()->user()->foto)
                <img src="{{ Storage::disk('public')->url(auth()->user()->foto) }}" alt="Foto profil Anda" class="mx-auto size-20 rounded-full object-cover ring-4 ring-emerald-50">
            @else
                <div class="mx-auto flex size-20 items-center justify-center rounded-full bg-linear-to-br from-emerald-600 to-teal-700 font-display text-2xl font-extrabold text-white shadow-sm shadow-emerald-950/15">{{ mb_substr(auth()->user()->name, 0, 1) }}</div>
            @endif
            <h2 class="mt-4 font-display text-base font-bold wrap-anywhere text-stone-900">{{ auth()->user()->name }}</h2>
            <p class="mt-1 text-xs wrap-anywhere text-stone-500">{{ auth()->user()->email }}</p>
            <span class="mt-3 inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-0.5 text-[11px] font-bold text-emerald-700 ring-1 ring-emerald-200/70">
                <span class="size-1.5 rounded-full bg-emerald-600"></span>
                Akun Warga
            </span>

            <dl class="mt-5 space-y-3 border-t border-stone-100 pt-4 text-left text-xs">
                <div>
                    <dt class="font-medium text-stone-400">WhatsApp</dt>
                    <dd class="mt-0.5 font-semibold text-stone-700 tabular-nums">{{ auth()->user()->no_whatsapp ?: 'Belum diisi' }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-stone-400">Alamat</dt>
                    <dd class="mt-0.5 leading-5 font-medium wrap-anywhere text-stone-700">{{ auth()->user()->alamat ?: 'Belum diisi' }}</dd>
                </div>
            </dl>
        </aside>

        <div class="space-y-5">
            <form wire:submit="updateProfile" class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-xs sm:p-6">
                <div class="flex items-center gap-3 border-b border-stone-100 pb-4">
                    <span class="flex size-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/60">
                        <i data-lucide="user-round-cog" aria-hidden="true" class="size-4 shrink-0"></i>
                    </span>
                    <div>
                        <h2 class="font-display text-base font-bold text-stone-900">Informasi Pribadi</h2>
                        <p class="text-xs text-stone-500">Pastikan kontak WhatsApp &amp; alamat selalu akurat agar pengelola mudah menghubungi.</p>
                    </div>
                </div>

                <div class="mt-5 space-y-4">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="name" class="mb-1.5 block text-xs font-semibold text-stone-700 sm:text-sm">
                                Nama lengkap <span aria-hidden="true" class="text-emerald-600">*</span>
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                aria-describedby="name-error"
                                @error('name')
                                aria-invalid="true"
                                @enderror
                                wire:model="name"
                                autocomplete="name"
                                required
                                class="min-h-10 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 px-3.5 py-2 text-base text-stone-900 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 read-only:bg-stone-50 sm:text-sm"
                            >
                            @error('name')
                                <p id="name-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="no_whatsapp" class="mb-1.5 block text-xs font-semibold text-stone-700 sm:text-sm">
                                Nomor WhatsApp <span aria-hidden="true" class="text-emerald-600">*</span>
                            </label>
                            <input
                                type="tel"
                                id="no_whatsapp"
                                name="no_whatsapp"
                                aria-describedby="no_whatsapp-error"
                                @error('no_whatsapp')
                                aria-invalid="true"
                                @enderror
                                wire:model="no_whatsapp"
                                autocomplete="tel"
                                required
                                class="min-h-10 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 px-3.5 py-2 text-base text-stone-900 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 read-only:bg-stone-50 sm:text-sm"
                            >
                            @error('no_whatsapp')
                                <p id="no_whatsapp-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="email" class="mb-1.5 flex items-center gap-2 text-xs font-semibold text-stone-700 sm:text-sm">
                            <span>Email</span>
                            <span class="inline-flex items-center gap-1 rounded-full bg-stone-100 px-2 py-0.5 text-[10px] font-bold text-stone-500">
                                <i data-lucide="lock" aria-hidden="true" class="size-3 shrink-0"></i>
                                Terkunci
                            </span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            aria-describedby="email-help email-error"
                            @error('email')
                            aria-invalid="true"
                            @enderror
                            value="{{ auth()->user()->email }}"
                            readonly
                            class="min-h-10 w-full rounded-xl border border-stone-200 px-3.5 py-2 text-base outline-none read-only:cursor-not-allowed read-only:bg-stone-100 read-only:text-stone-500 sm:text-sm"
                        >
                        <p id="email-help" class="mt-1.5 text-xs leading-relaxed text-stone-500">Alamat email akun bersifat permanen dan tidak dapat diubah.</p>
                        @error('email')
                            <p id="email-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="alamat" class="mb-1.5 block text-xs font-semibold text-stone-700 sm:text-sm">
                            Alamat <span aria-hidden="true" class="text-emerald-600">*</span>
                        </label>
                        <textarea
                            id="alamat"
                            name="alamat"
                            aria-describedby="alamat-error"
                            @error('alamat')
                            aria-invalid="true"
                            @enderror
                            wire:model="alamat"
                            autocomplete="street-address"
                            rows="2"
                            required
                            class="min-h-20 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 px-3.5 py-2 text-base text-stone-900 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 sm:text-sm"
                        ></textarea>
                        @error('alamat')
                            <p id="alamat-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="rounded-xl border border-dashed border-stone-300 bg-stone-50/70 p-3.5">
                        <label for="foto" class="mb-1.5 block text-xs font-semibold text-stone-700 sm:text-sm">Foto profil</label>
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
                        <p id="foto-help" class="mt-1.5 text-xs leading-relaxed text-stone-500">JPG, PNG, atau WebP. Maksimal 2 MB.</p>
                        @error('foto')
                            <p id="foto-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror

                        <p wire:loading wire:target="foto" role="status" class="mt-2.5 inline-flex items-center gap-2 text-xs font-semibold text-emerald-700">
                            <i data-lucide="loader-circle" aria-hidden="true" class="size-3.5 animate-spin motion-reduce:animate-none"></i>
                            Mengunggah foto…
                        </p>

                        @if($foto && method_exists($foto, 'isPreviewable') && $foto->isPreviewable())
                            <div class="mt-3 flex items-center gap-3 rounded-xl border border-stone-200 bg-white p-2.5">
                                <img src="{{ $foto->temporaryUrl() }}" alt="Pratinjau foto profil" class="size-12 rounded-full object-cover ring-2 ring-emerald-100">
                                <p class="text-xs font-semibold text-emerald-700">Pratinjau foto baru siap disimpan.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-5 flex justify-end border-t border-stone-100 pt-4">
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="updateProfile,foto"
                        class="inline-flex min-h-10 items-center justify-center gap-2 rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-5 py-2 text-sm font-bold text-white shadow-sm shadow-emerald-950/15 transition-all duration-200 hover:-translate-y-0.5 hover:from-emerald-700 hover:to-teal-800 active:scale-[0.98] motion-reduce:transform-none"
                    >
                        <span wire:loading.remove wire:target="updateProfile">Simpan Profil</span>
                        <span wire:loading wire:target="updateProfile">Menyimpan…</span>
                    </button>
                </div>
            </form>

            <form wire:submit="updatePassword" class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-xs sm:p-6">
                <div class="flex items-center gap-3 border-b border-stone-100 pb-4">
                    <span class="flex size-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/60">
                        <i data-lucide="lock-keyhole" aria-hidden="true" class="size-4 shrink-0"></i>
                    </span>
                    <div>
                        <h2 class="font-display text-base font-bold text-stone-900">Ubah Password</h2>
                        <p class="text-xs text-stone-500">Gunakan password yang kuat dan berbeda dari sebelumnya.</p>
                    </div>
                </div>

                <div class="mt-5 space-y-4">
                    <div x-data="{ show: false }">
                        <label for="current_password" class="mb-1.5 block text-xs font-semibold text-stone-700 sm:text-sm">
                            Password saat ini <span aria-hidden="true" class="text-emerald-600">*</span>
                        </label>
                        <div class="relative">
                            <input
                                :type="show ? 'text' : 'password'"
                                type="password"
                                id="current_password"
                                name="current_password"
                                aria-describedby="current_password-error"
                                @error('current_password')
                                aria-invalid="true"
                                @enderror
                                wire:model="current_password"
                                autocomplete="current-password"
                                required
                                class="min-h-10 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 py-2 pr-11 pl-3.5 text-base text-stone-900 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 read-only:bg-stone-50 sm:text-sm"
                            >
                            <button
                                type="button"
                                @click="show = !show"
                                :aria-label="show ? 'Sembunyikan password saat ini' : 'Lihat password saat ini'"
                                :aria-pressed="show"
                                class="absolute inset-y-0 right-0 flex min-w-10 items-center justify-center px-3 text-stone-400 transition-colors hover:text-emerald-700"
                            >
                                <span x-show="!show" class="flex items-center">
                                    <i data-lucide="eye" aria-hidden="true" class="size-4 shrink-0"></i>
                                </span>
                                <span x-show="show" x-cloak class="flex items-center">
                                    <i data-lucide="eye-off" aria-hidden="true" class="size-4 shrink-0"></i>
                                </span>
                            </button>
                        </div>
                        @error('current_password')
                            <p id="current_password-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div x-data="{ show: false }">
                            <label for="password" class="mb-1.5 block text-xs font-semibold text-stone-700 sm:text-sm">
                                Password baru <span aria-hidden="true" class="text-emerald-600">*</span>
                            </label>
                            <div class="relative">
                                <input
                                    :type="show ? 'text' : 'password'"
                                    type="password"
                                    id="password"
                                    name="password"
                                    aria-describedby="password-help password-error"
                                    @error('password')
                                    aria-invalid="true"
                                    @enderror
                                    wire:model="password"
                                    autocomplete="new-password"
                                    required
                                    class="min-h-10 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 py-2 pr-11 pl-3.5 text-base text-stone-900 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 read-only:bg-stone-50 sm:text-sm"
                                >
                                <button
                                    type="button"
                                    @click="show = !show"
                                    :aria-label="show ? 'Sembunyikan password baru' : 'Lihat password baru'"
                                    :aria-pressed="show"
                                    class="absolute inset-y-0 right-0 flex min-w-10 items-center justify-center px-3 text-stone-400 transition-colors hover:text-emerald-700"
                                >
                                    <span x-show="!show" class="flex items-center">
                                        <i data-lucide="eye" aria-hidden="true" class="size-4 shrink-0"></i>
                                    </span>
                                    <span x-show="show" x-cloak class="flex items-center">
                                        <i data-lucide="eye-off" aria-hidden="true" class="size-4 shrink-0"></i>
                                    </span>
                                </button>
                            </div>
                            <p id="password-help" class="mt-1.5 text-[11px] leading-relaxed text-stone-500">Min. 8 karakter, huruf &amp; angka.</p>
                            @error('password')
                                <p id="password-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-data="{ show: false }">
                            <label for="password_confirmation" class="mb-1.5 block text-xs font-semibold text-stone-700 sm:text-sm">
                                Konfirmasi password baru <span aria-hidden="true" class="text-emerald-600">*</span>
                            </label>
                            <div class="relative">
                                <input
                                    :type="show ? 'text' : 'password'"
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    aria-describedby="password_confirmation-error"
                                    @error('password_confirmation')
                                    aria-invalid="true"
                                    @enderror
                                    wire:model="password_confirmation"
                                    autocomplete="new-password"
                                    required
                                    class="min-h-10 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 py-2 pr-11 pl-3.5 text-base text-stone-900 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 read-only:bg-stone-50 sm:text-sm"
                                >
                                <button
                                    type="button"
                                    @click="show = !show"
                                    :aria-label="show ? 'Sembunyikan konfirmasi password baru' : 'Lihat konfirmasi password baru'"
                                    :aria-pressed="show"
                                    class="absolute inset-y-0 right-0 flex min-w-10 items-center justify-center px-3 text-stone-400 transition-colors hover:text-emerald-700"
                                >
                                    <span x-show="!show" class="flex items-center">
                                        <i data-lucide="eye" aria-hidden="true" class="size-4 shrink-0"></i>
                                    </span>
                                    <span x-show="show" x-cloak class="flex items-center">
                                        <i data-lucide="eye-off" aria-hidden="true" class="size-4 shrink-0"></i>
                                    </span>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <p id="password_confirmation-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-5 flex justify-end border-t border-stone-100 pt-4">
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="inline-flex min-h-10 items-center justify-center gap-2 rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-5 py-2 text-sm font-bold text-white shadow-sm shadow-emerald-950/15 transition-all duration-200 hover:-translate-y-0.5 hover:from-emerald-700 hover:to-teal-800 active:scale-[0.98] motion-reduce:transform-none"
                    >
                        <span wire:loading.remove wire:target="updatePassword">Ubah Password</span>
                        <span wire:loading wire:target="updatePassword">Menyimpan…</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
