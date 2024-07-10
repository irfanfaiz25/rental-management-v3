<?php

namespace App\Livewire;

use App\Models\Income;
use App\Models\Order;
use App\Models\Rental;
use Carbon\Carbon;
use Livewire\Component;

class IncomeTab extends Component
{
    public $totalIncome;
    public $rentalsIncome;
    public $othersIncome;
    public $dateFilterStart;
    public $dateFilterEnd;
    public $incomeFilter = 'today';
    public $months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];


    public function render()
    {
        return view('livewire.income-tab');
    }

    public function mount()
    {
        $this->getIncomesData();
    }

    public function getIncomesData()
    {
        $this->totalIncome = $this->applyFilters(Income::query())->sum('amount');
        $this->rentalsIncome = $this->applyFilters(Rental::query())->sum('total_price');
        $this->othersIncome = $this->applyOtherFilters(Order::query(), 'reporting_date')->sum('total_price');
    }

    protected function applyFilters($query, $dateColumn = 'created_at')
    {
        return $query->when($this->incomeFilter == 'today', function ($query) use ($dateColumn) {
            $query->whereDate($dateColumn, Carbon::today());
        })->when($this->incomeFilter == 'week', function ($query) use ($dateColumn) {
            $query->whereBetween($dateColumn, [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        })->when($this->incomeFilter == 'month', function ($query) use ($dateColumn) {
            $query->whereBetween($dateColumn, [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        })->when($this->dateFilterStart && $this->dateFilterEnd, function ($query) use ($dateColumn) {
            $query->whereBetween($dateColumn, [$this->dateFilterStart . ' 00:00:00', $this->dateFilterEnd . ' 23:59:59']);
        });
    }

    protected function applyOtherFilters($query, $dateColumn = 'reporting_date')
    {
        return $query->when($this->incomeFilter == 'today', function ($query) use ($dateColumn) {
            $query->whereDate($dateColumn, Carbon::today());
        })->when($this->incomeFilter == 'week', function ($query) use ($dateColumn) {
            $query->whereBetween($dateColumn, [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        })->when($this->incomeFilter == 'month', function ($query) use ($dateColumn) {
            $query->whereBetween($dateColumn, [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        })->when($this->dateFilterStart && $this->dateFilterEnd, function ($query) use ($dateColumn) {
            $query->whereBetween($dateColumn, [$this->dateFilterStart . ' 00:00:00', $this->dateFilterEnd . ' 23:59:59']);
        });
    }

    public function updatedDateFilterStart()
    {
        $this->incomeFilter = '';
        $this->getIncomesData();
    }

    public function updatedDateFilterEnd()
    {
        $this->incomeFilter = '';
        $this->getIncomesData();
    }

    public function setIncomeFilter($filter)
    {
        $this->incomeFilter = $filter;
        $this->dateFilterStart = null;
        $this->dateFilterEnd = null;

        $this->getIncomesData();
    }

    public function resetFilter()
    {
        $this->incomeFilter = 'today';
        $this->dateFilterStart = null;
        $this->dateFilterEnd = null;

        $this->getIncomesData();
    }
}
