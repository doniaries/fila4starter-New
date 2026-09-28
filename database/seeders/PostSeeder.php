<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Seeding posts from SQL data...');

        // Hapus semua post lama
        Post::query()->delete();

        // Get user ID 5 (Afrineldi) atau fallback ke user pertama
        $userId = User::find(5)?->id ?? User::first()?->id ?? 1;

        $posts = [
            [
                'title' => 'Disparpora Sijunjung Ajak Wisatawan Kunjungi Bukik Ponggang',
                'slug' => 'disparpora-sijunjung-ajak-wisatawan-kunjungi-bukik-ponggang',
                'content' => '<p><a target="_blank" rel="noopener noreferrer nofollow" href="http://RRI.CO.ID">RRI.CO.ID</a>, Padang: Pemerintah Kabupaten Sijunjung terus mengajak untuk mengunjungi wisata Bukik Ponggang di Desa Kampung Baru, Kecamatan Kupitan, Kabupaten Sijunjung. Sebab, kawasan wisata tersebut menawarkan pengalaman wisata yang berbeda dibandingkan destinasi lainnya di Sumatera Barat.</p><p>Kepala Dinas Pariwisata, Pemuda, dan Olahraga (Disparpora) Kabupaten Sijunjung, Afrineldi, Jumat (30/1/2026) mengajak masyarakat untuk berkunjung ke Desa Wisata Bukik Ponggang yang memiliki potensi besar menjadi ikon pariwisata di Kabupaten Sijunjung. Bukit Ponggang menawarkan pengalaman wisata yang berbeda dibandingkan destinasi lainnya di Sumatera Barat. <br>&quot;Salah satu daya tarik utama yang dimiliki diantaranya spot swafoto berbahan kaca yang memberikan sensasi tersendiri bagi para pengunjung. Keunikan dimaksud diharapkan mampu menarik minat wisatawan lokal maupun luar daerah untuk datang dan menikmati keindahan alam Desa Wisata Kampung Baru,&quot; kata Afrineldi.</p><p>Afineldi menyampaikan saat ini Bukik Pongang telah ramai dikunjungi masyarakat sehingga hal itu akan menjadikan Bukit Ponggang sebagai destinasi wisata unggulan. Sebab, dukungan dari masyarakat dinilai penting dalam mengembangkan desa wisata agar semakin dikenal luas.<br>&quot;Dengan potensi alam dan inovasi destinasi yang dimiliki, harapannya wisata Bukik Ponggang dapat memberikan dampak positif terhadap perekonomian masyarakat setempat serta mendukung pengembangan sektor pariwisata di Kabupaten Sijunjung,&quot; ujarnya.<br></p>',
                'source_link' => 'https://rri.co.id/wisata/2148480/disparpora-sijunjung-ajak-wisatawan-kunjungi-bukik-ponggang',
                'foto_utama' => 'posts/01KGRKHRWY0JD05NHV25GTFRQ4.jpg',
                'caption_foto_utama' => 'Kadis Parpora, Afrineldi, SH',
                'gallery' => json_encode([['image' => 'posts/galleries/01KGRKF0PA9V0PJZP83NQN13X9.png', 'caption' => 'Suasana Bukik Ponggang']]),
                'user_id' => $userId,
                'status' => 'published',
                'published_at' => Carbon::parse('2026-02-06 11:20:37'),
                'views' => 123,
                'is_featured' => 1,
            ],
            [
                'title' => 'Festival Lansek Manih IV, Sediakan Stan Gratis Bagi 50 Pelaku Usaha Kreatif di Kabupaten Sijunjung',
                'slug' => 'festival-lansek-manih-iv-sediakan-stan-gratis-bagi-50-pelaku-usaha-kreatif-di-kabupaten-sijunjung',
                'content' => '<p>Pemerintah Kabupaten (Pemkab) Sijunjung, menyediakan stan gratis bagi 50 orang pelaku usaha kratif pada gelaran Festival Lansek Manih IV, dalam rangka Hari Jadi ke-73 Kabupaten Sijunjung, Sumatera Barat (Sumbar).</p><p style="text-align: justify;">"Hal istimewa pada bazar di Festival Lansek Manih kali ini, kami menyediakan stan gratis bagi 50 orang pelaku usaha kreatif di Kabupaten Sijunjung," ungkap Kepala Dinas Pariwisata, Pemuda dan Olahraga (Kadis Parpora) Kabupaten Sijunjung, Afrineldi saat sitemui <a target="_blank" rel="noopener noreferrer nofollow" href="http://TribunPadang.com">TribunPadang.com</a>, Senin (14/2/2022).</p><p style="text-align: justify;">Ia menjelaskan, pelaku usah kreatif ini merupakan pelaku usaha yang memiliki produk asli dari Kabupaten Sijunjung.</p><p style="text-align: justify;">"Beberapa produk usaha kreatif tersebut seperti tas jali-jali, madu galo-galo dan berbagai produk lainnya, yang merupakan asli dari Kabupaten Sijunjung" sebutnya.</p>',
                'source_link' => null,
                'foto_utama' => 'posts/01KGT1XA18FMJ1NTVTGT4CBY22.jpg',
                'caption_foto_utama' => null,
                'gallery' => json_encode([]),
                'user_id' => $userId,
                'status' => 'published',
                'published_at' => Carbon::parse('2022-02-15 09:59:45'),
                'views' => 0,
                'is_featured' => 0,
            ],
            [
                'title' => 'Penilaian ADWI 2023, Menparekraf Kunjungi Perkampungan Adat Sijunjung',
                'slug' => 'penilaian-adwi-2023-menparekraf-kunjungi-perkampungan-adat-sijunjung',
                'content' => '<p>Menteri Pariwisata dan Ekonomi Kreatif (Menparekraf) Sandiaga Uno mengunjungi Perkampungan Adat Sijunjung pada Sabtu (1/4/23).</p><p style="text-align: justify;">Kunjungan Menparekraf Sandiaga Uno dalam rangka visitasi Perkampungan Adat Sijunjung sebagai nominasi Anugerah Desa Wisata Indonesia (ADWI) 2023.</p><p style="text-align: justify;">Turut mendampingi Wakil Gubernur (Wagub) Audy Joinaldy serta Kadispar Propinsi Sumbar Luhur Budianda.<br>Kehadiran Sandiaga Uno disambut Bupati Sijunjung Benny Dwifa Yuswir, Wabup Iraddatillah, Forkopimda, Sekretaris Daerah Sijunjung, Zefnihan, Kepala OPD terkait, Ketua TP PKK, Ny Riri Benny Dwifa, Wakil Ketua TP-PKK, Ny Donna Iraddatillah.</p><p style="text-align: justify;">&quot;Dalam dua tahun berturut-turut, kita merasakan keindahan alam dari Kabupaten Sijunjung, hari ini kita melihat keragaman dan keunggulan dari Desa Perkampungan Adat Nagari Sijunjung,&quot; ungkap Sandiaga Uno.</p>',
                'source_link' => 'https://infopublik.id/kategori/nusantara/728626/index.html',
                'foto_utama' => 'posts/01KGT22B4NHB9JQG5BJG9V4VXY.jpg',
                'caption_foto_utama' => null,
                'gallery' => json_encode([]),
                'user_id' => $userId,
                'status' => 'published',
                'published_at' => Carbon::parse('2023-04-03 13:02:58'),
                'views' => 423,
                'is_featured' => 1,
            ],
            [
                'title' => 'Menparekraf Resmikan Desa Wisata Perkampungan Adat Sijunjung',
                'slug' => 'menparekraf-resmikan-desa-wisata-perkampungan-adat-sijunjung',
                'content' => '<p>Menteri Pariwisata dan Ekonomi Kreatif (Menparekraf) Sandiaga Salahuddin Uno meresmikan Desa Wisata Perkampungan Adat Sijunjung.</p><p style="text-align: justify;">Peresmian ditandai dengan penandatanganan prasasti Desa Wisata Perkampungan Adat oleh Sandiaga Uno di Nagari Sijunjung, Kecamatan Sijunjung, Kabupaten Sijunjung, Sumatra Barat (Sumbar), Sabtu (1/4/2023).</p><p style="text-align: justify;">Sandiaga meninjau Perkampungan Adat Sijunjung yang lolos 75 besar Anugerah Desa Wisata Indonesia (ADWI) 2023.</p><p style="text-align: justify;">&quot;Dalam dua tahun berturut-turut, kita merasakan keindahan alam dari Kabupaten Sijunjung, hari ini kita melihat keragaman dan keunggulan dari Desa Perkampungan Adat Nagari Sijunjung,&quot; ungkap Sandiaga Uno.</p>',
                'source_link' => 'https://infopublik.id/kategori/nusantara/728628/index.html',
                'foto_utama' => 'posts/01KGT2SSGT2WQZM17DED6SZ3FJ.jpg',
                'caption_foto_utama' => null,
                'gallery' => json_encode([]),
                'user_id' => $userId,
                'status' => 'published',
                'published_at' => Carbon::parse('2023-04-03 14:14:42'),
                'views' => 154,
                'is_featured' => 1,
            ],
            [
                'title' => 'Gunakan Scooter, Sandiaga Uno Sapa Masyarakat Desa Wisata Sijunjung',
                'slug' => 'gunakan-scooter-sandiaga-uno-sapa-masyarakat-desa-wisata-sijunjung',
                'content' => '<p>Menteri Pariwisata dan Ekonomi Kreatif (Menparekraf) Sandiaga Uno menyapa masyarakat yang sedang menjunjung dulang di Desa Wisata Perkampungan Adat Sijunjung, Sabtu (1/4/2023).</p><p style="text-align: justify;">Rombongan disambut permainan musik tradisional kalintuang dan atuak-katuak.</p><p style="text-align: justify;">Selain itu, ia juga melihat 76 rumah gadang yang berjejer rapi sepanjang kurang lebih 3KM.</p><p style="text-align: justify;">Usai menyapa masyarakat, Sandiaga mendengarkan ekspose Desa Wisata Perkampungan Adat.</p>',
                'source_link' => 'https://infopublik.id/kategori/nusantara/728624/gunakan-scooter-sandiaga-uno-sapa-masyarakat-desa-wisata-sijunjung',
                'foto_utama' => 'posts/01KGT30C4DSSGVHFNY2G2R7732.jpg',
                'caption_foto_utama' => null,
                'gallery' => json_encode([]),
                'user_id' => $userId,
                'status' => 'published',
                'published_at' => Carbon::parse('2023-04-01 13:20:18'),
                'views' => 4,
                'is_featured' => 1,
            ],
            [
                'title' => 'Festival Lansek Manih V Resmi Dimulai, Sajikan Pertunjukan Seni dan Bazar UMKM Sijunjung',
                'slug' => 'festival-lansek-manih-v-resmi-dimulai-sajikan-pertunjukan-seni-dan-bazar-umkm-sijunjung',
                'content' => '<p>Festival Lansek Manih V dan Sijunjung Rancak Expo dalam rangka Hari Jadi Ke-74 Kabupaten Sijunjung Resmi Dibuka. Festival Lansek Manih V tersebut, dibuka langsung Bupati Sijunjung Benny Dwifa Yuswir, Sabtu (18/2/2023).</p><p style="text-align: justify;">Benny menyebut, festival tersebut merupakan ajang promosi UMKM Sijunjung sekaligus untuk memberikan hiburan kepada masyarakat.</p><p style="text-align: justify;">&quot;Melalui pergelaran ini, diharapkan semua sektor potensial akan dikemas menjadi sajian yang menarik, seperti pariwisata, keberagaman budaya dan sektor UMKM,&quot; ungkap Benny dalam sambutannya.</p>',
                'source_link' => 'https://infopublik.id/kategori/nusantara/714693/festival-lansek-manih-v-resmi-dimulai-sajikan-pertunjukan-seni-dan-bazar-umkm-sijunjung',
                'foto_utama' => 'posts/01KGT390RSAPM27894XNJKV094.jpeg',
                'caption_foto_utama' => null,
                'gallery' => json_encode([]),
                'user_id' => $userId,
                'status' => 'published',
                'published_at' => Carbon::parse('2023-02-22 13:24:37'),
                'views' => 7,
                'is_featured' => 0,
            ],
            [
                'title' => 'Pemprov Sumbar Tegaskan Dukungan Penuh untuk Geopark Ranah Minang Silokek Jadi Warisan Dunia',
                'slug' => 'pemprov-sumbar-tegaskan-dukungan-penuh-untuk-geopark-ranah-minang-silokek-jadi-warisan-dunia',
                'content' => '<p>Pemerintah Provinsi Sumatera Barat (Pemprov Sumbar) menegaskan komitmen penuh dalam mendukung pengembangan Geopark Ranah Minang Silokek di Kabupaten Sijunjung sebagai kandidat UNESCO Global Geopark (UGGp).</p><p>Wakil Gubernur (Wagub) Sumbar, Vasko Ruseimy, menyampaikan hal itu saat menerima rombongan Bupati Sijunjung, Benny Dwifa Yuswir, di Ruang Temu Wagub, pada Senin (25/8/2025).</p><p>"Pemprov Sumbar mendukung penuh dan siap memfasilitasi apa yang menjadi kebutuhan Pemkab Sijunjung terkait pengembangan Geopark Silokek," ujar Vasko. Hadir mendampingi Wagub, Kepala DPMPTSP Sumbar Luhur Budianda, Kepala Dinas Pariwisata Sumbar Lila Yanwar, serta Kepala Bappeda Sumbar Medi Iswandi.</p>',
                'source_link' => 'https://infopublik.id/kategori/nusantara/934976/pemprov-sumbar-tegaskan-dukungan-penuh-untuk-geopark-ranah-minang-silokek-jadi-warisan-dunia',
                'foto_utama' => 'posts/01KGT7ZCZQDKJN0QY6ME3S0ZQE.jpeg',
                'caption_foto_utama' => null,
                'gallery' => json_encode([]),
                'user_id' => $userId,
                'status' => 'published',
                'published_at' => Carbon::parse('2025-08-25 14:45:26'),
                'views' => 342,
                'is_featured' => 1,
            ],
            [
                'title' => 'Andre Rosiade Resmikan Kawasan Wisata Bukik Ponggang di Sijunjung Sumbar',
                'slug' => 'andre-rosiade-resmikan-kawasan-wisata-bukik-ponggang-di-sijunjung-sumbar',
                'content' => '<p>Sijunjung - Wakil Ketua Komisi VI DPR RI dari Fraksi Gerindra Andre Rosiade meresmikan kawasan wisata Bukik Ponggang di Desa Kampung Baru, Kecamatan Kupitan, Kabupaten Sijunjung, Sumatera Barat. Kawasan wisata Bukik Ponggang ini merupakan bagian dari lokasi kegiatan Berkaul Adat yang dibangun menggunakan Dana Desa 2024.<br>&quot;Bismillahirrahmanirrahim. Kita bersama pak Wabup, pak Wakil Ketua DPRD, pak kepala desa, serta Kadis Pariwisata, Pemuda dan Olahraga. Kita meresmikan kawasan wisata Bukik Ponggang di Desa Kampung Baru, Kecamatan Kupitan Kabupaten Sijunjung, kampung kita,&quot; kata Andre kepada wartawan, Selasa (7/10/2025).<br><br>Pada peresmian tersebut, Andre didampingi Wakil Bupati Sijunjung Iraddatillah, Wakil Ketua DPRD Sijunjung Syahril Syamra, Kadis Pariwisata, Pemuda dan Olahraga Sijunjung Afrineldi dan Kepala Desa Kampung Baru Jalmigus.</p>',
                'source_link' => 'https://news.detik.com/berita/d-8148567/andre-rosiade-resmikan-kawasan-wisata-bukik-ponggang-di-sijunjung-sumbar',
                'foto_utama' => 'posts/01KGTB55AFRBM47FR15NQFJPAG.jpeg',
                'caption_foto_utama' => null,
                'gallery' => json_encode([]),
                'user_id' => $userId,
                'status' => 'published',
                'published_at' => Carbon::parse('2025-10-07 20:40:49'),
                'views' => 247,
                'is_featured' => 1,
            ],
            [
                'title' => 'Car Free Day Dalam Rangka Hari Jadi Kabupaten Sijunjung',
                'slug' => 'car-free-day-dalam-rangka-hari-jadi-kabupaten-sijunjung',
                'content' => '<p>Yuk ikuti dan ramaikan Car Free Day dalam rangka hari jadi Kabupaten Sijunjung yang ke 77 , Minggu 01 Februari 2026. Banyak kegiatan menarik yang bisa sanak ikuti</p>',
                'source_link' => null,
                'foto_utama' => 'posts/01KGW6JQA1JAHVC0MCBX9HEESX.jpg',
                'caption_foto_utama' => null,
                'gallery' => json_encode([]),
                'user_id' => 1, // Admin user
                'status' => 'published',
                'published_at' => Carbon::parse('2026-01-29 20:57:08'),
                'views' => 1,
                'is_featured' => 1,
            ],
        ];

        foreach ($posts as $postData) {
            Post::create($postData);
        }

        $this->command->info('Successfully seeded ' . count($posts) . ' posts!');
    }
}
