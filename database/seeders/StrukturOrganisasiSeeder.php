<?php

namespace Database\Seeders;

use App\Models\StrukturOrganisasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StrukturOrganisasiSeeder extends Seeder
{
    public function run()
    {
        $structures = [
            // Pimpinan Tertinggi
            [
                'name' => 'Kepala Dinas',
                'description' => 'Pimpinan Tertinggi Dinas Komunikasi dan Informatika',
                'pimpinan' => 'Afrineldi, SH',
            ],
            // Sekretariat
            [
                'name' => 'Sekretariat',
                'description' => 'Administrasi Dinas, meliputi perencanaan dan pelaporan, keuangan dan aset, kepegawaian, umum.',
                'pimpinan' => 'Bayu Rakhmana, S.STP, M.H',
            ],
            [
                'name' => 'Sub Bagian Tata Usaha',
                'description' => 'Bagian dari Sekretariat yang mengurus ketatausahaan.',
                'pimpinan' => 'Hj. Astria Priantie, S.E., M.M.',
            ],
            // Bidang-Bidang
            [
                'name' => 'E-Government',
                'description' => 'Tata kelola pemerintahan berbasis elektronik, meliputi tata kelola, pengelolaan infrastruktur, dan layanan.',
                'pimpinan' => 'H. Mark Aditya, S.E., M.T.',
            ],
            [
                'name' => 'Aplikasi Informatika',
                'description' => 'Rekayasa aplikasi, integrasi dan interoperabilitas, dan pengelolaan aplikasi.',
                'pimpinan' => 'Dian Istanti, S.Sos., M.A.P.',
            ],
            [
                'name' => 'Informasi Komunikasi Publik',
                'description' => 'Pengolahan dan penyediaan informasi, komunikasi publik dan kehumasan, serta kemitraan komunikasi.',
                'pimpinan' => 'Nidar Nadrotan Naim Sujana, S.T., M.T.',
            ],
            [
                'name' => 'Persandian dan Keamanan Informasi',
                'description' => 'Persandian, keamanan informasi, serta layanan keamanan informasi.',
                'pimpinan' => 'Asep Denny Surbakti, S.T., M.T.',
            ],
            [
                'name' => 'Statistik',
                'description' => 'Kompilasi data, pengolahan data, serta penyajian data.',
                'pimpinan' => 'Indah Lesmini, S.Si.',
            ],
            // UPTD
            [
                'name' => 'Unit Pelayanan Teknis Daerah (UPTD)',
                'description' => 'Pusat Layanan Digital, Data, dan Informasi Geospasial.',
                'pimpinan' => 'Rizki Hustinisari, S.T., M.T.',
            ],
            [
                'name' => 'Sub Bagian Tata Usaha UPTD',
                'description' => 'Bagian administrasi Unit Pelayanan Teknis Daerah.',
                'pimpinan' => 'Gustiman, S.Sos.',
            ],
        ];

        foreach ($structures as $data) {
            StrukturOrganisasi::firstOrCreate(
                ['name' => $data['name']],
                [
                    'description' => $data['description'],
                    'pimpinan' => $data['pimpinan'],
                    'slug' => Str::slug($data['name']),
                ]
            );
        }
    }
}
