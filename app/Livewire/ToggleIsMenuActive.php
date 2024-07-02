<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;

class ToggleIsMenuActive extends Component
{
    public $menu;
    public bool $isMenuActive;


    public function mount($menu)
    {
        $this->menu = $menu;
        $this->isMenuActive = $menu->is_active;
    }

    public function updatedIsMenuActive($value)
    {
        $this->menu->is_active = $value;
        $this->menu->save();
    }

    public function render()
    {
        return view('components.toggle-is-menu-active');
    }
}
