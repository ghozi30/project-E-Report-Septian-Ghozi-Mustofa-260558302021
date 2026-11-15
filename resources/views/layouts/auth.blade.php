<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#06231B">
        <title>{{ $title ?? 'Selamat Datang' }} · Suara Warga, Langkah Perubahan</title>
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..700;1,9..40,400..700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <style type="text/tailwindcss">
            @theme {
                --font-sans: 'DM Sans', system-ui, sans-serif;
                --font-display: 'Plus Jakarta Sans', system-ui, sans-serif;
                --color-canvas: #FAF8F5;
                --color-forest: #06231B;
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
        <style>
            [x-cloak] { display: none !important; }
            @media (min-width: 768px) and (max-width: 1279px) {
                html {
                    font-size: 20px;
                }
            }
        </style>
        @livewireStyles
    </head>
    <body class="relative min-h-dvh bg-canvas font-sans text-stone-900 antialiased selection:bg-emerald-700 selection:text-white">
        {{-- Ambient Background --}}
        <div class="pointer-events-none fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute -top-28 left-1/2 size-[420px] -translate-x-1/2 rounded-full bg-emerald-200/35 blur-3xl"></div>
            <div class="absolute right-0 -bottom-24 size-80 rounded-full bg-amber-200/25 blur-3xl"></div>
            <div class="absolute inset-0 bg-[radial-gradient(#06231B10_1px,transparent_1px)] [background-size:22px_22px]"></div>
        </div>

        <main class="flex min-h-dvh items-center justify-center p-3 sm:p-5">
            <div class="w-full max-w-[520px] md:max-w-[660px] xl:max-w-[520px]">
                <div class="overflow-hidden rounded-[24px] border border-stone-200/90 bg-white/95 shadow-[0_24px_55px_-15px_rgba(6,35,27,0.12)] backdrop-blur-xl">
                    <div class="h-1.5 w-full bg-linear-to-r from-emerald-600 via-teal-600 to-amber-400"></div>

                    <div class="p-5 sm:p-7">
                        {{-- Compact Top Bar: Back + Brand + Switcher --}}
                        <div class="mb-4 flex items-center justify-between gap-2 border-b border-stone-100 pb-3.5">
                            <div class="flex min-w-0 items-center gap-2.5">
                                <a
                                    href="{{ route('home') }}"
                                    wire:navigate
                                    aria-label="Kembali ke Beranda"
                                    title="Kembali ke Beranda"
                                    class="inline-flex size-8 shrink-0 items-center justify-center rounded-lg border border-stone-200/90 bg-stone-50/80 text-stone-600 transition-colors hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700"
                                >
                                    <i data-lucide="arrow-left" aria-hidden="true" class="size-4 shrink-0"></i>
                                </a>
                                <a href="{{ route('home') }}" wire:navigate class="group inline-flex shrink-0 items-center gap-2 whitespace-nowrap font-display text-base font-extrabold tracking-tight text-stone-900">
                                    <span class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-linear-to-br from-emerald-600 to-teal-700 text-white shadow-xs transition-transform group-hover:scale-105 motion-reduce:transform-none">
                                        <i data-lucide="messages-square" aria-hidden="true" class="size-4 shrink-0"></i>
                                    </span>
                                    <span>E-Report<span class="text-emerald-600">.</span></span>
                                </a>
                            </div>

                            <div class="grid shrink-0 grid-cols-2 rounded-xl border border-stone-200/80 bg-stone-100/90 p-0.5 text-xs font-bold">
                                <a
                                    href="{{ route('login') }}"
                                    wire:navigate
                                    @class([
                                        'flex min-h-8 items-center justify-center whitespace-nowrap rounded-lg px-3 transition-all sm:px-3.5',
                                        'bg-white text-emerald-800 shadow-xs ring-1 ring-stone-200/80' => request()->routeIs('login'),
                                        'text-stone-500 hover:text-stone-800' => ! request()->routeIs('login'),
                                    ])
                                >Masuk</a>
                                <a
                                    href="{{ route('register') }}"
                                    wire:navigate
                                    @class([
                                        'flex min-h-8 items-center justify-center whitespace-nowrap rounded-lg px-3 transition-all sm:px-3.5',
                                        'bg-white text-emerald-800 shadow-xs ring-1 ring-stone-200/80' => request()->routeIs('register'),
                                        'text-stone-500 hover:text-stone-800' => ! request()->routeIs('register'),
                                    ])
                                >Daftar</a>
                            </div>
                        </div>

                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>

        @livewireScripts
        <script src="https://unpkg.com/lucide@0.468.0/dist/umd/lucide.min.js"></script>
        <script>
            function renderIcons() {
                if (window.lucide) {
                    window.lucide.createIcons();
                }
            }

            renderIcons();
            document.addEventListener('livewire:navigated', renderIcons);
            document.addEventListener('livewire:init', () => {
                Livewire.hook('morphed', renderIcons);
            });
        </script>
    </body>
</html>
