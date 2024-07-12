<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginForm extends Component
{
    public $username;
    public $password;


    public function render()
    {
        return view('livewire.login-form');
    }

    public function login()
    {
        $validated = $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['username' => $validated['username'], 'password' => $validated['password']])) {
            return redirect(route('dashboard.index'));
        } else {
            session()->flash('invalid', 'Invalid login credentials');

            $this->reset('username', 'password');
        }
    }
}
