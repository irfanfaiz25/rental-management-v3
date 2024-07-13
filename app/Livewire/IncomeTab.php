<?php

namespace App\Livewire;

use App\Models\Expenditure;
use App\Models\Income;
use App\Models\Order;
use App\Models\Rental;
use Carbon\Carbon;
use Livewire\Component;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;

class IncomeTab extends Component
{
    public $totalIncome;
    public $rentalsIncome;
    public $othersIncome;
    public $totalProfit;
    public $dateFilterStart;
    public $dateFilterEnd;
    public $dateFilterStartPdf;
    public $dateFilterEndPdf;
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
        $totalIncome = $this->applyOtherFilters(Income::query())->sum('amount');
        $totalExpenditure = $this->applyFilters(Expenditure::query())->sum('amount');

        $this->totalIncome = $totalIncome;
        $this->rentalsIncome = $this->applyFilters(Rental::query())->sum('total_price');
        $this->othersIncome = $this->applyOtherFilters(Order::query())->sum('total_price');
        $this->totalProfit = $totalIncome - $totalExpenditure;
    }

    protected function applyFilters($query, $dateColumn = 'created_at')
    {
        return $query->when($this->incomeFilter == 'today', function ($query) use ($dateColumn) {
            $query->whereDate($dateColumn, Carbon::today());
        })->when($this->incomeFilter == 'week', function ($query) use ($dateColumn) {
            $query->whereBetween($dateColumn, [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        })->when($this->incomeFilter == 'yesterday', function ($query) use ($dateColumn) {
            $query->whereDate($dateColumn, Carbon::yesterday());
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
        })->when($this->incomeFilter == 'yesterday', function ($query) use ($dateColumn) {
            $query->whereDate($dateColumn, Carbon::yesterday());
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

    public function downloadReport()
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Create a new DOMPDF instance
        $dompdf = new Dompdf($options);

        $incomes = Income::whereBetween('reporting_date', [$this->dateFilterStartPdf . ' 00:00:00', $this->dateFilterEndPdf . ' 23:59:59']);
        $incomesData = $incomes->orderBy('id', 'asc')->get();
        $incomeTotal = $incomes->sum('amount');

        $expenditures = Expenditure::whereBetween('expend_date', [$this->dateFilterStartPdf, $this->dateFilterEndPdf]);
        $expendituresData = $expenditures->orderBy('id', 'asc')->get();
        $expenditureTotal = $expenditures->sum('amount');

        $profitTotal = $incomeTotal - $expenditureTotal;

        // Load the HTML from a view
        $html = View::make('pdf.finance-report', [
            'incomes' => $incomesData,
            'incomeTotal' => $incomeTotal,
            'expenditures' => $expendituresData,
            'expenditureTotal' => $expenditureTotal,
            'profitTotal' => $profitTotal,
            'dateStart' => $this->dateFilterStartPdf,
            'dateEnd' => $this->dateFilterEndPdf,
        ])->render();

        // Load HTML to DOMPDF
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the PDF
        $dompdf->render();

        // Output the PDF to the browser
        return response()->streamDownload(
            function () use ($dompdf) {
                echo $dompdf->output();
            },
            'Rentals Report.pdf'
        );
    }
}
