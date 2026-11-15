<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#06231B">
        <title>Akses Dibatasi · Suara Warga, Langkah Perubahan</title>
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <style type="text/tailwindcss">
            @theme {
                --font-sans: 'DM Sans', system-ui, sans-serif;
                --font-display: 'Plus Jakarta Sans', system-ui, sans-serif;
                --color-canvas: #FAF8F5;
            }

            @layer base {
                button, a, input, textarea, select {
                    @apply focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-emerald-600;
                }

                button:not(:disabled), select {
                    @apply cursor-pointer;
                }

                button:disabled {
                    @apply cursor-wait opacity-60;
                }
            }
        </style>
        <style>[x-cloak] { display: none !important; }</style>
        @livewireStyles
    </head>
    <body class="flex min-h-dvh items-center justify-center bg-canvas px-6 font-sans text-stone-900">
        <main class="w-full max-w-md rounded-3xl border border-stone-200/80 bg-white p-8 text-center shadow-xl shadow-stone-950/5 sm:p-10">
            <div class="mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 font-display text-xl font-extrabold tracking-tight text-stone-900">
                    <span class="flex size-10 items-center justify-center rounded-xl bg-linear-to-br from-emerald-600 to-teal-700 text-white shadow-md shadow-emerald-950/15">
                        <i data-lucide="messages-square" aria-hidden="true" class="size-5 shrink-0"></i>
                    </span>
                    <span>
                        E-Report<span class="text-emerald-600">.</span>
                    </span>
                </a>
            </div>
            <p class="bg-linear-to-r from-emerald-600 to-teal-700 bg-clip-text font-display text-7xl font-extrabold text-transparent tabular-nums">403</p>
            <h1 class="mt-4 font-display text-2xl font-bold text-stone-900">Akses halaman dibatasi</h1>
            <p class="mt-3 text-sm leading-7 text-stone-500">Anda tidak memiliki izin untuk mengakses atau mengubah informasi ini.</p>
            <a
                href="{{ auth()->check() ? route(auth()->user()->dashboardRoute()) : route('home') }}"
                class="mt-8 inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-6 py-3.5 text-sm font-bold text-white shadow-md shadow-emerald-950/15 transition-all hover:-translate-y-0.5 hover:from-emerald-700 hover:to-teal-800 motion-reduce:transform-none"
            >Kembali ke {{ auth()->check() ? 'Dashboard' : 'Beranda' }}</a>
        </main>
        <script src="https://unpkg.com/lucide@0.468.0/dist/umd/lucide.min.js"></script>
        <script>
            if (window.lucide) {
                window.lucide.createIcons();
            }
        </script>
    </body>
</html>
