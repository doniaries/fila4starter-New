<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\User;
use App\Models\Data;
use App\Models\Pengumuman;
use App\Models\AgendaKegiatan;
use App\Models\Gallery;
use App\Models\Layanan;
use App\Models\Infografis;
use App\Models\Visit;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Berita', Post::count())
                ->description('Jumlah berita yang dipublikasikan')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('Total Pengumuman', Pengumuman::count())
                ->description('Jumlah pengumuman')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('warning')
                ->chart([3, 5, 4, 6, 7, 5, 6, 8]),

            Stat::make('Total Agenda', AgendaKegiatan::count())
                ->description('Jumlah agenda kegiatan')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info')
                ->chart([5, 4, 6, 5, 7, 6, 8, 7]),

            Stat::make('Total Data', Data::count())
                ->description('Jumlah data tersedia')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')
                ->chart([4, 6, 5, 7, 6, 8, 7, 9]),

            Stat::make('Total Pengguna', User::count())
                ->description('Jumlah pengguna terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('danger')
                ->chart([2, 3, 4, 3, 5, 4, 6, 5]),

            Stat::make('Total Galeri', Gallery::count())
                ->description('Jumlah foto & video')
                ->descriptionIcon('heroicon-m-photo')
                ->color('success'),

            Stat::make('Total Layanan', Layanan::count())
                ->description('Jumlah layanan public')
                ->descriptionIcon('heroicon-m-rectangle-group')
                ->color('warning'),

            Stat::make('Total Infografis', Infografis::count())
                ->description('Jumlah infografis')
                ->descriptionIcon('heroicon-m-presentation-chart-line')
                ->color('info'),

            Stat::make('Total Kunjungan', Visit::count())
                ->description('Total pengunjung website')
                ->descriptionIcon('heroicon-m-chart-bar-square')
                ->color('primary'),
        ];
    }
}
