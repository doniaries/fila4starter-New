<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Request;
use App\Models\Visit;
use Carbon\Carbon;
use Livewire\Attributes\Lazy;

#[Lazy]
class VisitorStats extends Component
{

    public $today;
    public $month;
    public $online;
    public $ip;

    public function mount()
    {
        $this->ip = Request::ip();

        // Ensure current visit is recorded (simple logic, ideally middleware handles this)
        // For this port, we'll assume middleware or basic tracking exists, 
        // or just calculate based on existing data.
        // Let's implement basic tracking here for display purposes if not in middleware.

        Visit::create([
            'ip' => $this->ip,
            'session_id' => session()->getId(),
            'user_agent' => Request::userAgent(),
            'visited_at' => Carbon::now(),
            'last_activity' => Carbon::now(),
            'url' => Request::url(),
        ]);

        $this->calculateStats();
    }

    public function calculateStats()
    {
        $this->today = Visit::whereDate('created_at', Carbon::today())->count();
        $this->month = Visit::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Approximation for online users (active in last 5 minutes)
        // Note: usage of 'updated_at' or 'created_at' depends on how Visit model is updated
        $this->online = Visit::where('created_at', '>=', Carbon::now()->subMinutes(5))
            ->distinct('session_id')
            ->count('session_id');

        if ($this->online == 0) $this->online = 1; // At least current user
    }

    public function render()
    {
        return view('livewire.visitor-stats');
    }
}
