<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            /* 'acara' = Paket Acara, 'box' = Paket Box */
            $table->enum('category', ['acara', 'box'])->default('acara')->after('is_active');
        });

        /* Deteksi otomatis dari nama paket yang sudah ada */
        DB::table('packages')->where('name', 'like', '%Box%')->update(['category' => 'box']);
    }

    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
