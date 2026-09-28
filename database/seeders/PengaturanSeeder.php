<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Pengaturan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create default settings with logo Kabupaten Sijunjung
        $settings = [
            'name' => 'Dinas Pariwisata, Pemuda dan Olahraga',
            'slug' => 'dinas-pariwisata-pemuda-dan-olahraga',
            'kabupaten' => 'Sijunjung',
            'logo' => null, // Logo Kabupaten Sijunjung
            'favicon' => null, // Akan diisi melalui admin
            'kepala_instansi' => 'Afrineldi, SH',
            'jabatan_pimpinan' => 'Kepala Dinas',
            'foto_pimpinan' => null,
            'alamat_instansi' => 'Gedung Bersama, Kabupaten Sijunjung',
            'no_telp_instansi' => '0754-12345',
            'email_instansi' => 'diskominfo@sijunjungkab.go.id',
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'instagram' => 'https://instagram.com',
            'youtube' => 'https://youtube.com',
        ];

        // Create the settings record
        Pengaturan::create($settings);

        $this->command->info('Successfully created settings!');
    }
}
