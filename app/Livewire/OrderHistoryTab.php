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
        $orders = Order::with('rental');

        // Apply filters based on the source
        if ($this->sourceFilter == 'rental') {
            $orders->where('rental_id', '!=', 0);
        } elseif ($this->sourceFilter == 'cash') {
            $orders->where('rental_id', 0);
        }

        // Apply date filters if both start and end dates are provided
        if ($this->dateFilterStart && $this->dateFilterEnd) {
            $orders->whereBetween('reporting_date', [
                $this->dateFilterStart . ' 00:00:00',
                $this->dateFilterEnd . ' 23:59:59'
            ]);
        }

        $orders = $orders->orderBy('id', 'desc')
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
        $this->resetPage('orders-history');
    }

    public function resetRentalFilter()
    {
        $this->search = '';
        $this->dateFilterStart = null;
        $this->dateFilterEnd = null;
    }
}
