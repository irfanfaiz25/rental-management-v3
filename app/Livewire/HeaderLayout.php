<?php

namespace App\Livewire;

use Livewire\Component;

class HeaderLayout extends Component
{
    public $isProfileButtonVisible;

    public function profileToggle()
    {
        $this->isProfileButtonVisible = !$this->isProfileButtonVisible;
    }

    public function render()
    {
        return view('livewire.header-layout', [
            'tes' => 'cek'
        ]);
    }
}
 