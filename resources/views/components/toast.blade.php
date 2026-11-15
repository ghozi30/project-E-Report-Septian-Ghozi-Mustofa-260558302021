@if(session('success'))
    <div
        wire:key="toast-{{ uniqid() }}"
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 5000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-250"
        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
        role="status"
        class="fixed top-20 right-4 left-4 z-50 mx-auto flex max-w-md items-center justify-between gap-3 rounded-2xl border border-emerald-200/90 bg-emerald-50/95 p-3.5 text-sm font-medium text-emerald-900 shadow-lg shadow-emerald-950/10 backdrop-blur-md sm:left-auto sm:right-6 sm:w-full"
    >
        <div class="flex items-start gap-2.5">
            <i data-lucide="circle-check" aria-hidden="true" class="size-5 shrink-0 text-emerald-600"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button
            type="button"
            @click="show = false"
            aria-label="Tutup notifikasi"
            class="flex size-8 shrink-0 items-center justify-center rounded-lg text-emerald-700 transition-colors hover:bg-emerald-100"
        >
            <i data-lucide="x" aria-hidden="true" class="size-4 shrink-0"></i>
        </button>
    </div>
@endif
