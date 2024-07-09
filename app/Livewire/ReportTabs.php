<?php

namespace App\Livewire;

use App\Models\Rental;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ReportTabs extends Component
{
    use WithPagination;

    public $tabsPage = 'ordersHistory';


    public function render()
    {
        return view('livewire.report-tabs');
    }

    public function setTabsPage($page)
    {
        $this->tabsPage = $page;
    }
}
