<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#06231B">
        <title>Beranda · Suara Warga, Langkah Perubahan</title>
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
                --color-forest-soft: #0C362B;
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
            @media (min-width: 768px) and (max-width: 1023px) {
                html {
                    font-size: 17.5px;
                }
            }
            @media (min-width: 1024px) and (max-width: 1279px) {
                html {
                    font-size: 19px;
                }
            }
            @media (min-width: 1280px) {
                html {
                    font-size: 17px;
                }
            }
        </style>
        @livewireStyles
        <meta name="description" content="E-Report membantu warga menyampaikan pengaduan lingkungan dengan mudah dan memantau penanganannya secara transparan.">
    </head>
    <body class="bg-canvas font-sans text-stone-900 antialiased selection:bg-emerald-700 selection:text-white">
        <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-50 focus:rounded-xl focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-bold focus:text-stone-900 focus:shadow-lg">Langsung ke konten</a>

        <header
            x-data="{ mobileMenu: false }"
            @keydown.escape.window="mobileMenu = false"
            @click.outside="mobileMenu = false"
            class="sticky top-0 z-30 border-b border-stone-200/75 bg-canvas/90 backdrop-blur-md"
        >
            <nav class="mx-auto flex max-w-7xl items-center justify-between gap-2 px-4 py-3 sm:gap-4 sm:px-8 sm:py-3.5 lg:px-10" aria-label="Navigasi beranda">
                <a href="{{ route('home') }}" class="inline-flex shrink-0 items-center gap-2 whitespace-nowrap font-display text-base font-extrabold tracking-tight text-stone-900 sm:gap-2.5 sm:text-lg">
                    <span class="flex size-8 shrink-0 items-center justify-center rounded-xl bg-linear-to-br from-emerald-600 to-teal-700 text-white shadow-sm shadow-emerald-950/15 ring-1 ring-emerald-500/30 sm:size-9">
                        <i data-lucide="messages-square" aria-hidden="true" class="size-4 shrink-0"></i>
                    </span>
                    <span>
                        E-Report<span class="text-emerald-600">.</span>
                    </span>
                </a>
                <div class="hidden items-center gap-6 text-xs font-semibold text-stone-600 lg:flex lg:gap-7 lg:text-sm">
                    <a href="#tentang" class="whitespace-nowrap transition-colors hover:text-emerald-700">Keunggulan</a>
                    <a href="#cara-kerja" class="whitespace-nowrap transition-colors hover:text-emerald-700">Alur Warga</a>
                    <a href="#status" class="whitespace-nowrap transition-colors hover:text-emerald-700">Transparansi Status</a>
                </div>
                <div class="hidden shrink-0 items-center gap-1.5 sm:gap-2 lg:flex">
                    @auth
                        <a
                            href="{{ route(auth()->user()->dashboardRoute()) }}"
                            class="inline-flex min-h-9 items-center justify-center gap-1.5 whitespace-nowrap rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-3 py-1.5 text-xs font-bold text-white shadow-sm shadow-emerald-950/15 transition-all duration-200 hover:-translate-y-0.5 hover:from-emerald-700 hover:to-teal-800 sm:min-h-10 sm:px-4 sm:py-2 sm:text-sm motion-reduce:transform-none"
                        >
                            Dashboard
                            <i data-lucide="arrow-up-right" aria-hidden="true" class="size-3.5 shrink-0 sm:size-4"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex min-h-9 items-center whitespace-nowrap rounded-xl px-2.5 py-1.5 text-xs font-bold text-stone-700 transition-colors hover:bg-stone-200/60 sm:min-h-10 sm:px-3.5 sm:py-2 sm:text-sm">Masuk</a>
                        <a
                            href="{{ route('register') }}"
                            class="inline-flex min-h-9 items-center justify-center gap-1 whitespace-nowrap rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-3 py-1.5 text-xs font-bold text-white shadow-sm shadow-emerald-950/15 transition-all duration-200 hover:-translate-y-0.5 hover:from-emerald-700 hover:to-teal-800 sm:min-h-10 sm:gap-1.5 sm:px-4 sm:py-2 sm:text-sm motion-reduce:transform-none"
                        >
                            Daftar Warga
                            <i data-lucide="arrow-up-right" aria-hidden="true" class="size-3.5 shrink-0 sm:size-4"></i>
                        </a>
                    @endauth
                </div>

                {{-- Mobile & Small Tablet Hamburger Button --}}
                <button
                    type="button"
                    @click="mobileMenu = !mobileMenu"
                    :aria-expanded="mobileMenu"
                    :aria-label="mobileMenu ? 'Tutup menu navigasi' : 'Buka menu navigasi'"
                    class="flex size-10 shrink-0 items-center justify-center rounded-xl border border-stone-200/90 bg-white text-stone-700 shadow-2xs transition-colors hover:border-emerald-200 hover:bg-emerald-50/50 hover:text-emerald-700 lg:hidden"
                >
                    <span x-show="!mobileMenu" class="flex items-center">
                        <i data-lucide="menu" aria-hidden="true" class="size-5 shrink-0"></i>
                    </span>
                    <span x-show="mobileMenu" x-cloak class="flex items-center">
                        <i data-lucide="x" aria-hidden="true" class="size-5 shrink-0"></i>
                    </span>
                </button>
            </nav>

            {{-- Mobile & Small Tablet Dropdown Overlay Menu --}}
            <div
                x-show="mobileMenu"
                x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                class="absolute inset-x-3 top-full z-40 mt-2 rounded-2xl border border-stone-200/90 bg-white/95 p-4 shadow-xl shadow-stone-950/12 backdrop-blur-md lg:hidden"
            >
                <div class="space-y-1">
                    <a href="#tentang" @click="mobileMenu = false" class="flex min-h-11 items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold text-stone-700 transition-colors hover:bg-emerald-50 hover:text-emerald-800">
                        <i data-lucide="sparkles" aria-hidden="true" class="size-4 shrink-0 text-emerald-600"></i>
                        Keunggulan
                    </a>
                    <a href="#cara-kerja" @click="mobileMenu = false" class="flex min-h-11 items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold text-stone-700 transition-colors hover:bg-emerald-50 hover:text-emerald-800">
                        <i data-lucide="git-branch" aria-hidden="true" class="size-4 shrink-0 text-emerald-600"></i>
                        Alur Warga
                    </a>
                    <a href="#status" @click="mobileMenu = false" class="flex min-h-11 items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold text-stone-700 transition-colors hover:bg-emerald-50 hover:text-emerald-800">
                        <i data-lucide="activity" aria-hidden="true" class="size-4 shrink-0 text-emerald-600"></i>
                        Transparansi Status
                    </a>
                </div>

                <div class="mt-3 grid grid-cols-2 gap-2.5 border-t border-stone-100 pt-3">
                    @auth
                        <a
                            href="{{ route(auth()->user()->dashboardRoute()) }}"
                            class="col-span-2 inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-4 py-2.5 text-sm font-bold text-white shadow-sm"
                        >
                            Buka Dashboard
                            <i data-lucide="arrow-up-right" aria-hidden="true" class="size-4 shrink-0"></i>
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex min-h-11 items-center justify-center rounded-xl border border-stone-200 bg-stone-50 px-4 py-2.5 text-sm font-bold text-stone-700 transition-colors hover:bg-stone-100"
                        >
                            Masuk
                        </a>
                        <a
                            href="{{ route('register') }}"
                            class="inline-flex min-h-11 items-center justify-center gap-1.5 rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-4 py-2.5 text-sm font-bold text-white shadow-sm"
                        >
                            Daftar Warga
                            <i data-lucide="arrow-up-right" aria-hidden="true" class="size-4 shrink-0"></i>
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        <main id="main-content">
            <section class="relative overflow-hidden bg-linear-to-b from-canvas via-emerald-50/30 to-canvas lg:flex lg:min-h-[calc(100dvh-4rem)] lg:items-center">
                <div class="pointer-events-none absolute -top-32 right-1/4 size-80 rounded-full bg-emerald-400/15 blur-3xl"></div>
                <div class="pointer-events-none absolute bottom-0 left-10 size-64 rounded-full bg-amber-300/15 blur-3xl"></div>
                <div class="mx-auto grid w-full max-w-7xl items-center gap-8 px-4 py-8 sm:px-8 sm:py-12 lg:grid-cols-[1.1fr_1fr] lg:gap-14 lg:px-10 lg:py-10">
                    <div>
                        <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-200/80 bg-white px-4 py-1.5 text-xs font-bold tracking-wide text-emerald-800 shadow-2xs">
                            <span class="relative flex size-2">
                                <span class="absolute inline-flex size-full animate-ping rounded-full bg-emerald-500 opacity-75 motion-reduce:animate-none"></span>
                                <span class="relative inline-flex size-2 rounded-full bg-emerald-600"></span>
                            </span>
                            PORTAL ASPIRASI &amp; PENGADUAN WARGA
                        </div>
                        <h1 class="max-w-xl font-display text-4xl leading-[1.12] font-extrabold tracking-tight text-balance text-stone-950 sm:text-5xl lg:text-[3.5rem]">
                            Suara Warga,
                            <br>
                            Langkah
                            <span class="bg-linear-to-r from-emerald-700 via-teal-600 to-emerald-500 bg-clip-text text-transparent">Perubahan.</span>
                        </h1>
                        <p class="mt-5 max-w-lg text-base leading-relaxed text-stone-600 sm:text-lg">
                            Laporkan permasalahan lingkungan sekitar secara terstruktur, lampirkan foto bukti, dan pantau progres penanganannya secara transparan.
                        </p>
                        <div class="mt-7 flex flex-wrap gap-3.5">
                            <a
                                href="{{ auth()->check() ? route(auth()->user()->dashboardRoute()) : route('register') }}"
                                class="inline-flex min-h-12 items-center justify-center gap-2 rounded-xl bg-linear-to-r from-emerald-600 to-teal-700 px-6 py-3 text-base font-bold text-white shadow-md shadow-emerald-950/15 transition-all duration-200 hover:-translate-y-0.5 hover:from-emerald-700 hover:to-teal-800 active:scale-[0.98] motion-reduce:transform-none"
                            >
                                {{ auth()->check() ? 'Buka Dashboard Saya' : 'Mulai Buat Pengaduan' }}
                                <i data-lucide="arrow-right" aria-hidden="true" class="size-4 shrink-0"></i>
                            </a>
                            <a
                                href="#cara-kerja"
                                class="inline-flex min-h-12 items-center justify-center gap-2 rounded-xl border border-stone-200/90 bg-white px-6 py-3 text-base font-bold text-stone-700 shadow-2xs transition-colors hover:border-stone-300 hover:bg-stone-50"
                            >
                                Lihat Alur Pelaporan
                            </a>
                        </div>
                        <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-2.5 border-t border-stone-200/80 pt-5 text-sm font-medium text-stone-600">
                            <div class="flex items-center gap-2">
                                <i data-lucide="shield-check" aria-hidden="true" class="size-4 shrink-0 text-emerald-600"></i>
                                <span>Privasi terjaga</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock-3" aria-hidden="true" class="size-4 shrink-0 text-amber-600"></i>
                                <span>Status real-time</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="file-pen-line" aria-hidden="true" class="size-4 shrink-0 text-teal-600"></i>
                                <span>Edit sebelum diproses</span>
                            </div>
                        </div>
                    </div>

                    <div class="relative mx-auto w-full max-w-[490px] pb-5 lg:pl-3" aria-label="Ilustrasi alur pengaduan warga">
                        <div class="absolute inset-3 -rotate-2 rounded-3xl bg-linear-to-tr from-emerald-200/60 via-teal-100/60 to-amber-100/50"></div>
                        <div class="relative overflow-hidden rounded-2xl border border-stone-200/90 bg-white shadow-xl shadow-stone-950/10">
                            <div class="flex items-center justify-between border-b border-stone-100 bg-stone-50/80 px-5 py-3">
                                <div class="flex items-center gap-2 text-xs font-bold text-stone-900 sm:text-sm">
                                    <span class="flex size-7 items-center justify-center rounded-lg bg-linear-to-br from-emerald-600 to-teal-700 text-white shadow-xs">
                                        <i data-lucide="messages-square" aria-hidden="true" class="size-3.5 shrink-0"></i>
                                    </span>
                                    Pratinjau Tiket Laporan
                                </div>
                                <span class="rounded-full border border-emerald-200/80 bg-emerald-50 px-2.5 py-0.5 text-[10px] font-bold tracking-wider text-emerald-800">CONTOH ALUR</span>
                            </div>
                            <div class="p-5">
                                <div class="relative mb-4 flex h-28 items-center justify-center overflow-hidden rounded-xl border border-emerald-100 bg-emerald-50/50">
                                    <svg viewBox="0 0 400 180" width="400" height="180" class="size-full object-cover" role="img" aria-label="Ilustrasi lingkungan perkotaan">
                                        <rect width="400" height="180" fill="#ecfdf5"/>
                                        <circle cx="326" cy="35" r="20" fill="#fcd34d"/>
                                        <rect y="140" width="400" height="40" fill="#d1fae5"/>
                                        <path d="M0 160h400" stroke="#6ee7b7" stroke-width="2"/>
                                        <path d="M0 176h400" stroke="#fff" stroke-width="3" stroke-dasharray="28 18"/>
                                        <path d="M55 140V67h58v73M131 140V42h66v98M215 140V82h56v58" fill="#a7f3d0" stroke="#10b981" stroke-width="2"/>
                                        <path d="M65 81h12m15 0h12M65 102h12m15 0h12M65 122h12m15 0h12M143 57h14m14 0h14M143 78h14m14 0h14M143 99h14m14 0h14M143 120h14m14 0h14M227 96h12m12 0h12M227 117h12m12 0h12" stroke="#059669" stroke-width="5"/>
                                        <path d="M310 140V99m0-12V60h29" stroke="#44403c" stroke-width="4" fill="none"/>
                                        <path d="M330 60h17" stroke="#f59e0b" stroke-width="7" stroke-linecap="round"/>
                                        <path d="M35 140v-30m0-8V85" stroke="#047857" stroke-width="5"/>
                                        <circle cx="35" cy="92" r="17" fill="#34d399"/>
                                        <path d="M365 140v-30" stroke="#047857" stroke-width="5"/>
                                        <circle cx="365" cy="99" r="21" fill="#34d399"/>
                                    </svg>
                                </div>
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-[10px] font-bold tracking-widest text-stone-400 tabular-nums"># 00128 · CONTOH PENGADUAN</p>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-sky-50 px-2.5 py-0.5 text-[10px] font-bold text-sky-800 ring-1 ring-inset ring-sky-200/80">
                                        <span class="size-1.5 rounded-full bg-current"></span>
                                        Sedang Diproses
                                    </span>
                                </div>
                                <h2 class="mt-1.5 font-display text-base font-bold text-stone-900">Lampu jalan mati di Jalan Melati</h2>
                                <p class="mt-1 text-xs leading-relaxed text-stone-500">Dilengkapi foto lokasi &amp; tanggal kejadian agar cepat ditindaklanjuti.</p>
                                <div class="mt-3.5 space-y-2.5 border-t border-stone-100 pt-3.5">
                                    @foreach([
                                        ['circle-check', '1. Terkirim & tercatat', 'Status awal Menunggu, masih bisa diedit', 'text-emerald-700 bg-emerald-50 ring-1 ring-emerald-200/70'],
                                        ['loader-circle', '2. Ditinjau & diproses', 'Pengelola menangani masalah di lapangan', 'text-sky-700 bg-sky-50 ring-1 ring-sky-200/70'],
                                        ['shield-check', '3. Selesai ditangani', 'Tercatat tuntas pada riwayat Anda', 'text-amber-700 bg-amber-50 ring-1 ring-amber-200/70']
                                    ] as [$icon, $title, $desc, $color])
                                        <div class="flex items-center gap-3">
                                            <span class="flex size-8 shrink-0 items-center justify-center rounded-lg {{ $color }}">
                                                <i data-lucide="{{ $icon }}" aria-hidden="true" class="size-3.5 shrink-0"></i>
                                            </span>
                                            <div class="min-w-0">
                                                <p class="text-xs font-bold text-stone-800">{{ $title }}</p>
                                                <p class="text-[11px] text-stone-500">{{ $desc }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="absolute right-2 -bottom-1 flex items-center gap-2.5 rounded-xl border border-emerald-200/80 bg-white/95 px-4 py-2.5 shadow-lg shadow-stone-950/10 backdrop-blur-md sm:-right-3">
                            <span class="rounded-lg bg-emerald-50 p-2 text-emerald-700 ring-1 ring-emerald-200/60">
                                <i data-lucide="heart-handshake" aria-hidden="true" class="size-4 shrink-0"></i>
                            </span>
                            <div>
                                <p class="text-[11px] font-bold text-stone-900">Alur Warga Sederhana</p>
                                <p class="text-[10px] text-stone-500">Daftar, lapor, pantau hasilnya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="tentang" class="mx-auto w-full max-w-7xl scroll-mt-16 px-4 py-12 sm:px-8 sm:py-16 lg:px-10 lg:py-20 xl:flex xl:min-h-[calc(100dvh-4rem)] xl:flex-col xl:justify-center xl:py-12">
                <div class="grid items-end gap-6 md:grid-cols-2 md:gap-10">
                    <div>
                        <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200/70 bg-emerald-50 px-3 py-1 text-[11px] font-bold tracking-widest text-emerald-700">KEUNGGULAN WARGA</span>
                        <h2 class="mt-3 max-w-lg font-display text-2xl leading-snug font-extrabold tracking-tight text-balance text-stone-900 sm:text-3xl">
                            Dirancang agar setiap warga mudah melapor.
                        </h2>
                    </div>
                    <p class="max-w-xl text-sm leading-relaxed text-stone-600 sm:text-base">Mulai dari jalan berlubang, penerangan padam, hingga kebersihan fasilitas umum—semua tersimpan rapi dalam riwayat akun Anda.</p>
                </div>
                <div class="mt-9 grid gap-5 md:grid-cols-3">
                    @foreach([
                        ['send', 'Formulir Ringkas & Jelas', 'Isi judul, deskripsi lokasi, tanggal kejadian, dan unggah foto bukti opsional dalam satu layar yang rapi.'],
                        ['scan-eye', 'Pantau Progres Real-time', 'Lihat langsung tahapan pengaduan dari Menunggu, Sedang Diproses, hingga Selesai tanpa harus bertanya ulang.'],
                        ['pencil-ruler', 'Fleksibel Sebelum Diproses', 'Ada detail yang terlewat atau foto ingin diganti? Anda dapat mengedit atau menghapus laporan selama berstatus Menunggu.']
                    ] as [$icon, $title, $desc])
                        <div class="group rounded-2xl border border-stone-200/80 bg-white p-6 shadow-xs transition-all duration-300 hover:-translate-y-0.5 hover:border-emerald-300/80 hover:shadow-lg hover:shadow-emerald-950/5 motion-reduce:transform-none">
                            <span class="mb-4 inline-flex rounded-xl bg-linear-to-br from-emerald-50 to-teal-50 p-3 text-emerald-700 ring-1 ring-emerald-200/60 transition-colors duration-300 group-hover:from-emerald-600 group-hover:to-teal-700 group-hover:text-white">
                                <i data-lucide="{{ $icon }}" aria-hidden="true" class="size-5 shrink-0"></i>
                            </span>
                            <h3 class="font-display text-lg font-bold text-stone-900">{{ $title }}</h3>
                            <p class="mt-2 text-sm leading-6 text-stone-600">{{ $desc }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="cara-kerja" class="scroll-mt-16 border-y border-stone-200/75 bg-stone-100/60 px-4 py-12 sm:px-8 sm:py-16 lg:px-10 lg:py-20 xl:flex xl:min-h-[calc(100dvh-4rem)] xl:flex-col xl:justify-center xl:py-12">
                <div class="mx-auto w-full max-w-7xl lg:px-2">
                    <div class="text-center">
                        <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200/70 bg-emerald-50 px-3 py-1 text-[11px] font-bold tracking-widest text-emerald-700">ALUR PENGADUAN WARGA</span>
                        <h2 class="mt-3 font-display text-2xl font-extrabold tracking-tight text-balance text-stone-900 sm:text-3xl">Empat langkah perjalanan Anda.</h2>
                        <p class="mx-auto mt-2 max-w-xl text-sm leading-relaxed text-stone-600">Alur sederhana dari pendaftaran hingga laporan tuntas ditangani.</p>
                    </div>
                    <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach([
                            ['user-plus', 'Daftar / Masuk Akun', 'Buat akun warga dengan email, WhatsApp, dan alamat, atau langsung masuk jika sudah terdaftar.'],
                            ['file-plus-2', 'Kirim Pengaduan', 'Buka menu Buat Pengaduan, isi masalah & tanggal kejadian, lalu lampirkan foto bukti.'],
                            ['sliders-horizontal', 'Kelola & Tinjau', 'Selama berstatus Menunggu, laporan tetap bisa diedit atau dihapus dari daftar Pengaduan Saya.'],
                            ['check-check', 'Pantau Hingga Selesai', 'Ikuti pembaruan status pada halaman Detail Pengaduan hingga masalah tuntas ditangani.']
                        ] as [$icon, $title, $desc])
                            <div class="relative flex flex-col rounded-2xl border border-stone-200/80 bg-white p-5 shadow-xs transition-all duration-300 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md motion-reduce:transform-none">
                                <div class="flex items-center justify-between gap-3">
                                    <span class="flex size-10 items-center justify-center rounded-xl bg-linear-to-br from-emerald-600 to-teal-700 text-white shadow-sm shadow-emerald-950/15">
                                        <i data-lucide="{{ $icon }}" aria-hidden="true" class="size-4 shrink-0"></i>
                                    </span>
                                    <span class="font-display text-xl font-extrabold text-stone-200 tabular-nums">0{{ $loop->iteration }}</span>
                                </div>
                                <h3 class="mt-4 font-display text-base font-bold text-stone-900">{{ $title }}</h3>
                                <p class="mt-2 text-xs leading-6 text-stone-600 sm:text-sm">{{ $desc }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="status" class="mx-auto max-w-7xl scroll-mt-16 px-4 py-12 sm:px-8 sm:py-16 lg:flex lg:min-h-[calc(100dvh-4rem)] lg:flex-col lg:justify-center lg:px-10 lg:py-7">
                <div class="text-center">
                    <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200/70 bg-emerald-50 px-3 py-1 text-[11px] font-bold tracking-widest text-emerald-700">STATUS PENGADUAN</span>
                    <h2 class="mt-3 font-display text-2xl font-extrabold tracking-tight text-balance text-stone-900 sm:text-3xl">Jelas di setiap tahap.</h2>
                    <p class="mt-2 text-sm text-stone-600">Ketahui arti setiap status pada pengaduan Anda.</p>
                </div>
                <div class="mt-7 grid gap-5 md:grid-cols-3">
                    @foreach([
                        'pending' => ['clock-3', 'Pengaduan telah masuk dan menunggu peninjauan. Pada tahap ini Anda masih bebas mengedit atau menghapus laporan.'],
                        'proses' => ['loader-circle', 'Pengelola sedang menindaklanjuti permasalahan di lapangan. Data laporan dikunci agar catatan tetap konsisten.'],
                        'selesai' => ['circle-check', 'Penanganan permasalahan telah dirampungkan dan tercatat sebagai arsip riwayat pengaduan Anda.']
                    ] as $status => [$icon, $desc])
                        <div class="rounded-2xl border border-stone-200/80 bg-white p-6 shadow-xs">
                            <span @class([
                                'inline-flex items-center gap-2 whitespace-nowrap rounded-full px-3 py-1 text-xs font-bold',
                                'bg-amber-50 text-amber-800 ring-1 ring-inset ring-amber-200/80' => $status === 'pending',
                                'bg-sky-50 text-sky-800 ring-1 ring-inset ring-sky-200/80' => $status === 'proses',
                                'bg-emerald-50 text-emerald-800 ring-1 ring-inset ring-emerald-200/80' => $status === 'selesai',
                            ])>
                                <i data-lucide="{{ $icon }}" aria-hidden="true" class="size-3.5 shrink-0"></i>
                                {{ \App\Models\Laporan::STATUSES[$status] ?? $status }}
                            </span>
                            <p class="mt-4 text-sm leading-6 text-stone-600">{{ $desc }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="relative mt-8 overflow-hidden rounded-3xl bg-forest p-7 text-white shadow-xl shadow-emerald-950/20 sm:p-9 lg:mt-9">
                    <div class="pointer-events-none absolute -top-24 -right-24 size-72 rounded-full bg-emerald-500/20 blur-3xl"></div>
                    <div class="pointer-events-none absolute -bottom-24 -left-24 size-72 rounded-full bg-amber-400/10 blur-3xl"></div>
                    <div class="relative z-10 flex flex-col items-start justify-between gap-6 md:flex-row md:items-center">
                        <div>
                            <h2 class="font-display text-xl font-extrabold sm:text-2xl">Siap menyampaikan aspirasi Anda?</h2>
                            <p class="mt-2 max-w-xl text-sm leading-6 text-emerald-100/80">Bergabunglah bersama warga lainnya untuk menciptakan lingkungan yang lebih tertib, aman, dan nyaman.</p>
                        </div>
                        <a
                            href="{{ auth()->check() ? route(auth()->user()->dashboardRoute()) : route('register') }}"
                            class="inline-flex min-h-11 shrink-0 items-center justify-center gap-2 rounded-xl bg-linear-to-r from-amber-300 to-amber-400 px-6 py-3 text-sm font-bold text-stone-950 shadow-md transition-all hover:-translate-y-0.5 hover:from-amber-200 hover:to-amber-300 motion-reduce:transform-none"
                        >
                            {{ auth()->check() ? 'Ke Dashboard' : 'Mulai Sekarang' }}
                            <i data-lucide="arrow-right" aria-hidden="true" class="size-4 shrink-0"></i>
                        </a>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-stone-200/80 bg-white/70">
            <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-6 sm:px-8 lg:px-10">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 font-display text-lg font-extrabold tracking-tight text-stone-900">
                    <span class="flex size-8 items-center justify-center rounded-lg bg-linear-to-br from-emerald-600 to-teal-700 text-white shadow-xs">
                        <i data-lucide="messages-square" aria-hidden="true" class="size-4 shrink-0"></i>
                    </span>
                    <span>
                        E-Report<span class="text-emerald-600">.</span>
                    </span>
                </a>
                <p class="text-xs text-stone-500">© {{ date('Y') }} E-Report. Suara Warga, Langkah Perubahan.</p>
                <a href="#cara-kerja" class="text-xs font-semibold text-stone-600 transition-colors hover:text-emerald-700">Alur Pelaporan Warga</a>
            </div>
        </footer>

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
