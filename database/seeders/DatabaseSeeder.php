<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin account
        $admin = User::create([
            'name' => 'Admin CateringByVii',
            'email' => 'admin@cateringbyvii.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'approved',
            'phone' => '081234567890',
            'address' => 'Jl. Katering No. 1, Jakarta',
        ]);

        // Demo pelanggan account (approved)
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'pelanggan@cateringbyvii.com',
            'password' => Hash::make('password'),
            'role' => 'pelanggan',
            'status' => 'approved',
            'phone' => '082345678901',
            'address' => 'Jl. Merdeka No. 10, Bandung',
        ]);

        // Additional pending pelanggan
        User::factory()->pelanggan()->pending()->create([
            'name' => 'Siti Rahayu',
            'email' => 'siti@example.com',
        ]);

        // Additional dummy pelanggan
        User::factory()->pelanggan()->count(3)->create();

        // Catering packages
        $packages = [
            [
                'name' => 'Paket Bronze',
                'description' => 'Paket katering hemat untuk 50 orang. Termasuk nasi putih, lauk 2 pilihan (ayam/ikan), sayur tumis, kerupuk, dan minuman teh manis. Cocok untuk arisan dan pertemuan keluarga kecil.',
                'price' => 500000,
                'is_active' => true,
            ],
            [
                'name' => 'Paket Silver',
                'description' => 'Paket katering menengah untuk 100 orang. Menu lengkap prasmanan dengan 3 pilihan lauk (daging sapi, ayam, ikan), 2 jenis sayur, es buah, dan dessert. Cocok untuk ulang tahun dan pernikahan kecil.',
                'price' => 1200000,
                'is_active' => true,
            ],
            [
                'name' => 'Paket Gold',
                'description' => 'Paket premium untuk 200 orang. Termasuk chef on-site, dekorasi meja prasmanan, 5 pilihan menu utama, 3 jenis dessert, dan minuman lengkap. Cocok untuk pernikahan dan acara perusahaan.',
                'price' => 2800000,
                'is_active' => true,
            ],
            [
                'name' => 'Paket Platinum',
                'description' => 'Paket eksklusif untuk 500 orang. Full service dengan tim katering profesional 10 orang, dekorasi premium, menu internasional & lokal, dan dokumentasi acara. Harga sudah termasuk sewa peralatan.',
                'price' => 5500000,
                'is_active' => true,
            ],
            [
                'name' => 'Paket Snack Box',
                'description' => 'Snack box per kotak minimum order 20 pcs. Berisi 3 jenis kue tradisional, risoles mayo, dan minuman kotak. Cocok untuk rapat kantor, seminar, dan acara formal singkat.',
                'price' => 35000,
                'is_active' => true,
            ],
            [
                'name' => 'Paket Nasi Box',
                'description' => 'Nasi box per kotak minimum order 20 pcs. Nasi putih dengan lauk pilihan (ayam geprek/rendang/ikan bakar), sambal, lalapan, dan kerupuk. Cocok untuk makan siang kantor.',
                'price' => 50000,
                'is_active' => true,
            ],
        ];

        foreach ($packages as $packageData) {
            Package::create($packageData);
        }

        // Announcements
        $announcements = [
            [
                'created_by' => $admin->id,
                'title' => 'Selamat Datang di CateringByVii!',
                'content' => "Kami dengan bangga memperkenalkan platform pemesanan katering online CateringByVii.\n\nKini Anda dapat memesan paket katering favorit Anda dengan mudah, cepat, dan terpercaya. Nikmati berbagai pilihan paket mulai dari snack box hingga paket prasmanan eksklusif untuk 500 orang.\n\nJangan ragu untuk menghubungi kami jika ada pertanyaan. Tim kami siap membantu 24 jam!",
                'image' => null,
                'video_url' => null,
            ],
            [
                'created_by' => $admin->id,
                'title' => 'Promo Spesial Hari Kemerdekaan — Diskon 17%!',
                'content' => "Rayakan Hari Kemerdekaan Indonesia bersama CateringByVii!\n\nDapatkan diskon spesial 17% untuk semua paket katering yang dipesan pada bulan Agustus. Berlaku untuk minimum order Paket Silver ke atas.\n\nGunakan kode promo: MERDEKA17 saat melakukan pemesanan. Penawaran terbatas, segera pesan sebelum kehabisan!",
                'image' => null,
                'video_url' => null,
            ],
            [
                'created_by' => $admin->id,
                'title' => 'Menu Baru: Paket Nasi Box Tersedia!',
                'content' => "Kami menambahkan menu terbaru: Paket Nasi Box!\n\nNasi box per kotak dengan minimum order 20 pcs. Pilihan lauk: ayam geprek, rendang, atau ikan bakar — semua disajikan dengan nasi putih pulen, sambal khas, lalapan segar, dan kerupuk renyah.\n\nHarga terjangkau mulai dari Rp 50.000 per kotak. Cocok untuk makan siang kantor dan acara formal.",
                'image' => null,
                'video_url' => null,
            ],
        ];

        foreach ($announcements as $announcementData) {
            Announcement::create($announcementData);
        }
    }
}
