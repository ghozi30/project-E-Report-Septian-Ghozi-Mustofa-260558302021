---
name: ui-ux-pro-max
description: "Advanced UI/UX design system, modern Tailwind CSS styling, micro-interactions, responsive layouts, and component architecture"
---

# UI/UX Pro Max Design System

Standar desain antarmuka kelas profesional untuk membangun aplikasi modern yang estetis, aksesibel, dan responsif dengan kompatibilitas penuh terhadap ekosistem **Laravel**, **Livewire 4**, **Alpine.js**, dan **Tailwind CSS v4**.

## 1. Hierarki Tipografi (Typography Hierarchy)

- **Pasangan Font (Font Pairing):**
  - Gunakan font display berkarakter tegas untuk heading (`--font-display`, misalnya `'Plus Jakarta Sans'`) dan font sans-serif humanis yang mudah dibaca untuk teks isi (`--font-sans`, misalnya `'DM Sans'` atau `'Instrument Sans'`).
- **Skala & Kontras:**
  - **Hero / Display:** `font-display text-4xl sm:text-6xl font-extrabold tracking-tight leading-[1.12] text-slate-950`
  - **Judul Halaman (H1):** `font-display text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900`
  - **Judul Bagian / Kartu (H2):** `font-display text-lg font-bold text-slate-900`
  - **Eyebrow / Badge Label:** `text-[11px] font-bold tracking-widest uppercase text-blue-600`
  - **Teks Isi (Body):** `text-sm sm:text-base leading-relaxed text-slate-600`
  - **Metadata / Caption:** `text-xs font-medium text-slate-400`

## 2. Palet Warna, Kedalaman & Glassmorphism

- **Permukaan & Latar Belakang (Surfaces):**
  - Hindari latar belakang putih polos yang datar di seluruh layar; gunakan kanvas berlapis seperti `bg-slate-50/80` dengan kartu `bg-white` ber-border halus `border border-slate-200/80` dan bayangan lembut `shadow-xs` atau `shadow-xl shadow-slate-900/5`.
- **Glassmorphism:**
  - Gunakan efek kaca buram pada navigasi sticky, floating badge, dan overlay modal: `bg-white/85 backdrop-blur-md border-b border-slate-200/70`.
  - Pada permukaan gelap (`bg-slate-950`), gunakan kartu semi-transparan `bg-white/5 backdrop-blur-sm border border-white/10` yang dilengkapi pendaran cahaya ambient (`blur-3xl`).
- **Aksen & Gradien Modern:**
  - Gunakan gradien terarah pada elemen aksi utama (CTA) dan indikator aktif: `bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-600/20`.
- **Badge Status Semantik:**
  - Gunakan kombinasi warna latar lembut, teks kontras, dan `ring-1 ring-inset`:
    - **Menunggu / Pending:** `bg-amber-50 text-amber-800 ring-amber-200`
    - **Diproses / Active:** `bg-blue-50 text-blue-700 ring-blue-200`
    - **Selesai / Success:** `bg-emerald-50 text-emerald-700 ring-emerald-200`
    - **Bahaya / Error:** `bg-red-50 text-red-700 ring-red-200`

## 3. Micro-Interactions & Umpan Balik Visual

- **Transisi Halus:**
  - Terapkan `transition` atau `transition-all duration-300` pada setiap elemen interaktif (tombol, kartu, tautan, input).
  - Tambahkan efek angkat halus pada kartu interaktif atau CTA primer: `hover:-translate-y-0.5` atau `hover:-translate-y-1 hover:shadow-xl`.
- **Fokus & Input:**
  - Gunakan cincin fokus berlapis yang lembut pada elemen form: `bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none`.
  - Pastikan semua kontrol interaktif memiliki `focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-blue-600`.
- **Kontrol Password & Ikon:**
  - Sediakan toggle visibilitas password (`eye` / `eye-off`) berbasis Alpine.js (`x-data="{ show: false }"`) dengan atribut aksesibilitas `:aria-label` dan `:aria-pressed`.

## 4. Loading, Empty & Error States

- **Loading States (Livewire):**
  - Selalu pasangkan aksi form dan tombol dengan `wire:loading.attr="disabled"` dan `wire:target="..."`.
  - Tampilkan teks atau indikator status yang jelas menggunakan `wire:loading.remove` dan `wire:loading` (misalnya *"Menyimpan…"* atau *"Mengunggah foto…"*).
- **Empty States:**
  - Jangan pernah menampilkan tabel kosong tanpa konteks. Gunakan kontainer terpusat (`px-6 py-16 text-center`) dengan ikon ilustrasi dalam wadah berlatar lembut (`h-16 w-16 rounded-2xl bg-blue-50 text-blue-600`), judul yang ramah, subteks penjelas, dan tombol aksi (CTA) langsung.
- **Validasi & Pesan Error:**
  - Kaitkan input yang gagal validasi menggunakan `aria-describedby` dan `aria-invalid="true"`, serta tampilkan pesan error dengan `role="alert" class="mt-2 text-sm text-red-600"`.

## 5. Tata Letak Responsif & Arsitektur Komponen (Laravel + Livewire + Tailwind v4)

- **Tailwind CSS v4:**
  - Gunakan konfigurasi CSS-first dengan direktif `@theme` dan utilitas modern Tailwind v4 (`shadow-2xs`, `shadow-xs`, `backdrop-blur-xs`, modifier opasitas seperti `bg-slate-950/50`, serta `gap-*` alih-alih margin antar elemen sejajar).
- **Navigasi & Layout Adaptif:**
  - Gunakan sidebar tetap (`w-72`) di layar desktop (`lg:pl-72`) yang bertransformasi menjadi off-canvas drawer beranimasi halus di perangkat mobile menggunakan Alpine.js (`x-data`, `:inert`, `@keydown.escape.window`).
  - Bungkus tabel data lebar di dalam `overflow-x-auto` dengan lebar minimum yang proporsional agar tetap nyaman digeser pada layar ponsel.
- **Kompatibilitas Livewire 4 & Ikon:**
  - Gunakan `wire:key` unik pada setiap perulangan `@foreach`.
  - Pastikan pustaka ikon (seperti Lucide Icons) dirender ulang saat inisialisasi, navigasi SPA (`livewire:navigated`), dan setelah DOM diperbarui (`Livewire.hook('morphed', ...)`).

