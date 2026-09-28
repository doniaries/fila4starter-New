<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Home Route
|--------------------------------------------------------------------------
*/

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('switch.language');

Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

Route::get('/', \App\Livewire\Home::class)->name('home');

/*
|--------------------------------------------------------------------------
| Dinas Routes (Government Office)
|--------------------------------------------------------------------------
| Routes for government office content: news, announcements, documents, etc.
*/
Route::prefix('')->name('')->group(function () {
    // Berita (News)
    Route::get('/berita', \App\Livewire\BeritaIndex::class)->name('berita.index');
    Route::get('/berita/{post}', \App\Livewire\BeritaDetail::class)->name('berita.show');

    // Kategori (Categories)
    Route::get('/kategori', \App\Livewire\CategoryIndex::class)->name('kategori.index');

    // Pengumuman (Announcements)
    Route::get('/pengumuman', \App\Livewire\PengumumanIndex::class)->name('pengumuman.index');
    Route::get('/pengumuman/{pengumuman:slug}', \App\Livewire\PengumumanDetail::class)->name('pengumuman.show');

    // Agenda Kegiatan (Events)
    Route::get('/agenda', \App\Livewire\AgendaKegiatan::class)->name('agenda.index');
    Route::get('/agenda/{agenda}', \App\Livewire\AgendaDetail::class)->name('agenda.show');

    // Data
    Route::get('/data', \App\Livewire\Dinas\DataIndex::class)->name('data.index');
    Route::get('/data/{slug}', \App\Livewire\Dinas\DataDetail::class)->name('data.show');

    // Galeri Kegiatan (Gallery)
    Route::get('/galeri', \App\Livewire\GalleryIndex::class)->name('galeri.index');
    Route::get('/galeri/{gallery:slug}', \App\Livewire\GalleryDetail::class)->name('galeri.show');

    // Ekraf
    Route::get('/ekraf', \App\Livewire\EkrafIndex::class)->name('ekraf.index');
    Route::get('/ekraf/{ekraf:slug}', \App\Livewire\EkrafDetail::class)->name('ekraf.show');

    // Struktur Organisasi (Organization Structure)
    Route::get('/struktur-organisasi', \App\Livewire\StrukturOrganisasi::class)->name('struktur-organisasi');

    // Sambutan Pimpinan (Leadership Message)
    Route::get('/sambutan-pimpinan', \App\Livewire\SambutanPimpinan::class)->name('sambutan-pimpinan');
});
