<div>
    <div class="flex items-start justify-between gap-2">
        <div class="min-w-0">
            <h1 class="font-display text-xl font-extrabold tracking-tight text-stone-900 sm:text-2xl">Buat Akun Warga</h1>
            <p class="mt-1 text-sm text-stone-500">Satu akun untuk mengirim dan memantau pengaduan.</p>
        </div>
        <span class="hidden shrink-0 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold tracking-wider text-emerald-700 ring-1 ring-emerald-200/70 sm:inline-flex">
            DAFTAR BARU
        </span>
    </div>

    <form wire:submit="register" class="mt-4 space-y-3">
        <div>
            <label for="name" class="mb-1 block text-xs font-semibold text-stone-700 sm:text-sm">
                Nama lengkap <span aria-hidden="true" class="text-emerald-600">*</span>
            </label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-stone-400">
                    <i data-lucide="user" aria-hidden="true" class="size-4 shrink-0"></i>
                </span>
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
                    placeholder="Nama sesuai identitas"
                    required
                    class="min-h-10 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 py-2 pr-3.5 pl-10 text-base text-stone-900 placeholder:text-stone-400 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 read-only:bg-stone-50 sm:text-sm"
                >
            </div>
            @error('name')
                <p id="name-error" role="alert" class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-3 sm:grid-cols-2">
            <div>
                <label for="email" class="mb-1 block text-xs font-semibold text-stone-700 sm:text-sm">
                    Email <span aria-hidden="true" class="text-emerald-600">*</span>
                </label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-stone-400">
                        <i data-lucide="mail" aria-hidden="true" class="size-4 shrink-0"></i>
                    </span>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        aria-describedby="email-error"
                        @error('email')
                        aria-invalid="true"
                        @enderror
                        wire:model="email"
                        autocomplete="email"
                        placeholder="nama@email.com"
                        required
                        class="min-h-10 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 py-2 pr-3.5 pl-10 text-base text-stone-900 placeholder:text-stone-400 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 read-only:bg-stone-50 sm:text-sm"
                    >
                </div>
                @error('email')
                    <p id="email-error" role="alert" class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="no_whatsapp" class="mb-1 block text-xs font-semibold text-stone-700 sm:text-sm">
                    Nomor WhatsApp <span aria-hidden="true" class="text-emerald-600">*</span>
                </label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-stone-400">
                        <i data-lucide="phone" aria-hidden="true" class="size-4 shrink-0"></i>
                    </span>
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
                        placeholder="08xxxxxxxxxx"
                        required
                        class="min-h-10 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 py-2 pr-3.5 pl-10 text-base text-stone-900 placeholder:text-stone-400 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 read-only:bg-stone-50 sm:text-sm"
                    >
                </div>
                @error('no_whatsapp')
                    <p id="no_whatsapp-error" role="alert" class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="alamat" class="mb-1 block text-xs font-semibold text-stone-700 sm:text-sm">
                Alamat domisili <span aria-hidden="true" class="text-emerald-600">*</span>
            </label>
            <div class="relative">
                <span class="pointer-events-none absolute top-3 left-0 flex items-center pl-3.5 text-stone-400">
                    <i data-lucide="map-pin" aria-hidden="true" class="size-4 shrink-0"></i>
                </span>
                <textarea
                    id="alamat"
                    name="alamat"
                    aria-describedby="alamat-error"
                    @error('alamat')
                    aria-invalid="true"
                    @enderror
                    wire:model="alamat"
                    autocomplete="street-address"
                    placeholder="Jalan, RT/RW, kelurahan, kecamatan"
                    rows="1"
                    required
                    class="min-h-10 w-full resize-none rounded-xl border border-stone-200/90 bg-stone-50/70 py-2 pr-3.5 pl-10 text-base text-stone-900 placeholder:text-stone-400 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 sm:text-sm"
                ></textarea>
            </div>
            @error('alamat')
                <p id="alamat-error" role="alert" class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-3 border-t border-stone-100 pt-2.5 sm:grid-cols-2">
            <div x-data="{ show: false }">
                <label for="password" class="mb-1 block text-xs font-semibold text-stone-700 sm:text-sm">
                    Password <span aria-hidden="true" class="text-emerald-600">*</span>
                </label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-stone-400">
                        <i data-lucide="lock" aria-hidden="true" class="size-4 shrink-0"></i>
                    </span>
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
                        placeholder="Min. 8 karakter"
                        required
                        class="min-h-10 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 py-2 pr-10 pl-10 text-base text-stone-900 placeholder:text-stone-400 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 read-only:bg-stone-50 sm:text-sm"
                    >
                    <button
                        type="button"
                        @click="show = !show"
                        :aria-label="show ? 'Sembunyikan password' : 'Lihat password'"
                        :aria-pressed="show"
                        class="absolute inset-y-0 right-0 flex min-w-10 items-center justify-center px-2.5 text-stone-400 transition-colors hover:text-emerald-700"
                    >
                        <span x-show="!show" class="flex items-center">
                            <i data-lucide="eye" aria-hidden="true" class="size-4 shrink-0"></i>
                        </span>
                        <span x-show="show" x-cloak class="flex items-center">
                            <i data-lucide="eye-off" aria-hidden="true" class="size-4 shrink-0"></i>
                        </span>
                    </button>
                </div>
                <p id="password-help" class="mt-1 text-[11px] leading-tight text-stone-500">Min. 8 karakter, huruf &amp; angka.</p>
                @error('password')
                    <p id="password-error" role="alert" class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div x-data="{ show: false }">
                <label for="password_confirmation" class="mb-1 block text-xs font-semibold text-stone-700 sm:text-sm">
                    Konfirmasi <span aria-hidden="true" class="text-emerald-600">*</span>
                </label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-stone-400">
                        <i data-lucide="shield" aria-hidden="true" class="size-4 shrink-0"></i>
                    </span>
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
                        placeholder="Ulangi password"
                        required
                        class="min-h-10 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 py-2 pr-10 pl-10 text-base text-stone-900 placeholder:text-stone-400 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 read-only:bg-stone-50 sm:text-sm"
                    >
                    <button
                        type="button"
                        @click="show = !show"
                        :aria-label="show ? 'Sembunyikan konfirmasi password' : 'Lihat konfirmasi password'"
                        :aria-pressed="show"
                        class="absolute inset-y-0 right-0 flex min-w-10 items-center justify-center px-2.5 text-stone-400 transition-colors hover:text-emerald-700"
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
                    <p id="password_confirmation-error" role="alert" class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button
            type="submit"
            wire:loading.attr="disabled"
            class="mt-1 inline-flex min-h-11 w-full items-center justify-center gap-2 rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-5 py-2.5 text-base font-bold text-white shadow-md shadow-emerald-950/15 transition-all duration-200 hover:-translate-y-0.5 hover:from-emerald-700 hover:to-teal-800 active:scale-[0.98] motion-reduce:transform-none"
        >
            <span wire:loading.remove wire:target="register" class="inline-flex items-center gap-2">
                Daftar &amp; Mulai Melapor
                <i data-lucide="arrow-right" aria-hidden="true" class="size-4 shrink-0"></i>
            </span>
            <span wire:loading wire:target="register">Membuat akun…</span>
        </button>
    </form>

    <p class="mt-4 border-t border-stone-100 pt-3.5 text-center text-sm text-stone-500">
        Sudah punya akun?
        <a href="{{ route('login') }}" wire:navigate class="font-bold text-emerald-700 hover:text-emerald-800 hover:underline">Masuk di sini</a>
    </p>
</div>
