# LBH Punggawa Keadilan - Sistem Informasi & Profil

Repository ini berisi kode sumber untuk sistem informasi dan website profil **Lembaga Bantuan Hukum (LBH) Punggawa Keadilan**.

Proyek ini dibagi menjadi dua bagian utama:
1. **Frontend**: Website Single Page Application (SPA) yang dibangun menggunakan Vite, Vanilla JS, dan Tailwind CSS (v4).
2. **Backend**: API dan sistem manajemen (CMS) menggunakan framework Laravel.

## Struktur Direktori

- `/frontend/` - Berisi kode sumber antarmuka publik (HTML, CSS, JS).
- `/backend-laravel/` - Berisi kode sumber backend, database, dan REST API.

## Cara Menjalankan Frontend (Lokal)

Pastikan Anda sudah menginstal **Node.js** di sistem Anda.

1. Buka terminal dan masuk ke folder frontend:
   ```bash
   cd frontend
   ```
2. Instal dependensi (hanya perlu dilakukan sekali):
   ```bash
   npm install
   ```
3. Jalankan server development:
   ```bash
   npm run dev
   ```
4. Buka browser dan akses `http://localhost:5173`.

## Fitur Utama Frontend

- **Single Page Application (SPA)**: Navigasi antar halaman sangat cepat tanpa loading ulang halaman utuh, menggunakan sistem router kustom berbasis Hash.
- **Desain Modern & Profesional**: Menggunakan Tailwind CSS dengan desain *hero banner solid* yang elegan (terinspirasi dari JDIH) dan layout yang bersih.
- **Responsif**: Tampilan optimal di HP, tablet, maupun layar besar desktop.
- **Komponen Interaktif**: Slider (carousel) dinamis untuk menampilkan Galeri Kegiatan dan Profil Tim Advokat, serta modal lightbox untuk melihat foto ukuran penuh.

## Cara Menjalankan Backend (Lokal)

Pastikan Anda sudah menginstal **PHP** (minimal v8.1/v8.2) dan **Composer**.

1. Buka terminal dan masuk ke folder backend:
   ```bash
   cd backend-laravel
   ```
2. Instal dependensi PHP:
   ```bash
   composer install
   ```
3. Salin file environment:
   ```bash
   cp .env.example .env
   ```
4. Generate key aplikasi:
   ```bash
   php artisan key:generate
   ```
5. Sesuaikan pengaturan database (`DB_DATABASE`, `DB_USERNAME`, dll) di file `.env`, lalu jalankan migrasi:
   ```bash
   php artisan migrate
   ```
6. Jalankan server lokal:
   ```bash
   php artisan serve
   ```

---
&copy; 2026 LBH Punggawa Keadilan. Hak Cipta Dilindungi Undang-Undang.
