<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AgendaKegiatan;

class AgendaDetail extends Component
{
    public AgendaKegiatan $agenda;

    public function mount(AgendaKegiatan $agenda)
    {
        $this->agenda = $agenda;
    }

    public function render()
    {
        return view('livewire.dinas.agenda-detail', [
            'pageTitle' => $this->agenda->nama_agenda,
        ]);
    }

    public function placeholder()
    {
        return view('livewire.skeletons.dinas.agenda-detail');
    }
}
