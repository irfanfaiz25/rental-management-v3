<?php

namespace App\Livewire;

use App\Models\Rental;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class RentalHistoryTab extends Component
{
    use WithPagination;
    public $dateFilterStart;
    public $dateFilterEnd;
    public $rentalFilter = 'today';


    public function render()
    {
        $rentals = Rental::where('status', 'completed')
            ->with('console')
            ->when($this->rentalFilter == 'today', function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->when($this->rentalFilter == 'yesterday', function ($query) {
                $query->whereDate('created_at', Carbon::yesterday());
            })
            ->when($this->rentalFilter == 'week', function ($query) {
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            })
            ->when($this->dateFilterStart && $this->dateFilterEnd, function ($query) {
                $query->whereBetween('created_at', [
                    $this->dateFilterStart . ' 00:00:00',
                    $this->dateFilterEnd . ' 23:59:59'
                ]);
            })
            ->orderBy('id', 'desc')
            ->paginate(6, pageName: 'rentals-history');
        return view('livewire.rental-history-tab', [
            'rentals' => $rentals
        ]);
    }


    public function updatingDateFilterStart()
    {
        $this->resetPage('rentals-history');
        $this->rentalFilter = '';
    }

    public function updatingDateFilterEnd()
    {
        $this->resetPage('rentals-history');
        $this->rentalFilter = '';
    }

    public function setRentalFilter($filter)
    {
        $this->rentalFilter = $filter;
        $this->dateFilterStart = null;
        $this->dateFilterEnd = null;
    }

    public function resetRentalFilter()
    {
        $this->dateFilterStart = null;
        $this->dateFilterEnd = null;
        $this->rentalFilter = 'today';
    }
}
