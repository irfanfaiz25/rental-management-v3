<?php

namespace App\Livewire;

use App\Models\Expenditure;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenditureTab extends Component
{
    use WithPagination;

    public $date;
    public $name;
    public $amount;
    public $notes;
    public $expenditureTotal;
    public $dateFilterStart;
    public $dateFilterEnd;
    public $expenditureFilter = 'today';
    public $isModalShow = false;
    public $isConfirmationModalShow = false;
    public $isEdit = false;
    public $editId;
    public $deleteId;
    public $deleteName;


    public function render()
    {
        $expenditures = $this->getExpenditureData();
        return view('livewire.expenditure-tab', [
            'expenditures' => $expenditures
        ]);
    }

    public function mount()
    {
        $this->date = Carbon::today()->format('Y-m-d');
        $this->getExpenditureDetails();
    }

    public function setExpenditureFilter($filter)
    {
        $this->expenditureFilter = $filter;
        $this->getExpenditureDetails();
    }

    public function getExpenditureDetails()
    {
        $this->expenditureTotal = Expenditure::when($this->expenditureFilter == 'today', function ($query) {
            $query->whereDate('expend_date', Carbon::today());
        })->when($this->expenditureFilter == 'week', function ($query) {
            $query->whereBetween('expend_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        })->when($this->expenditureFilter == 'month', function ($query) {
            $query->whereBetween('expend_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        })->when($this->dateFilterStart && $this->dateFilterEnd, function ($query) {
            $query->whereBetween('expend_date', [$this->dateFilterStart, $this->dateFilterEnd]);
        })->sum('amount');
    }

    public function getExpenditureData()
    {
        $expenditures = Expenditure::when($this->expenditureFilter == 'today', function ($query) {
            $query->whereDate('expend_date', Carbon::today());
        })->when($this->expenditureFilter == 'week', function ($query) {
            $query->whereBetween('expend_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        })->when($this->expenditureFilter == 'month', function ($query) {
            $query->whereBetween('expend_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        })->when($this->dateFilterStart && $this->dateFilterEnd, function ($query) {
            $query->whereBetween('expend_date', [$this->dateFilterStart, $this->dateFilterEnd]);
        })->paginate(3, pageName: 'expenditures');

        return $expenditures;
    }

    public function updatedDateFilterStart()
    {
        $this->getExpenditureDetails();
        $this->getExpenditureData();
        $this->expenditureFilter = '';
    }

    public function updatedDateFilterEnd()
    {
        $this->getExpenditureDetails();
        $this->getExpenditureData();
        $this->expenditureFilter = '';
    }

    public function resetFilter()
    {
        $this->dateFilterStart = null;
        $this->dateFilterEnd = null;
        $this->expenditureFilter = 'today';

        $this->getExpenditureDetails();
    }

    public function setModalOpen()
    {
        $this->isModalShow = true;
    }

    public function setModalEditOpen($id)
    {
        $this->isModalShow = true;
        $this->isEdit = true;

        $expenditure = Expenditure::find($id);

        $this->editId = $id;
        $this->date = $expenditure->expend_date;
        $this->name = $expenditure->name;
        $this->amount = (int) $expenditure->amount;
        $this->notes = $expenditure->notes;
    }

    public function setModalClose()
    {
        $this->isModalShow = false;
        $this->isEdit = false;

        $this->reset('date', 'name', 'amount', 'notes', 'editId');
    }

    public function setConfirmationModalOpen($id)
    {
        $this->isConfirmationModalShow = true;
        $expenditure = Expenditure::find($id);

        $this->deleteId = $id;
        $this->deleteName = $expenditure->name;
    }

    public function setConfirmationModalClose()
    {
        $this->isConfirmationModalShow = false;
        $this->reset('deleteId');
    }

    public function storeExpenditure()
    {
        $validated = $this->validate([
            'date' => 'required|date',
            'name' => 'required|min:2',
            'amount' => 'required|integer',
        ]);

        Expenditure::create([
            'expend_date' => $validated['date'],
            'name' => $validated['name'],
            'amount' => $validated['amount'],
            'notes' => $this->notes
        ]);

        $this->setModalClose();

        $this->getExpenditureDetails();

        toastr()->success('Expenditure added');
    }

    public function updateExpenditure()
    {
        $expenditure = Expenditure::find($this->editId);

        $expenditure->expend_date = $this->date;
        $expenditure->name = $this->name;
        $expenditure->amount = $this->amount;
        $expenditure->notes = $this->notes;
        $expenditure->save();

        $this->setModalClose();

        $this->getExpenditureDetails();

        toastr()->success('Expenditure updated');
    }

    public function deleteExpenditure()
    {
        $expenditure = Expenditure::find($this->deleteId);
        $expenditure->delete();

        $this->setConfirmationModalClose;

        toastr()->success('Expenditure deleted');
    }
}
