<?php

namespace App\Livewire\Dinas;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Url;

#[Lazy]
class DataIndex extends Component
{
    use \Livewire\WithPagination;

    public $search = '';
    
    #[Url]
    public $bidang = '';

    public function render()
    {
        $data = \App\Models\Data::with(['kategoriData', 'strukturOrganisasi'])
            ->select('id', 'nama_data', 'deskripsi', 'kategori_data_id', 'struktur_organisasi_id', 'tahun_terbit', 'cover', 'file', 'views', 'downloads', 'published_at', 'slug', 'is_public')
            ->where('is_public', 1)
            ->whereNotNull('published_at')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nama_data', 'like', '%' . $this->search . '%')
                        ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->bidang, function ($query) {
                $query->whereHas('strukturOrganisasi.bidang', function($q) {
                    $q->where('slug', $this->bidang);
                });
            })
            ->latest('published_at')
            ->paginate(10);

        return view('livewire.dinas.data-index', [
            'data_list' => $data
        ]);
    }

    public function placeholder()
    {
        return view('livewire.skeletons.dinas.data-index');
    }

    public function download($id)
    {
        $data = \App\Models\Data::findOrFail($id);
        $data->increment('downloads');

        return response()->download(storage_path('app/public/' . $data->file));
    }
}
