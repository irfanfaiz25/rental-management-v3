<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeaderLayout extends Component
{
    public $isProfileButtonVisible;

    public function profileToggle()
    {
        $this->isProfileButtonVisible = !$this->isProfileButtonVisible;
    }

    public function logout()
    {
        Auth::logout();

        return redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.header-layout', [
            'tes' => 'cek'
        ]);
    }
}
