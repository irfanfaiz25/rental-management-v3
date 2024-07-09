<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderHistoryTab extends Component
{
    use WithPagination;
    public $search;
    public $sourceFilter;
    public $dateFilterStart;
    public $dateFilterEnd;


    public function render()
    {
        $orders = Order::with('rental', 'menu')
            // ->when($this->search, function ($query) {
            //     $query->whereHas('rental.console', function ($query) {
            //         $query->where('name', 'like', '%' . $this->search . '%');
            //     })
            //         ->where('rental_id', '!=', 0);
            // })
            ->when($this->sourceFilter == 'rental', function ($query) {
                $query->where('rental_id', '!=', 0);
            })
            ->when($this->sourceFilter == 'cash', function ($query) {
                $query->where('rental_id', 0);
            })
            ->when($this->dateFilterStart && $this->dateFilterEnd, function ($query) {
                $query->whereBetween('reporting_date', [
                    $this->dateFilterStart . ' 00:00:00',
                    $this->dateFilterEnd . ' 23:59:59'
                ]);
            })
            ->latest()
            ->paginate(6, pageName: 'orders-history');
        return view('livewire.order-history-tab', [
            'orders' => $orders
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage('orders-history');
    }

    public function updatingDateFilterStart()
    {
        $this->resetPage('orders-history');
    }

    public function updatingDateFilterEnd()
    {
        $this->resetPage('orders-history');
    }

    public function setSourceFilter($filter)
    {
        $this->sourceFilter = $filter;
    }

    public function resetRentalFilter()
    {
        $this->search = '';
        $this->dateFilterStart = null;
        $this->dateFilterEnd = null;
    }
}
