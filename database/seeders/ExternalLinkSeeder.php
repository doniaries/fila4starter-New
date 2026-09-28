<?php

namespace Database\Seeders;

use App\Models\ExternalLink;
use Illuminate\Database\Seeder;

class ExternalLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure directory exists
        $path = storage_path('app/public/external-links');
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $links = [
            [
                'nama_link' => 'Dinas Koperasi dan UKM',
                'url' => 'https://kukm.kemendag.go.id/',
                'color' => [59, 130, 246], // Blue
            ],
            [
                'nama_link' => 'Kementerian Koperasi dan UKM',
                'url' => 'https://kemenkopukm.go.id/',
                'color' => [16, 185, 129], // Green
            ],
            [
                'nama_link' => 'Layanan Perizinan Berusaha',
                'url' => 'https://oss.go.id/',
                'color' => [245, 158, 11], // Yellow
            ],
            [
                'nama_link' => 'BPJS Ketenagakerjaan',
                'url' => 'https://www.bpjsketenagakerjaan.go.id/',
                'color' => [239, 68, 68], // Red
            ],
            [
                'nama_link' => 'BPJS Kesehatan',
                'url' => 'https://www.bpjs-kesehatan.go.id/',
                'color' => [139, 92, 246], // Purple
            ],
            [
                'nama_link' => 'Dinas Tenaga Kerja',
                'url' => 'https://disnaker.kemnaker.go.id/',
                'color' => [236, 72, 153], // Pink
            ],
        ];

        foreach ($links as $link) {
            // Create a simple image using GD
            $width = 200;
            $height = 200;
            $image = imagecreatetruecolor($width, $height);

            // Allocate color
            $bgColor = imagecolorallocate($image, $link['color'][0], $link['color'][1], $link['color'][2]);
            imagefill($image, 0, 0, $bgColor);

            // Add text (simple initials)
            $textColor = imagecolorallocate($image, 255, 255, 255);
            $initials = substr($link['nama_link'], 0, 2);
            // Use built-in font for simplicity in seeder
            imagestring($image, 5, $width / 2 - 10, $height / 2 - 10, $initials, $textColor);

            $filename = 'external-link-' . md5($link['url']) . '.png';
            $fullPath = $path . '/' . $filename;

            imagepng($image, $fullPath);
            imagedestroy($image);

            ExternalLink::updateOrCreate(
                ['url' => $link['url']],
                [
                    'nama_link' => $link['nama_link'],
                    'logo' => 'external-links/' . $filename,
                ]
            );
        }
    }
}
