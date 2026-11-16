# 📢 E-Report — Layanan Pengaduan Lingkungan Warga

> *"Suara Warga, Langkah Perubahan"*

**E-Report** adalah platform berbasis web modern yang memudahkan warga masyarakat untuk menyampaikan aspirasi dan pengaduan permasalahan fasilitas publik maupun lingkungan (seperti jalan rusak, tumpukan sampah, banjir, lampu penerangan padam, dll.) secara transparan, terstruktur, dan terpantau *real-time*.

Platform ini juga dilengkapi dengan panel khusus Administrator untuk memverifikasi, menindaklanjuti, dan memperbarui status penanganan laporan secara akuntabel.

---

## 🚀 Fitur Utama

### 👤 Peran Warga (Pelapor)
* **Autentikasi Aman:** Pendaftaran akun warga dan login yang responsif.
* **Buat Pengaduan Lengkap:** Form laporan interaktif dilengkapi judul, kategori, lokasi detail, deskripsi, serta unggahan foto bukti.
* **Pemantauan Status Real-Time:** Memantau perkembangan laporan dengan status transparan:
  * 🟡 *Menunggu Verifikasi*
  * 🔵 *Sedang Diproses*
  * 🟢 *Selesai*
  * 🔴 *Ditolak* (disertai alasan/catatan petugas)
* **Manajemen Laporan:** Melihat riwayat laporan, detail penanganan, serta memperbarui/menghapus laporan yang belum diproses.
* **Manajemen Profil:** Pengelolaan data pribadi dan nomor kontak WhatsApp.

### 🛡️ Peran Administrator (Pengelola)
* **Dashboard Statistik:** Ringkasan total aduan, status pemrosesan, dan metrik penanganan laporan lingkungan.
* **Verifikasi & Tindak Lanjut:** Mengubah status laporan warga serta memberikan catatan/tanggapan progres tindak lanjut dari instansi terkait.
* **Hak Akses Terproteksi (RBAC):** Middleware keamanan ketat yang memisahkan area kerja warga dan administrator.

---

## 🛠️ Teknologi yang Digunakan (Tech Stack)

| Kategori | Teknologi | Deskripsi |
| :--- | :--- | :--- |
| **Backend Framework** | [Laravel 12](https://laravel.com/) | Framework PHP modern dengan performa andal dan arsitektur modular. |
| **Bahasa Pemrograman** | [PHP 8.4+](https://www.php.net/) | Memanfaatkan sintaks modern PHP (Property Hooks, Type Safety). |
| **Fullstack Reactivity** | [Livewire 4](https://livewire.laravel.com/) | UI dinamis dan reaktif tanpa kerumitan framework SPA terpisah. |
| **Styling & Desain** | [Tailwind CSS v4](https://tailwindcss.com/) | Utility-first CSS framework untuk antarmuka yang bersih dan responsif. |
| **Client Interaction** | [Alpine.js](https://alpinejs.dev/) | Interaktivitas komponen sisi klien yang ringan. |
| **Build Tool & Bundler** | [Vite 8](https://vite.dev/) | Bundler aset frontend super cepat untuk CSS & JavaScript. |
| **Database** | [PostgreSQL](https://www.postgresql.org/) / [SQLite](https://www.sqlite.org/) | PostgreSQL untuk produksi (Supabase) dan fleksibel menggunakan SQLite/MySQL untuk lokal. |
| **Pengujian (Testing)** | [Pest PHP](https://pestphp.com/) | Framework testing yang elegan dan ekspresif. |
| **Cloud Hosting** | [Vercel](https://vercel.com/) | Serverless deployment menggunakan runtime `vercel-php@0.9.0`. |
| **Cloud Database** | [Supabase](https://supabase.com/) | Managed PostgreSQL Database dengan Transaction Connection Pooling. |

---

## 💻 Panduan Menjalankan Project (Lokal / Development)

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di komputer lokal Anda:

### 1. Prasyarat Sistem
Pastikan perangkat Anda telah terpasang:
* **PHP** >= 8.3 atau 8.4 (direkomendasikan PHP 8.4/8.5)
* **Composer** (Package manager PHP)
* **Node.js** (v18 ke atas) & **npm**
* Database: **SQLite** (bawaan Laravel, paling mudah) atau **PostgreSQL** / **MySQL**

### 2. Kloning Repositori
```bash
git clone https://github.com/ghozi30/E-Report.git
cd E-Report
```

### 3. Instalasi Dependensi
Instal dependensi PHP dan Node.js:
```bash
# Instal dependensi backend (Composer)
composer install

# Instal dependensi frontend (npm)
npm install
```

### 4. Konfigurasi Environment (`.env`)
Salin file contoh konfigurasi `.env.example`:
```bash
cp .env.example .env
```
Lalu buat kunci enkripsi aplikasi:
```bash
php artisan key:generate
```

> **Tips Cepat Database Lokal:**  
> Untuk development lokal paling cepat tanpa perlu instal software database server, gunakan SQLite:
> ```env
> DB_CONNECTION=sqlite
> ```
> Laravel akan otomatis membuat file `database/database.sqlite`.

### 5. Jalankan Migrasi & Seeder
Buat struktur tabel dan isi akun default:
```bash
php artisan migrate --seed
```

### 6. Jalankan Server Pengembangan
Jalankan server aplikasi beserta Vite:
```bash
# Opsi 1: Menjalankan keduanya sekaligus
composer run dev

# Opsi 2: Menggunakan terminal terpisah
php artisan serve
npm run dev
```

Buka peramban (browser) dan akses: **`http://localhost:8000`**

---

## 🔐 Akun Default untuk Pengujian

Setelah menjalankan `php artisan db:seed`, akun administrator berikut siap digunakan:

* **Role:** Administrator
* **Email:** `admin@ereport.test`
* **Password:** `AdminPassword123!`

*(Untuk akun Warga, Anda dapat mendaftarkan akun baru langsung melalui menu **Daftar** di aplikasi).*

---

## ☁️ Panduan Deployment (Vercel & Supabase)

Proyek ini telah dikonfigurasi agar dapat dideploy ke **Vercel Serverless** dengan database **Supabase PostgreSQL**.

### 1. Struktur Konfigurasi Serverless
* **`vercel.json`**: Menggunakan runtime `vercel-php@0.9.0` (PHP 8.5) serta routing otomatis aset statis via CDN Vercel.
* **`api/index.php`**: Bridge serverless yang mengarahkan path session, view cache, dan storage ke direktori ephemeral `/tmp`.

### 2. Environment Variables di Vercel Dashboard
Tambahkan variabel berikut pada menu **Settings > Environment Variables** di Vercel:

```env
APP_NAME=E-Report
APP_ENV=production
APP_KEY=base64:w54quU33vMXpT6XKuofG+c/SUi7e2QvVt1f9M0zuV7o=
APP_DEBUG=false
APP_URL=https://nama-proyek-anda.vercel.app

DB_CONNECTION=pgsql
DB_HOST=aws-0-ap-southeast-1.pooler.supabase.com
DB_PORT=6543
DB_DATABASE=postgres
DB_USERNAME=postgres.<project-id-supabase>
DB_PASSWORD=<password-supabase-anda>

SESSION_DRIVER=database
CACHE_STORE=database
```

---

## 🧪 Menjalankan Pengujian (Testing)

Proyek ini menggunakan **Pest PHP** untuk pengujian fitur dan unit:
```bash
# Menjalankan seluruh pengujian
php artisan test

# Menjalankan dengan Pest langsung
vendor/bin/pest
```

---

## 📄 Lisensi

Proyek ini merupakan perangkat lunak *open-source* di bawah lisensi [MIT License](LICENSE).
