<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Pengumuman;
use App\Models\AgendaKegiatan;
use App\Models\Gallery;

class SitemapController extends Controller
{
    public function index()
    {
        // 1. Static URLs (Halaman Utama/Dasar)
        $urls = [
            url('/'),
            url('/berita'),
            url('/kategori'),
            url('/pengumuman'),
            url('/agenda'),
            url('/data'),
            url('/galeri'),
            url('/struktur-organisasi'),
            url('/sambutan-pimpinan'),
        ];

        $sitemapItems = collect();

        foreach ($urls as $url) {
            $sitemapItems->push([
                'url' => $url,
                'lastmod' => now()->tz('UTC')->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '1.0'
            ]);
        }

        // 2. Dynamic URLs: Berita
        $posts = Post::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($posts as $post) {
            $sitemapItems->push([
                'url' => route('berita.show', $post->slug),
                'lastmod' => $post->updated_at->tz('UTC')->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.8'
            ]);
        }

        // 3. Dynamic URLs: Pengumuman
        $pengumumans = Pengumuman::orderBy('created_at', 'desc')->get();

        foreach ($pengumumans as $pengumuman) {
            $sitemapItems->push([
                'url' => route('pengumuman.show', $pengumuman->slug),
                'lastmod' => $pengumuman->updated_at->tz('UTC')->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ]);
        }

        // 4. Dynamic URLs: Agenda
        $agendas = AgendaKegiatan::orderBy('created_at', 'desc')->get();

        foreach ($agendas as $agenda) {
            $sitemapItems->push([
                'url' => route('agenda.show', $agenda->id), // Agenda menggunakan ID
                'lastmod' => $agenda->updated_at->tz('UTC')->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ]);
        }

        // 5. Dynamic URLs: Galeri
        $galleries = Gallery::whereNotNull('published_at')->orderBy('created_at', 'desc')->get();

        foreach ($galleries as $gallery) {
            $sitemapItems->push([
                'url' => route('galeri.show', $gallery->slug),
                'lastmod' => $gallery->updated_at->tz('UTC')->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.6'
            ]);
        }

        return response()->view('sitemap.index', [
            'sitemapItems' => $sitemapItems
        ])->header('Content-Type', 'text/xml');
    }
}
