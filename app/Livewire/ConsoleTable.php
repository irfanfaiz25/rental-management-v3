<?php

namespace App\Livewire;

use App\Models\Console;
use Livewire\Component;
use Livewire\WithPagination;

class ConsoleTable extends Component
{
    use WithPagination;
    public $isModalShow = false;
    public $isConfirmationModal = false;
    public $deleteId;
    public $deleteName;
    public $isEdit = false;
    public $editId;
    public $name;
    public $model;
    public $price;

    public function render()
    {
        $consoles = Console::paginate(5);
        return view('livewire.console-table', [
            'consoles' => $consoles
        ]);
    }

    public function setModalEdit($id)
    {
        $console = Console::findOrFail($id);

        $this->isModalShow = true;
        $this->isEdit = true;
        $this->editId = $id;

        $this->name = $console->name;
        $this->model = $console->model;
        $this->price = (int) $console->price;
    }

    public function showConfirmationDelete($id, $name)
    {
        $this->isConfirmationModal = true;
        $this->deleteId = $id;
        $this->deleteName = $name;
    }

    public function closeConfirmationDelete()
    {
        $this->isConfirmationModal = false;
        $this->reset('deleteId', 'deleteName');
    }

    public function setModalClose()
    {
        $this->isModalShow = false;
        $this->isEdit = false;
        $this->reset('editId', 'name', 'model', 'price');
    }

    public function storeConsole()
    {
        $validated = $this->validate([
            'name' => 'required|unique:consoles',
            'model' => 'required',
            'price' => 'required|integer'
        ]);

        Console::create($validated);

        $this->setModalClose();

        toastr()->success('New console successfully added');
    }

    public function updateConsole()
    {
        $validated = $this->validate([
            'name' => 'required|unique:consoles,name,' . $this->editId,
            'model' => 'required',
            'price' => 'required|integer'
        ]);

        $console = Console::findOrFail($this->editId);
        $console->name = $validated['name'];
        $console->model = $validated['model'];
        $console->price = $validated['price'];

        $console->save();

        $this->setModalClose();

        toastr()->success('Console successfully updated');
    }

    public function deleteConsole()
    {
        $console = Console::findOrFail($this->deleteId);
        $console->delete();

        $this->closeConfirmationDelete();

        toastr()->success('Console successfully deleted');
    }
}
