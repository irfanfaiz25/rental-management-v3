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
    public $dateFilter;
    public $incomeFilter = 'today';


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
        $this->totalIncome = Income::when($this->incomeFilter == 'today', function ($query) {
            $query->whereDate('created_at', Carbon::today());
        })->when($this->incomeFilter == 'week', function ($query) {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        })->when($this->incomeFilter == 'month', function ($query) {
            $query->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        })->when($this->dateFilter, function ($query) {
            $query->whereBetween('created_at', [$this->dateFilter . ' 00:00:00', $this->dateFilter . ' 23:59:59']);
        })->sum('amount');

        $this->rentalsIncome = Rental::when($this->incomeFilter == 'today', function ($query) {
            $query->whereDate('created_at', Carbon::today());
        })->when($this->incomeFilter == 'week', function ($query) {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        })->when($this->incomeFilter == 'month', function ($query) {
            $query->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        })->when($this->dateFilter, function ($query) {
            $query->whereBetween('created_at', [$this->dateFilter . ' 00:00:00', $this->dateFilter . ' 23:59:59']);
        })->sum('total_price');

        $this->othersIncome = Order::when($this->incomeFilter == 'today', function ($query) {
            $query->whereDate('reporting_date', Carbon::today());
        })->when($this->incomeFilter == 'week', function ($query) {
            $query->whereBetween('reporting_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        })->when($this->incomeFilter == 'month', function ($query) {
            $query->whereBetween('reporting_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        })->when($this->dateFilter, function ($query) {
            $query->whereBetween('reporting_date', [$this->dateFilter . ' 00:00:00', $this->dateFilter . ' 23:59:59']);
        })->sum('total_price');
    }

    public function updatedDateFilter()
    {
        $this->incomeFilter = '';
        $this->getIncomesData();
    }

    public function setIncomeFilter($filter)
    {
        $this->incomeFilter = $filter;
        $this->dateFilter = null;

        $this->getIncomesData();
    }

    public function resetFilter()
    {
        $this->incomeFilter = 'today';
        $this->dateFilter = null;

        $this->getIncomesData();
    }
}
