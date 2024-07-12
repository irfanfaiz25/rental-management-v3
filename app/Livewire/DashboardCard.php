<?php

namespace App\Livewire;

use App\Models\Console;
use App\Models\Expenditure;
use App\Models\Income;
use Carbon\Carbon;
use Livewire\Component;

class DashboardCard extends Component
{
    public $rentalReady;
    public $todaysIncome;
    public $todaysExpenditure;


    public function render()
    {
        return view('livewire.dashboard-card');
    }

    public function mount()
    {
        $this->rentalReady = Console::where('is_active', false)->count();
        $this->todaysIncome = Income::whereDate('reporting_date', Carbon::today())->sum('amount');
        $this->todaysExpenditure = Expenditure::whereDate('created_at', Carbon::today())->sum('amount');
    }
}
