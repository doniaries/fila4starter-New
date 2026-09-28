<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ================================================================
        // STARTER PACK — Core Seeders
        // Urutan penting: Shield (roles/permissions) → User
        // ================================================================
        $this->call([
            ShieldSeeder::class, // Roles & permissions
            UserSeeder::class,   // Users: superadmin, admin, member
        ]);

        // ================================================================
        // CONTENT SEEDERS — Dikomentari untuk starter pack
        // Aktifkan sesuai kebutuhan project Anda
        // ================================================================
        // $this->call([
        //     StrukturOrganisasiSeeder::class,
        //     SambutanPimpinanSeeder::class,
        //     PengaturanSeeder::class,
        //     TagSeeder::class,
        //     PostSeeder::class,
        //     InfografisSeeder::class,
        //     AgendaKegiatanSeeder::class,
        //     PengumumanSeeder::class,
        //     DataSeeder::class,
        //     ExternalLinkSeeder::class,
        //     GallerySeeder::class,
        // ]);
    }
}
