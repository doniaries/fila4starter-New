<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PelakuEkraf;

class EkrafDetail extends Component
{
    public PelakuEkraf $ekraf;

    public function mount(PelakuEkraf $ekraf)
    {
        abort_if(!$ekraf->is_active, 404);
        
        $this->ekraf = $ekraf->load('KategoriEkraf');
    }

    public function render()
    {
        // Get related pelaku
        $relatedPelaku = PelakuEkraf::where('is_active', true)
            ->where('bidang_ekraf_id', $this->ekraf->bidang_ekraf_id)
            ->where('id', '!=', $this->ekraf->id)
            ->latest()
            ->take(3)
            ->get();

        return view('livewire.ekraf-detail', [
            'relatedPelaku' => $relatedPelaku
        ]);
    }
}
