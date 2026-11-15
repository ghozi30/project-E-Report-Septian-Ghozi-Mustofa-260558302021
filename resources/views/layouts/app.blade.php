<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#06231B">
        <title>{{ $title ?? 'Dashboard' }} · Suara Warga, Langkah Perubahan</title>
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
                    font-size: 18.5px;
                }
            }
        </style>
        @livewireStyles
    </head>
    <body class="bg-canvas font-sans text-stone-900 antialiased selection:bg-emerald-700 selection:text-white" x-data="{ menuOpen: false, desktop: window.innerWidth >= 1280 }" @resize.window="desktop = window.innerWidth >= 1280" @keydown.escape.window="menuOpen = false">
        <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-50 focus:rounded-xl focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-bold focus:text-stone-900 focus:shadow-lg">Langsung ke konten</a>

        <div x-show="menuOpen" x-cloak x-transition.opacity @click="menuOpen = false" class="fixed inset-0 z-30 bg-stone-950/60 backdrop-blur-xs xl:hidden"></div>

        {{-- Sidebar: navigasi bersama untuk dashboard warga dan administrator --}}
        <aside :inert="!menuOpen && !desktop" :class="menuOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-40 flex w-64 flex-col border-r border-emerald-950/20 bg-forest text-white transition-transform duration-300 ease-out motion-reduce:transition-none xl:translate-x-0">
            <div class="flex h-16 shrink-0 items-center justify-between border-b border-white/10 px-5">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 font-display text-lg font-extrabold tracking-tight text-white">
                    <span class="flex size-9 items-center justify-center rounded-xl bg-linear-to-br from-emerald-500 to-teal-600 text-white shadow-sm shadow-emerald-950/50 ring-1 ring-white/20">
                        <i data-lucide="messages-square" aria-hidden="true" class="size-4 shrink-0"></i>
                    </span>
                    <span>
                        E-Report<span class="text-amber-300">.</span>
                    </span>
                </a>
                <button @click="menuOpen = false" class="flex size-9 items-center justify-center rounded-lg text-emerald-200/75 transition-colors hover:bg-white/10 hover:text-white xl:hidden" aria-label="Tutup navigasi">
                    <i data-lucide="x" aria-hidden="true" class="size-5 shrink-0"></i>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto px-3.5 py-5">
                <div class="mb-2.5 flex items-center justify-between px-2.5">
                    <p class="text-[10px] font-bold tracking-[.16em] text-emerald-200/65">MENU {{ auth()->user()->role === 'admin' ? 'ADMINISTRATOR' : 'WARGA' }}</p>
                    <span @class([
                        'rounded-full px-2 py-0.5 text-[10px] font-bold ring-1 ring-inset',
                        'bg-amber-400/15 text-amber-300 ring-amber-300/30' => auth()->user()->role === 'admin',
                        'bg-emerald-400/15 text-emerald-300 ring-emerald-300/30' => auth()->user()->role !== 'admin',
                    ])>{{ auth()->user()->role === 'admin' ? 'Admin' : 'Warga' }}</span>
                </div>

                <nav aria-label="Navigasi utama" class="space-y-1">
                    @if(auth()->user()->role === 'admin')
                        <a
                            href="{{ route('admin.dashboard') }}"
                            aria-current="{{ request()->routeIs('admin.dashboard') ? 'page' : 'false' }}"
                            @class([
                                'group flex min-h-10 items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all',
                                'bg-linear-to-r from-emerald-600 to-teal-600 text-white shadow-sm shadow-emerald-950/40 ring-1 ring-white/15' => request()->routeIs('admin.dashboard'),
                                'text-emerald-100/80 hover:bg-white/10 hover:text-white' => ! request()->routeIs('admin.dashboard'),
                            ])
                        >
                            <i data-lucide="layout-dashboard" aria-hidden="true" class="size-4 shrink-0"></i>
                            Dashboard
                        </a>
                        <a
                            href="{{ route('admin.laporan.index') }}"
                            aria-current="{{ request()->routeIs('admin.laporan.*') ? 'page' : 'false' }}"
                            @class([
                                'group flex min-h-10 items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all',
                                'bg-linear-to-r from-emerald-600 to-teal-600 text-white shadow-sm shadow-emerald-950/40 ring-1 ring-white/15' => request()->routeIs('admin.laporan.*'),
                                'text-emerald-100/80 hover:bg-white/10 hover:text-white' => ! request()->routeIs('admin.laporan.*'),
                            ])
                        >
                            <i data-lucide="files" aria-hidden="true" class="size-4 shrink-0"></i>
                            Semua Pengaduan
                        </a>
                    @else
                        <a
                            href="{{ route('warga.dashboard') }}"
                            aria-current="{{ request()->routeIs('warga.dashboard') ? 'page' : 'false' }}"
                            @class([
                                'group flex min-h-10 items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all',
                                'bg-linear-to-r from-emerald-600 to-teal-600 text-white shadow-sm shadow-emerald-950/40 ring-1 ring-white/15' => request()->routeIs('warga.dashboard'),
                                'text-emerald-100/80 hover:bg-white/10 hover:text-white' => ! request()->routeIs('warga.dashboard'),
                            ])
                        >
                            <i data-lucide="layout-dashboard" aria-hidden="true" class="size-4 shrink-0"></i>
                            Dashboard
                        </a>
                        <a
                            href="{{ route('warga.laporan.index') }}"
                            aria-current="{{ request()->routeIs('warga.laporan.index', 'warga.laporan.show', 'warga.laporan.edit') ? 'page' : 'false' }}"
                            @class([
                                'group flex min-h-10 items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all',
                                'bg-linear-to-r from-emerald-600 to-teal-600 text-white shadow-sm shadow-emerald-950/40 ring-1 ring-white/15' => request()->routeIs('warga.laporan.index', 'warga.laporan.show', 'warga.laporan.edit'),
                                'text-emerald-100/80 hover:bg-white/10 hover:text-white' => ! request()->routeIs('warga.laporan.index', 'warga.laporan.show', 'warga.laporan.edit'),
                            ])
                        >
                            <i data-lucide="files" aria-hidden="true" class="size-4 shrink-0"></i>
                            Pengaduan Saya
                        </a>
                        <a
                            href="{{ route('warga.laporan.create') }}"
                            aria-current="{{ request()->routeIs('warga.laporan.create') ? 'page' : 'false' }}"
                            @class([
                                'group flex min-h-10 items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all',
                                'bg-linear-to-r from-emerald-600 to-teal-600 text-white shadow-sm shadow-emerald-950/40 ring-1 ring-white/15' => request()->routeIs('warga.laporan.create'),
                                'text-emerald-100/80 hover:bg-white/10 hover:text-white' => ! request()->routeIs('warga.laporan.create'),
                            ])
                        >
                            <i data-lucide="circle-plus" aria-hidden="true" class="size-4 shrink-0"></i>
                            Buat Pengaduan
                        </a>
                        <a
                            href="{{ route('warga.profile') }}"
                            aria-current="{{ request()->routeIs('warga.profile') ? 'page' : 'false' }}"
                            @class([
                                'group flex min-h-10 items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all',
                                'bg-linear-to-r from-emerald-600 to-teal-600 text-white shadow-sm shadow-emerald-950/40 ring-1 ring-white/15' => request()->routeIs('warga.profile'),
                                'text-emerald-100/80 hover:bg-white/10 hover:text-white' => ! request()->routeIs('warga.profile'),
                            ])
                        >
                            <i data-lucide="user-round" aria-hidden="true" class="size-4 shrink-0"></i>
                            Profil Saya
                        </a>
                    @endif
                </nav>
            </div>

            <div class="mx-3.5 mt-auto mb-3.5 overflow-hidden rounded-xl border border-white/10 bg-white/5 p-3.5 backdrop-blur-sm">
                <div class="flex items-center gap-2.5">
                    <span class="flex size-7 shrink-0 items-center justify-center rounded-lg bg-amber-400/20 text-amber-300 ring-1 ring-amber-300/30">
                        <i data-lucide="heart-handshake" aria-hidden="true" class="size-4 shrink-0"></i>
                    </span>
                    <p class="font-display text-xs font-bold text-white">Setiap suara berarti.</p>
                </div>
                <p class="mt-2 text-[11px] leading-relaxed text-emerald-100/75">Bersama wujudkan lingkungan yang aman dan nyaman.</p>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="border-t border-white/10 p-3.5">
                @csrf
                <button class="flex min-h-10 w-full items-center gap-2.5 rounded-xl px-3.5 py-2 text-xs font-semibold text-emerald-100/85 transition-colors hover:bg-red-500/15 hover:text-red-200 sm:text-sm">
                    <i data-lucide="log-out" aria-hidden="true" class="size-4 shrink-0"></i>
                    Keluar dari Akun
                </button>
            </form>
        </aside>

        <div class="xl:pl-64">
            <header class="sticky top-0 z-20 flex h-16 items-center justify-between gap-4 border-b border-stone-200/80 bg-canvas/85 px-4 backdrop-blur-md sm:px-7">
                <div class="flex min-w-0 items-center gap-3">
                    <button @click="menuOpen = true" aria-label="Buka navigasi" :aria-expanded="menuOpen" class="flex size-10 shrink-0 items-center justify-center rounded-xl border border-stone-200 bg-white text-stone-700 shadow-2xs transition-colors hover:bg-stone-50 xl:hidden">
                        <i data-lucide="menu" aria-hidden="true" class="size-5 shrink-0"></i>
                    </button>
                    <div class="min-w-0">
                        <p class="truncate font-display text-sm font-bold text-stone-900 sm:text-base">{{ $title ?? 'Dashboard' }}</p>
                        <p class="hidden text-[11px] text-stone-500 sm:block">Layanan aspirasi &amp; pengaduan masyarakat</p>
                    </div>
                </div>

                <div class="flex shrink-0 items-center gap-2.5">
                    <span class="hidden items-center gap-1.5 rounded-xl border border-stone-200/90 bg-white px-3 py-1.5 text-xs font-medium text-stone-600 shadow-2xs tabular-nums md:inline-flex">
                        <i data-lucide="calendar" aria-hidden="true" class="size-3.5 text-emerald-600"></i>
                        {{ now()->locale('id')->translatedFormat('d F Y') }}
                    </span>
                    <span class="mx-0.5 hidden h-6 w-px bg-stone-200 md:block"></span>

                    @if(auth()->user()->role !== 'admin')
                        <a href="{{ route('warga.profile') }}" class="flex items-center gap-2.5 rounded-full border border-stone-200/90 bg-white p-1 pr-3 shadow-2xs transition-colors hover:border-emerald-200 hover:bg-emerald-50/40">
                    @else
                        <div class="flex items-center gap-2.5 rounded-full border border-stone-200/90 bg-white p-1 pr-3 shadow-2xs">
                    @endif
                        @if(auth()->user()->foto)
                            <img src="{{ Storage::disk('public')->url(auth()->user()->foto) }}" alt="Foto profil" class="size-8 rounded-full object-cover ring-2 ring-emerald-50">
                        @else
                            <span class="flex size-8 items-center justify-center rounded-full bg-linear-to-br from-emerald-600 to-teal-700 text-xs font-bold text-white shadow-xs">{{ mb_substr(auth()->user()->name, 0, 1) }}</span>
                        @endif
                        <div class="hidden sm:block">
                            <p class="max-w-32 truncate text-xs font-bold text-stone-900">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] font-medium text-stone-500">{{ auth()->user()->role === 'admin' ? 'Administrator' : 'Warga' }}</p>
                        </div>
                    @if(auth()->user()->role !== 'admin')
                        </a>
                    @else
                        </div>
                    @endif
                </div>
            </header>

            {{-- Isi halaman Livewire ditampilkan melalui slot ini --}}
            <main id="main-content" class="mx-auto min-h-[calc(100dvh-118px)] max-w-6xl px-4 py-6 sm:px-7 sm:py-7">{{ $slot }}</main>

            <footer class="flex flex-wrap items-center justify-between gap-2 border-t border-stone-200/80 bg-white/60 px-4 py-4 text-xs text-stone-500 sm:px-7">
                <p class="font-medium text-stone-600">© {{ date('Y') }} E-Report</p>
                <p>Suara Warga, Langkah Perubahan.</p>
            </footer>
        </div>

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
