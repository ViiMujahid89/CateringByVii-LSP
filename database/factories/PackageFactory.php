<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Package>
 */
class PackageFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $packages = [
            ['name' => 'Paket Bronze', 'price' => 500000, 'desc' => 'Paket katering hemat untuk 50 orang. Termasuk nasi, lauk 2 pilihan, sayur, dan minuman.'],
            ['name' => 'Paket Silver', 'price' => 1000000, 'desc' => 'Paket katering menengah untuk 100 orang. Menu lengkap dengan prasmanan 3 lauk, 2 sayur, dan dessert.'],
            ['name' => 'Paket Gold', 'price' => 2500000, 'desc' => 'Paket premium untuk 200 orang. Termasuk chef on-site, dekorasi meja makan, dan 5 pilihan menu utama.'],
            ['name' => 'Paket Platinum', 'price' => 5000000, 'desc' => 'Paket eksklusif untuk 500 orang. Full service dengan tim katering profesional, dekorasi, dan dokumentasi.'],
            ['name' => 'Paket Snack Box', 'price' => 35000, 'desc' => 'Snack box per kotak minimum order 20 pcs. Berisi 3 jenis kue tradisional, risoles mayo, dan minuman kotak. Cocok untuk rapat kantor, seminar, dan acara formal singkat.'],
            ['name' => 'Paket Lunch Box', 'price' => 50000, 'desc' => 'Nasi box per kotak minimum order 20 pcs. Nasi putih dengan lauk pilihan (ayam geprek/rendang/ikan bakar), sambal, lalapan, dan kerupuk. Cocok untuk makan siang kantor.'],
            ['name' => 'Paket Nongki Box', 'price' => 65000, 'desc' => 'Paket santai untuk hangout & gathering kecil minimum order 15 pcs. Berisi nasi, ayam goreng rempah, kentang mustofa, puding susu, dan minuman segar. Cocok untuk arisan, reunian, atau nongkrong bareng.'],
            ['name' => 'Paket Kerja Box', 'price' => 55000, 'desc' => 'Paket praktis untuk meeting & work session minimum order 10 pcs. Nasi putih, lauk utama pilihan, tumis sayuran, tempe goreng, kerupuk, dan air mineral. Energi penuh untuk produktivitas kerja seharian.'],
        ];

        $package = fake()->randomElement($packages);

        return [
            'name' => $package['name'],
            'description' => $package['desc'],
            'price' => $package['price'],
            'image' => null,
            'is_active' => true,
        ];
    }
}
