<?php

namespace App\Livewire;

use App\Models\Rental;
use Livewire\Component;
use Livewire\WithPagination;

class RentalHistoryTab extends Component
{
    use WithPagination;
    public $search;
    public $dateFilterStart;
    public $dateFilterEnd;


    public function render()
    {
        $rentals = Rental::where('status', 'completed')
            ->with('console')
            ->whereHas('console', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->dateFilterStart && $this->dateFilterEnd, function ($query) {
                $query->whereBetween('created_at', [
                    $this->dateFilterStart . ' 00:00:00',
                    $this->dateFilterEnd . ' 23:59:59'
                ]);
            })
            ->latest()
            ->paginate(6, pageName: 'rental-income');
        return view('livewire.rental-history-tab', [
            'rentals' => $rentals
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage('rental-income');
    }

    public function updatingDateFilterStart()
    {
        $this->resetPage('rental-income');
    }

    public function updatingDateFilterEnd()
    {
        $this->resetPage('rental-income');
    }

    public function resetRentalFilter()
    {
        $this->search = '';
        $this->dateFilterStart = null;
        $this->dateFilterEnd = null;
    }
}