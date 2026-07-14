# CateringByVii — Sistem Pemesanan Katering Online

Platform pemesanan katering berbasis web yang memungkinkan pelanggan memesan paket katering secara online dengan alur verifikasi yang terstruktur.

## ✅ Fitur Utama

### Pelanggan
- [x] Daftar akun (status menunggu verifikasi admin)
- [x] Login dengan pemeriksaan status akun
- [x] Melihat dan memilih paket katering
- [x] Membuat pesanan dengan kalkulasi harga otomatis
- [x] Melihat status pesanan dengan timeline visual
- [x] Upload bukti pembayaran (gambar)
- [x] Melihat pengumuman (termasuk embed video YouTube)
- [x] Dashboard personal dengan statistik pesanan

### Admin
- [x] Login ke panel administrasi
- [x] Verifikasi pendaftaran akun (setujui/tolak)
- [x] Verifikasi pesanan (setujui/tolak)
- [x] Verifikasi pembayaran (setujui/tolak + lihat bukti)
- [x] Kelola pengumuman (CRUD) dengan gambar dan video URL
- [x] Dashboard statistik (total user, pesanan, dll)
- [x] Badge notifikasi di sidebar untuk item pending

## 🛠 Tech Stack

| Komponen | Teknologi |
|---|---|
| Backend Framework | Laravel 12 (PHP 8.2) |
| Frontend CSS | Tailwind CSS v4 + Custom CSS |
| Database | MySQL |
| Build Tool | Vite 7 |
| Testing | PestPHP v3 |
| Alert | SweetAlert2 v11 (CDN) |
| Storage | Laravel Storage (public disk) |

## 📋 Spesifikasi Sistem

- PHP >= 8.2
- Composer >= 2.x
- Node.js >= 18.x & NPM >= 9.x
- MySQL >= 8.0

## 🚀 Panduan Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/ViiMujahid89/CateringByVii.git
cd CateringByVii
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_catering
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Setup Database

```bash
php artisan migrate --seed
```

### 5. Setup Storage

```bash
php artisan storage:link
```

### 6. Build Frontend Assets

```bash
npm run build
# atau untuk development:
npm run dev
```

### 7. Jalankan Server

```bash
php artisan serve
# atau jalankan semua sekaligus:
composer run dev
```

Akses aplikasi di: **http://localhost:8000**

## 📁 Struktur Folder

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/           (LoginController, RegisterController)
│   │   ├── Admin/          (Dashboard, UserVerification, Order, Payment, Announcement)
│   │   └── Customer/       (Dashboard, Package, Order, Payment, Announcement)
│   └── Middleware/
│       └── CheckRole.php
├── Models/                 (User, Package, Order, Payment, Announcement)
database/
├── migrations/             (5 tabel utama + default Laravel)
├── factories/              (User, Package, Announcement)
└── seeders/                (DatabaseSeeder)
resources/views/
├── layouts/                (admin.blade.php, app.blade.php)
├── auth/                   (login, register, pending)
├── admin/                  (dashboard, users, orders, payments, announcements)
└── customer/               (dashboard, packages, orders, payments, announcements)
routes/
└── web.php                 (34 routes: public, auth, customer, admin)
```

## 👤 Akun Demo

Setelah menjalankan `php artisan migrate --seed`:

| Role | Email | Password |
|---|---|---|
| Admin | admin@cateringbyvii.com | password |
| Pelanggan | pelanggan@cateringbyvii.com | password |

## 🗄 Skema Database

5 tabel utama:
- **users** — dengan kolom `role` (admin/pelanggan) dan `status` (pending/approved/rejected)
- **packages** — paket katering dengan harga dan gambar
- **orders** — pesanan dengan status flow: pending → approved → waiting_payment → completed
- **payments** — bukti pembayaran dengan verifikasi admin
- **announcements** — pengumuman dengan dukungan gambar dan embed video YouTube

## 🌿 Version Control

**Branch strategy:**
- `main` — branch stabil (production-ready)
- `develop` — integrasi fitur
- `feature/*` — pengembangan fitur per modul

**Conventional commits:**
- `feat:` — fitur baru
- `fix:` — perbaikan bug
- `docs:` — dokumentasi
- `refactor:` — refaktor kode

## 📜 Lisensi

Project ini dibuat untuk keperluan LSP (Lembaga Sertifikasi Profesi).
