<?php

namespace App\Livewire\Dinas;

use App\Models\Data;
use Livewire\Component;

class DataDetail extends Component
{
    public Data $data;

    public function mount($slug)
    {
        $this->data = Data::with('strukturOrganisasi')->where('slug', $slug)->firstOrFail();
        $this->data->increment('views');
    }

    public function download()
    {
        $this->data->increment('downloads');
        return response()->download(storage_path('app/public/' . $this->data->file));
    }

    public function render()
    {
        $relatedData = Data::where('id', '!=', $this->data->id)
            ->where('is_public', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('livewire.dinas.data-detail', [
            'relatedData' => $relatedData
        ]);
    }
}
