<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\WithPagination;
use App\Models\Pengumuman;

// #[Lazy]
class PengumumanIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $pengumuman = Pengumuman::query()
            ->latest('published_at')
            ->paginate(10);

        return view('livewire.dinas.pengumuman-index', [
            'pengumuman' => $pengumuman
        ]);
    }

    public function placeholder()
    {
        return view('livewire.skeletons.dinas.pengumuman-index');
    }
}
