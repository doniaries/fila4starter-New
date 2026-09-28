<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $galleries = [
            [
                'title' => 'Kegiatan Sosialisasi Literasi Digital',
                'description' => 'Dokumentasi kegiatan sosialisasi literasi digital di Aula Kabupaten Sijunjung yang dihadiri oleh perwakilan OPD dan masyarakat umum.',
                'image_count' => 3
            ],
            [
                'title' => 'Rapat Koordinasi SPBE',
                'description' => 'Rapat koordinasi terkait penerapan Sistem Pemerintahan Berbasis Elektronik (SPBE) di lingkungan Pemkab Sijunjung.',
                'image_count' => 2
            ],
            [
                'title' => 'Upacara Hari Kebangkita Nasional',
                'description' => 'Dokumentasi upacara peringatan Hari Kebangkitan Nasional di lapangan Prof. M. Yamin.',
                'image_count' => 4
            ],
            [
                'title' => 'Kunjungan Kerja ke Diskominfo Sumbar',
                'description' => 'Studi tiru dan kunjungan kerja Dinas Kominfo Sijunjung ke Dinas Kominfo Provinsi Sumatera Barat.',
                'image_count' => 5
            ]
        ];

        foreach ($galleries as $data) {
            $slug = \Illuminate\Support\Str::slug($data['title']);

            // Generate placeholder images
            $images = [];
            for ($i = 1; $i <= $data['image_count']; $i++) {
                $width = 800;
                $height = 600;
                $text = urlencode($data['title'] . " - Image $i");
                $images[] = "https://placehold.co/{$width}x{$height}/EEE/31343C?text={$text}";
            }

            if (!\App\Models\Gallery::where('slug', $slug)->exists()) {
                \App\Models\Gallery::create([
                    'title' => $data['title'],
                    'slug' => $slug,
                    'description' => $data['description'],
                    'images' => $images,
                    'published_at' => now()->subDays(rand(1, 30)),
                ]);
            }
        }
        // Add 15 dummy galleries for pagination testing
        for ($i = 1; $i <= 15; $i++) {
            $title = fake()->sentence(3) . " (Dummy $i)";
            $slug = \Illuminate\Support\Str::slug($title);
            $imageCount = rand(3, 8);
            
            $images = [];
            for ($j = 1; $j <= $imageCount; $j++) {
                $width = 800;
                $height = 600;
                $text = urlencode("Dummy $i - Image $j");
                $images[] = "https://placehold.co/{$width}x{$height}/RANDOM/FFFFFF?text={$text}";
            }

            if (!\App\Models\Gallery::where('slug', $slug)->exists()) {
                \App\Models\Gallery::create([
                    'title' => $title,
                    'slug' => $slug,
                    'description' => fake()->paragraph(),
                    'images' => $images,
                    'published_at' => now()->subDays(rand(1, 100)),
                ]);
            }
        }
    }
}
