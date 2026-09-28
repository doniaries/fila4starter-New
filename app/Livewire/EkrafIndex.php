<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\PelakuEkraf;
use App\Models\KategoriEkraf;

class EkrafIndex extends Component
{
    use WithPagination;

    #[Url]
    public $bidang = '';

    public function render()
    {
        $query = PelakuEkraf::where('is_active', true)
            ->with(['KategoriEkraf']);

        if ($this->bidang) {
            $query->whereHas('KategoriEkraf', function ($q) {
                $q->where('slug', $this->bidang);
            });
        }

        $pelaku = $query->latest()->paginate(9);

        // Cache bidang for 1 hour
        $bidangList = \Illuminate\Support\Facades\Cache::remember('bidang_ekraf_list', 60 * 60, function () {
            return KategoriEkraf::where('is_active', true)->has('pelakuEkrafs')->withCount('pelakuEkrafs')->get();
        });

        return view('livewire.ekraf-index', [
            'pelaku' => $pelaku,
            'bidangList' => $bidangList
        ]);
    }

    public function placeholder()
    {
        return view('livewire.skeletons.ekraf-index');
    }
}
