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
            ['name' => 'Paket Snack Box', 'price' => 150000, 'desc' => 'Snack box per 10 pcs untuk rapat atau acara kecil. Berisi 3 jenis kue dan minuman.'],
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
