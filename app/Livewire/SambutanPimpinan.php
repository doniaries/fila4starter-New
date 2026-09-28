<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use App\Models\SambutanPimpinan as SambutanPimpinanModel;

// #[Lazy]
class SambutanPimpinan extends Component
{
    public function render()
    {
        $sambutan = \Illuminate\Support\Facades\Cache::remember('sambutan_pimpinan', 60 * 60, function () {
            return SambutanPimpinanModel::first();
        });
        
        $pengaturan = \Illuminate\Support\Facades\Cache::remember('app_settings', 60 * 60, function () {
            return \App\Models\Pengaturan::first();
        });

        return view('livewire.dinas.sambutan-pimpinan', [
            'sambutan' => $sambutan,
            'pengaturan' => $pengaturan,
            'pageTitle' => 'Sambutan Pimpinan',
            'pageDescription' => 'Sambutan Pimpinan ' . ($pengaturan->name ?? 'Dinas Komunikasi dan Informatika'),
        ]);
    }

    public function placeholder()
    {
        return view('livewire.skeletons.dinas.sambutan-pimpinan');
    }
}
