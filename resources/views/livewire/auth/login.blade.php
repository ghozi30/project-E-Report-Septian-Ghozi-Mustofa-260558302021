<div>
    <div class="flex items-start justify-between gap-2">
        <div class="min-w-0">
            <h1 class="font-display text-xl font-extrabold tracking-tight text-stone-900 sm:text-2xl">Masuk ke Akun Warga</h1>
            <p class="mt-1 text-sm text-stone-500">Pantau dan kirim laporan lingkungan Anda.</p>
        </div>
        <span class="hidden shrink-0 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold tracking-wider text-emerald-700 ring-1 ring-emerald-200/70 sm:inline-flex">
            PORTAL WARGA
        </span>
    </div>

    <form wire:submit="login" method="POST" action="#" class="mt-5 space-y-4">
        <div>
            <label for="email" class="mb-1.5 block text-sm font-semibold text-stone-700">
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
                    placeholder="nama@email.com"
                    autocomplete="email"
                    required
                    class="min-h-11 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 py-2.5 pr-4 pl-10 text-base text-stone-900 placeholder:text-stone-400 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 read-only:bg-stone-50 sm:text-[15px]"
                >
            </div>
            @error('email')
                <p id="email-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div x-data="{ show: false }">
            <label for="password" class="mb-1.5 block text-sm font-semibold text-stone-700">
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
                    aria-describedby="password-error"
                    @error('password')
                    aria-invalid="true"
                    @enderror
                    wire:model="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                    class="min-h-11 w-full rounded-xl border border-stone-200/90 bg-stone-50/70 py-2.5 pr-11 pl-10 text-base text-stone-900 placeholder:text-stone-400 transition-colors outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 read-only:bg-stone-50 sm:text-[15px]"
                >
                <button
                    type="button"
                    @click="show = !show"
                    :aria-label="show ? 'Sembunyikan password' : 'Lihat password'"
                    :aria-pressed="show"
                    class="absolute inset-y-0 right-0 flex min-w-11 items-center justify-center px-3 text-stone-400 transition-colors hover:text-emerald-700"
                >
                    <span x-show="!show" class="flex items-center">
                        <i data-lucide="eye" aria-hidden="true" class="size-4 shrink-0"></i>
                    </span>
                    <span x-show="show" x-cloak class="flex items-center">
                        <i data-lucide="eye-off" aria-hidden="true" class="size-4 shrink-0"></i>
                    </span>
                </button>
            </div>
            @error('password')
                <p id="password-error" role="alert" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <label class="flex min-h-8 items-center gap-2.5 text-sm font-medium text-stone-600">
            <input type="checkbox" wire:model="remember" class="size-4 rounded accent-emerald-600">
            Ingat saya di perangkat ini
        </label>

        <button
            type="submit"
            wire:loading.attr="disabled"
            class="inline-flex min-h-11 w-full items-center justify-center gap-2 rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-5 py-2.5 text-base font-bold text-white shadow-md shadow-emerald-950/15 transition-all duration-200 hover:-translate-y-0.5 hover:from-emerald-700 hover:to-teal-800 active:scale-[0.98] motion-reduce:transform-none"
        >
            <span wire:loading.remove wire:target="login" class="inline-flex items-center gap-2">
                Masuk ke Akun
                <i data-lucide="arrow-right" aria-hidden="true" class="size-4 shrink-0"></i>
            </span>
            <span wire:loading wire:target="login">Memeriksa akun…</span>
        </button>
    </form>

    <p class="mt-5 border-t border-stone-100 pt-4 text-center text-sm text-stone-500">
        Belum punya akun warga?
        <a href="{{ route('register') }}" wire:navigate class="font-bold text-emerald-700 hover:text-emerald-800 hover:underline">Daftar sekarang</a>
    </p>
</div>
