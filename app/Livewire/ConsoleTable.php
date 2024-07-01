<?php

namespace App\Livewire;

use App\Models\Console;
use Livewire\Component;
use Livewire\WithPagination;

class ConsoleTable extends Component
{
    use WithPagination;
    public $isAddModalShow = false;

    public function render()
    {
        $consoles = Console::paginate(5);
        return view('livewire.console-table', [
            'consoles' => $consoles
        ]);
    }
}
