<?php

namespace App\Livewire;

use Livewire\Component;

class SidebarToggle extends Component
{
    public $isSidebarVisible = false;
    public $sidebarMenu = [
        [
            'name' => 'dashboard',
            'route' => 'dashboard.index',
            'icon' => 'ri-home-2-line',
            'request' => 'dashboard*'
        ],
        [
            'name' => 'transaction',
            'route' => 'transaction.index',
            'icon' => 'ri-arrow-left-right-line',
            'request' => 'transactions*'
        ],
        [
            'name' => 'console',
            'route' => 'console.index',
            'icon' => 'ri-gamepad-line',
            'request' => 'consoles*'
        ],
        [
            'name' => 'menu',
            'route' => 'menu.index',
            'icon' => 'ri-restaurant-2-line',
            'request' => 'menus*'
        ],
        [
            'name' => 'report',
            'route' => 'report.index',
            'icon' => 'ri-file-text-line',
            'request' => 'reports*'
        ]
    ];

    public function toggleSidebar()
    {
        $this->isSidebarVisible = !$this->isSidebarVisible;
    }

    public function render()
    {
        return view('livewire.sidebar-toggle');
    }
}
