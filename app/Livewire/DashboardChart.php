<?php

namespace App\Livewire;

use App\Models\Expenditure;
use App\Models\Income;
use App\Models\Order;
use App\Models\Rental;
use Carbon\Carbon;
use Livewire\Component;

class DashboardChart extends Component
{
    public $weeklyIncomes;
    public $weeklyExpenditures;

    public function mount()
    {
        $this->getWeeklyIncomeData();
    }

    public function getWeeklyIncomeData()
    {
        $weeklyIncomes = Income::selectRaw('DAYOFWEEK(created_at) as day, SUM(amount) as total')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('day')
            ->get();

        $incomesData = array_fill(0, 7, 0); // Initialize with 0s for each day of the week

        foreach ($weeklyIncomes as $income) {
            $incomesData[$income->day - 1] = $income->total; // DAYOFWEEK() returns 1 (Sunday) to 7 (Saturday)
        }

        $this->weeklyIncomes = $incomesData;

        // Query rentals data
        $weeklyExpenditures = Expenditure::selectRaw('DAYOFWEEK(created_at) as day, SUM(amount) as total')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('day')
            ->get();

        $rentalsData = array_fill(0, 7, 0);

        foreach ($weeklyExpenditures as $rental) {
            $rentalsData[$rental->day - 1] = $rental->total;
        }

        $this->weeklyExpenditures = $rentalsData;
    }

    public function render()
    {
        return view('livewire.dashboard-chart');
    }
}
