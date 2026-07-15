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

## 📋 Prasyarat Sistem

Untuk dapat menjalankan sistem ini, server harus memenuhi spesifikasi minimum berikut:
- PHP versi 8.2 atau lebih tinggi
- Composer versi 2.x
- Node.js versi 18.x dan NPM versi 9.x
- Sistem Manajemen Basis Data (RDBMS) yang kompatibel

## 🚀 Alur Instalasi dan Konfigurasi

Demi keamanan, perintah spesifik dan kredensial lingkungan (environment) tidak disertakan di sini. Namun, langkah-langkah umum untuk menjalankan aplikasi adalah:

1. **Pengunduhan Repositori:** Dapatkan salinan (clone) repositori dari sumber kontrol versi.
2. **Instalasi Dependensi:** Unduh dan pasang dependensi backend (PHP) maupun frontend (Node.js) menggunakan package manager masing-masing.
3. **Konfigurasi Lingkungan:** Buat salinan file konfigurasi bawaan dan sesuaikan kredensial basis data serta pengaturan aplikasi lainnya.
4. **Migrasi Basis Data:** Jalankan migrasi untuk membangun struktur tabel pada basis data, lalu isi data awal menggunakan sistem _seeding_.
5. **Penautan Penyimpanan:** Buat tautan simbolik (symlink) untuk direktori penyimpanan agar berkas yang diunggah dapat diakses publik.
6. **Kompilasi Aset:** Bangun aset frontend untuk mode pengembangan (development) atau produksi (production).
7. **Menjalankan Server:** Hidupkan server pengembangan lokal untuk mengakses aplikasi.

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
