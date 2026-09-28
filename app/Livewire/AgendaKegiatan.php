<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\WithPagination;
use App\Models\AgendaKegiatan as AgendaKegiatanModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

// #[Lazy]
class AgendaKegiatan extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $currentMonth;
    public $currentYear;
    public $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];
    public $years = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'currentMonth' => ['except' => null],
        'currentYear' => ['except' => null],
    ];

    public function mount()
    {
        $this->currentMonth = $this->currentMonth ?? now()->month;
        $this->currentYear = $this->currentYear ?? now()->year;

        // Generate years from current year - 5 to current year + 5
        $currentYear = now()->year;
        $this->years = range($currentYear - 5, $currentYear + 5);
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->resetPage();
    }

    public function previousMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function changeMonth($month)
    {
        $this->currentMonth = $month;
        $this->resetPage();
    }

    public function changeYear($year)
    {
        $this->currentYear = $year;
        $this->resetPage();
    }

    public function render()
    {
        $query = AgendaKegiatanModel::query()
            ->orderBy('dari_tanggal', 'asc')
            ->orderBy('waktu_mulai', 'asc');

        // Filter by Month and Year
        $query->whereMonth('dari_tanggal', $this->currentMonth)
            ->whereYear('dari_tanggal', $this->currentYear);

        if ($this->search) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function (Builder $q) use ($searchTerm) {
                $q->where('nama_agenda', 'like', $searchTerm)
                    ->orWhere('uraian_agenda', 'like', $searchTerm)
                    ->orWhere('tempat', 'like', $searchTerm);
            });
        }

        $agendas = $query->paginate($this->perPage);

        return view('livewire.dinas.agenda-kegiatan', [
            'agendas' => $agendas,
            'pageTitle' => 'Agenda Kegiatan',
        ]);
    }

    public function placeholder()
    {
        return view('livewire.skeletons.dinas.agenda-index');
    }
}
