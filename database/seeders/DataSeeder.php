<?php

namespace Database\Seeders;

use App\Models\Data;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DataSeeder extends Seeder
{
    public function run()
    {
        // Create common categories
        $kategoriUmum = \App\Models\KategoriData::firstOrCreate(
            ['slug' => 'umum'],
            ['nama' => 'Umum']
        );
        $kategoriKeuangan = \App\Models\KategoriData::firstOrCreate(
            ['slug' => 'keuangan'],
            ['nama' => 'Keuangan']
        );

        $dataData = [
            ['judul' => 'RKA Dinas Pariwisata, Pemuda dan Olahraga Tahun 2024', 'tahun' => '2024', 'kategori' => $kategoriKeuangan->id],
            ['judul' => 'RKA Dinas Pariwisata, Pemuda dan Olahraga 2024', 'tahun' => '2024', 'kategori' => $kategoriKeuangan->id],
            ['judul' => 'Sijunjung Dalam Angka 2023', 'tahun' => '2023', 'kategori' => $kategoriUmum->id],
            ['judul' => 'Laporan Realisasi Anggaran Dinas Pariwisata, Pemuda dan Olahraga 2023', 'tahun' => '2023', 'kategori' => $kategoriKeuangan->id],
            ['judul' => 'Profil Pariwisata Kabupaten Sijunjung 2023', 'tahun' => '2023', 'kategori' => $kategoriUmum->id],
        ];

        // Create documents
        foreach ($dataData as $data) {
            // Generate a unique slug
            $slug = Str::slug($data['judul']);

            // Check if document with this slug already exists
            if (!Data::where('slug', $slug)->exists()) {

                // Create document with model's fillable fields
                Data::create([
                    'nama_data' => $data['judul'],
                    'slug' => $slug,
                    'deskripsi' => 'Deskripsi untuk ' . $data['judul'],
                    'cover' => 'cover-' . Str::slug($data['judul']) . '.jpg',
                    // 'file' => 'data/' . Str::random(10) . '.pdf',
                    'kategori_data_id' => $data['kategori'],
                    'is_public' => true,
                    'tahun_terbit' => $data['tahun'],
                    'views' => rand(0, 1000),
                    'downloads' => rand(0, 500),
                    'published_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
