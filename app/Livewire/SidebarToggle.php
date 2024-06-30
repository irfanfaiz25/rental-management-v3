<?php

namespace App\Livewire;

use Livewire\Component;

class SidebarToggle extends Component
{
    public $isSidebarVisible = false;

    public function toggleSidebar()
    {
        $this->isSidebarVisible = !$this->isSidebarVisible;
    }

    public function render()
    {
        return view('livewire.sidebar-toggle');
    }
}
