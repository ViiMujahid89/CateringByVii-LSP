# CateringByVii — Sistem Pemesanan Katering Online

Platform pemesanan katering berbasis web yang komprehensif, memungkinkan pelanggan untuk melakukan pemesanan paket katering secara online dengan alur verifikasi yang terstruktur, mulai dari pendaftaran akun hingga penyelesaian pesanan.

## 🌟 Tentang Proyek

CateringByVii dirancang untuk mempermudah proses bisnis katering dengan digitalisasi. Sistem ini menangani dua peran utama:
1. **Pelanggan:** Memudahkan pengguna dalam memilih paket katering, melakukan pemesanan, mengunggah bukti pembayaran, dan memantau status pesanan mereka.
2. **Admin:** Memberikan kendali penuh atas operasional bisnis, termasuk verifikasi pelanggan baru, manajemen pesanan, validasi pembayaran, dan pengelolaan konten informasi (pengumuman).

## ✅ Fitur Utama Sistem

### 👤 Modul Pelanggan
- **Manajemen Akun:** Pendaftaran akun baru (membutuhkan persetujuan admin sebelum dapat digunakan) dan login yang aman.
- **Katalog Paket:** Menjelajahi berbagai paket katering yang tersedia dilengkapi dengan detail harga dan deskripsi.
- **Pemesanan Interaktif:** Proses pembuatan pesanan dengan kalkulasi harga otomatis berdasarkan jumlah pesanan.
- **Pelacakan Pesanan:** Memantau status pesanan (Pending, Approved, Waiting Payment, Completed) melalui timeline visual yang intuitif.
- **Pembayaran Terintegrasi:** Fasilitas untuk mengunggah bukti pembayaran secara langsung melalui sistem.
- **Pusat Informasi:** Halaman pengumuman interaktif yang mendukung teks, gambar, serta sematan (embed) video YouTube.
- **Dashboard Personal:** Ringkasan aktivitas pesanan, riwayat, dan notifikasi penting.

### 🛡️ Modul Admin (Back-Office)
- **Verifikasi Pengguna:** Menyetujui atau menolak pendaftaran akun pelanggan baru untuk menjaga keamanan dan validitas data.
- **Manajemen Pesanan:** Meninjau dan memvalidasi pesanan yang masuk sebelum diproses lebih lanjut.
- **Validasi Pembayaran:** Memeriksa keabsahan bukti pembayaran yang diunggah pelanggan.
- **Manajemen Konten (Pengumuman):** Menambah, mengubah, atau menghapus pengumuman operasional, mendukung media visual.
- **Dashboard Analitik:** Ringkasan statistik operasional (total pelanggan, pesanan aktif, pendapatan, dll).
- **Notifikasi Real-time:** Sistem badge notifikasi pada panel navigasi untuk tugas-tugas yang membutuhkan tindakan segera.

## 🛠 Tech Stack & Arsitektur

Sistem ini dibangun dengan arsitektur modern menggunakan kerangka kerja dan teknologi berikut:

- **Backend Framework:** Laravel 12 (PHP 8.2) dengan struktur arsitektur MVC (Model-View-Controller).
- **Frontend & Styling:** Tailwind CSS v4 untuk desain responsif dan kustomisasi UI yang cepat, dipadukan dengan Blade Templating.
- **Database:** Relasional database untuk integritas data/MySQL
- **Asset Bundling:** Vite 7 untuk kompilasi dan optimasi aset frontend.
- **Testing:** Diuji menggunakan framework PestPHP v3 untuk memastikan stabilitas fitur.
- **Interaksi UI:** SweetAlert2 v11 untuk memberikan umpan balik (feedback) visual yang menarik kepada pengguna.
- **Manajemen File:** Memanfaatkan sistem penyimpanan lokal (Storage) Laravel.

## 📋 Spesifikasi Sistem & Dependensi

Untuk dapat menjalankan sistem ini, server harus memenuhi spesifikasi minimum berikut:

### Spesifikasi Lingkungan
- **PHP**: Versi `8.2` atau lebih tinggi
- **Composer**: Versi `2.x`
- **Node.js**: Versi `18.x` atau lebih tinggi
- **NPM**: Versi `9.x` atau lebih tinggi
- **RDBMS**: MySQL / MariaDB (kompatibel)

### Dependensi Utama
- **Backend Framework**: Laravel v12.x
- **Frontend Compiler**: Vite v7.x
- **Styling Engine**: Tailwind CSS v4.x
- **UI Alerts / Dialogs**: SweetAlert2 v11.x
- **Testing Framework**: PestPHP v3.x

---

## 🚀 Panduan Instalasi dan Konfigurasi

Berikut adalah langkah-langkah instruksi instalasi lengkap di lingkungan lokal Anda:

1. **Unduh Repositori**
   Lakukan kloning pada repositori ini ke komputer lokal Anda:
   ```bash
   git clone <URL_REPOSITORI_ANDA>
   cd CateringByVii
   ```

2. **Instal Dependensi Backend (PHP)**
   Unduh paket pustaka PHP yang diperlukan menggunakan Composer:
   ```bash
   composer install
   ```

3. **Instal Dependensi Frontend (JavaScript)**
   Unduh paket pustaka frontend menggunakan NPM:
   ```bash
   npm install
   ```

4. **Konfigurasi Variabel Lingkungan (.env)**
   Salin berkas konfigurasi default bawaan Laravel:
   ```bash
   cp .env.example .env
   ```
   *Buka berkas `.env` yang baru dibuat dan sesuaikan kredensial basis data Anda pada parameter `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`.*

5. **Generate Application Key**
   Buat kunci enkripsi aplikasi yang baru:
   ```bash
   php artisan key:generate
   ```

6. **Migrasi Database & Seeding Data Dummy**
   Jalankan migrasi untuk membangun struktur tabel di database sekaligus mengisi data dummy awal (termasuk akun demo dan paket katering):
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Penautan Direktori Penyimpanan (Storage Symlink)**
   Hubungkan folder penyimpanan file multimedia (bukti transfer, gambar paket, dll) ke direktori publik:
   ```bash
   php artisan storage:link
   ```

8. **Kompilasi Aset Frontend**
   Bangun/kompilasi berkas aset frontend untuk mode produksi:
   ```bash
   npm run build
   ```

9. **Jalankan Server Lokal**
   Nyalakan server pengembangan lokal Laravel:
   ```bash
   php artisan serve
   ```
   *Aplikasi dapat diakses melalui browser pada alamat default: `http://127.0.0.1:8000`.*

---

## 🔑 Akun Demo Pengujian (Seeded Data)

Untuk memudahkan proses pengujian dan penilaian oleh asesor, gunakan data akun pengujian bawaan berikut setelah menjalankan proses *seeding*:

| Peran (Role) | Alamat Email | Kata Sandi (Password) | Status Akun | Deskripsi Uji |
| :--- | :--- | :--- | :--- | :--- |
| **Administrator** | `admin@cateringbyvii.com` | `password` | Aktif (Approved) | Untuk panel verifikasi akun, verifikasi pesanan, pembayaran, dan manajemen pengumuman/paket. |
| **Pelanggan (Demo)** | `pelanggan@cateringbyvii.com` | `password` | Aktif (Approved) | Akun pelanggan aktif untuk langsung mencoba pemesanan paket katering dan melihat menu. |
| **Pelanggan (Pending)**| `siti@example.com` | `password` | Tertunda (Pending) | Akun pelanggan baru terdaftar yang belum disetujui, dapat digunakan untuk simulasi verifikasi oleh Admin. |

---

## 🧪 Rangkaian Pengujian (Testing)

Sistem ini diuji menggunakan framework **PestPHP v3** untuk memastikan keandalan alur transaksi. Anda dapat menjalankan seluruh pengujian otomatis dengan perintah berikut:

```bash
php artisan test --compact
```

---


## 📁 Struktur Direktori Utama

Sistem ini mengadopsi standar struktur direktori Laravel 12 yang ramping:

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/           (Logika Otentikasi & Registrasi)
│   │   ├── Admin/          (Logika Panel Administrasi)
│   │   └── Customer/       (Logika Area Pelanggan)
│   └── Middleware/         (Penyaring Permintaan, misal: CheckRole)
├── Models/                 (Representasi Tabel Basis Data)
database/
├── migrations/             (Skema Basis Data)
├── factories/              (Data Palsu untuk Pengujian)
└── seeders/                (Pengisian Data Awal)
resources/views/
├── layouts/                (Template Dasar UI)
├── auth/                   (Tampilan Otentikasi)
├── admin/                  (Tampilan Back-Office)
└── customer/               (Tampilan Pelanggan)
routes/
└── web.php                 (Pemetaan URL ke Controller)
```

## 🗄 Skema Basis Data (Database Schema)

Sistem ini didukung oleh struktur relasional yang terdiri dari 5 entitas utama:

1. **Users (Pengguna):** Menyimpan kredensial dan informasi profil. Dilengkapi kontrol akses berbasis peran (Admin/Pelanggan) dan penanda status aktifasi akun.
2. **Packages (Paket Katering):** Entitas master untuk produk yang ditawarkan, mencakup detail harga, deskripsi, dan media gambar.
3. **Orders (Pesanan):** Menghubungkan Pengguna dengan Paket. Memiliki siklus hidup (lifecycle) status mulai dari pembuatan hingga penyelesaian.
4. **Payments (Pembayaran):** Melacak jejak pembayaran untuk suatu Pesanan, menyimpan referensi bukti transaksi dan status persetujuan dari Admin.
5. **Announcements (Pengumuman):** Entitas manajemen informasi operasional dengan kapabilitas media teks, gambar, dan tautan video.

## 🌿 Version Control dan Branching

Pengembangan mengikuti standar kontrol versi berikut:

- **Branch Utama:**
  - `main`: Mewakili rilis stabil dan siap produksi.
  - `develop`: Cabang integrasi utama untuk fitur-fitur yang sedang dikembangkan.
- **Konvensi Komit (Conventional Commits):**
  - Menggunakan awalan standar seperti `feat:` (fitur baru), `fix:` (perbaikan bug), `docs:` (pembaruan dokumentasi), dan `refactor:` (restrukturisasi kode).

## 📜 Lisensi

Proyek ini dikembangkan secara spesifik untuk memenuhi persyaratan uji kompetensi pada Lembaga Sertifikasi Profesi (LSP). Hak cipta dan penggunaan tunduk pada ketentuan instansi terkait.
