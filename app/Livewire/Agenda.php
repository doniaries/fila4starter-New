<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use App\Models\AgendaKegiatan;

// #[Lazy]
class Agenda extends Component

{


    public function placeholder()
    {
        return view('livewire.skeletons.agendas');
    }

    public function render()
    {
        $agendas = \Illuminate\Support\Facades\Cache::rememberForever('home_agendas', function () {
            return AgendaKegiatan::query()
                ->select('id', 'nama_agenda', 'slug', 'tempat', 'penyelenggara', 'status', 'dari_tanggal', 'sampai_tanggal', 'waktu_mulai', 'waktu_selesai')
                ->where('dari_tanggal', '>=', now()->toDateString())
                ->orderBy('dari_tanggal')
                ->orderBy('waktu_mulai')
                ->take(7)
                ->get();
        });

        return view('livewire.agenda', [
            'agendas' => $agendas,
        ]);
    }
}
