<?php

namespace App\Livewire;

use App\Models\Console;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Rental;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class TransactionCard extends Component
{
    use WithPagination;

    public $searchConsole;
    public $isStartModalShow = false;
    public $startDate;
    public $startTime;
    public $startId;
    public $isEditStartTime;
    public $editStartId;
    public $rentalId;
    public $isEndModalShow = false;
    public $endId;
    public $endName;
    public $endTime;
    public $isNewOrderModalShow = false;
    public $newOrderConsole;
    public $orders = [];
    public $menuFilter = null;
    public $searchMenuName = null;
    public $isManageOrderModalShow = false;
    public $manageOrderConsoleName;
    public $manageOrdersData = [];
    public $isResetRentalModalShow = false;
    public $resetRentalId;
    public $resetRentalName;


    #[On('rental-done')]
    public function render()
    {
        $consoles = Console::where('name', 'like', '%' . $this->searchConsole . '%')->with('currentRental')->paginate(9, pageName: 'console-card');
        $menus = Menu::where('category', 'like', '%' . $this->menuFilter . '%')
            ->where('name', 'like', '%' . $this->searchMenuName . '%')
            ->where('is_active', true)
            ->paginate(5, pageName: 'menu-list');
        $filteredOrders = $this->manageOrdersData ? $this->getFilteredOrders() : null;

        return view('livewire.transaction-card', [
            'consoles' => $consoles,
            'menus' => $menus,
            'filteredOrders' => $filteredOrders
        ]);
    }

    public function updatingSearchConsole()
    {
        $this->resetPage('console-card');
    }

    public function setStartModalOpen($consoleId)
    {
        $this->isStartModalShow = true;
        $this->startDate = Carbon::today()->format('Y-m-d');
        $this->startTime = Carbon::now()->format('H:i');
        $this->startId = $consoleId;
    }

    public function setStartModalClose()
    {
        $this->isStartModalShow = false;
        $this->isEditStartTime = false;

        $this->reset('startDate', 'startTime', 'startId', 'editStartId');
    }

    public function setEditStartModalOpen($rentalId)
    {
        $this->isStartModalShow = true;
        $this->isEditStartTime = true;
        $this->editStartId = $rentalId;

        $rental = Rental::find($rentalId);

        $this->startDate = Carbon::parse($rental->start_time)->format('Y-m-d');
        $this->startTime = Carbon::parse($rental->start_time)->format('H:i');
    }

    public function setEndModalOpen($rentalId)
    {
        $this->isEndModalShow = true;
        $rental = Rental::find($rentalId);
        $this->endId = $rental->console->id;
        $this->rentalId = $rentalId;
        $this->endName = $rental->console->name;
        $this->endTime = Carbon::now()->format('Y-m-d H:i:s');
    }

    public function setEndModalClose()
    {
        $this->isEndModalShow = false;
        $this->reset('endId', 'endName', 'rentalId', 'endTime');
    }

    public function startRental()
    {
        $validated = $this->validate([
            'startDate' => 'required',
            'startTime' => 'required'
        ]);

        $dateTimeString = $validated['startDate'] . ' ' . $validated['startTime'];
        $datetime = Carbon::createFromFormat('Y-m-d H:i', $dateTimeString);

        Rental::create([
            'console_id' => $this->startId,
            'start_time' => $datetime,
            'status' => 'active'
        ]);

        $console = Console::find($this->startId);
        $console->is_active = true;
        $console->save();

        $this->setStartModalClose();

        toastr()->success($console->name . ' started');
    }

    public function editStartRental()
    {
        $validated = $this->validate([
            'startDate' => 'required',
            'startTime' => 'required'
        ]);

        $dateTimeString = $validated['startDate'] . ' ' . $validated['startTime'];
        $datetime = Carbon::createFromFormat('Y-m-d H:i', $dateTimeString);

        $rental = Rental::find($this->editStartId);
        $rental->start_time = $datetime;
        $rental->save();

        $this->setStartModalClose();

        toastr()->success($rental->console->name . ' edited');
    }

    public function setRentalDetails()
    {

        $this->dispatch('rental-details', consoleId: $this->endId, rentalId: $this->rentalId, endTime: $this->endTime);

        $this->setEndModalClose();
    }

    public function setNewOrderModalOpen($rentalId)
    {
        $this->isNewOrderModalShow = true;
        $this->rentalId = $rentalId;
        $rental = Rental::find($rentalId);
        $this->newOrderConsole = $rental->console->name;
    }

    public function setNewOrderModalClose()
    {
        $this->isNewOrderModalShow = false;
        $this->reset('rentalId', 'orders', 'menuFilter', 'searchMenuName');
        $this->resetPage('menu-list');
    }

    public function setMenuFilter($category)
    {
        $this->menuFilter = $category;
    }

    public function addToCart($menu)
    {
        foreach ($this->orders as $order) {
            if ($order['id'] == $menu['id']) {
                $order['quantity']++;
                return;
            }
        }

        $menu['quantity'] = 1;
        array_unshift($this->orders, $menu);

        $this->reset('searchMenuName');
    }

    public function updateQuantity($index, $quantity)
    {
        if ($quantity < 1) {
            unset($this->orders[$index]);
        } else {
            $this->orders[$index]['quantity'] = $quantity;
        }
    }

    public function incrementQuantity($index)
    {
        $this->orders[$index]['quantity']++;
    }

    public function decrementQuantity($index)
    {
        if ($this->orders[$index]['quantity'] > 1) {
            $this->orders[$index]['quantity']--;
        } else {
            unset($this->orders[$index]);
        }
    }

    public function deleteCart($index)
    {
        unset($this->orders[$index]);
    }

    public function storeOrders()
    {
        foreach ($this->orders as $order) {
            Order::create([
                'rental_id' => $this->rentalId,
                'menu_id' => $order['id'],
                'quantity' => $order['quantity'],
                'total_price' => $order['quantity'] * $order['price']
            ]);
        }

        $this->setNewOrderModalClose();

        toastr()->success('New order added');
    }

    public function setManageOrdersModalOpen($rentalId)
    {
        $this->isManageOrderModalShow = true;

        $this->manageOrdersData = Order::where('rental_id', $rentalId)->with('menu')->get()->toArray();

        $rental = Rental::find($rentalId);

        $this->manageOrderConsoleName = $rental->console->name;
    }

    public function setManageOrdersModalClose()
    {
        $this->isManageOrderModalShow = false;

        $this->reset('manageOrdersData');
    }

    public function decrementOrder($index)
    {
        if ($this->manageOrdersData[$index]['quantity'] > 1) {
            $this->manageOrdersData[$index]['quantity']--;
            $this->manageOrdersData[$index]['total_price'] = $this->manageOrdersData[$index]['quantity'] * $this->manageOrdersData[$index]['menu']['price'];
        } else {
            $this->manageOrdersData[$index]['quantity'] = 0;
        }
    }
    public function updateOrder($index, $quantity)
    {
        if ($quantity < 1) {
            $this->manageOrdersData[$index]['quantity'] = 0;
        } else {
            $this->manageOrdersData[$index]['quantity'] = $quantity;
            $this->manageOrdersData[$index]['total_price'] = $quantity * $this->manageOrdersData[$index]['menu']['price'];
        }
    }
    public function incrementOrder($index)
    {
        $this->manageOrdersData[$index]['quantity']++;
        $this->manageOrdersData[$index]['total_price'] = $this->manageOrdersData[$index]['quantity'] * $this->manageOrdersData[$index]['menu']['price'];
    }
    public function deleteOrder($index)
    {
        $this->manageOrdersData[$index]['quantity'] = 0;
    }

    public function getFilteredOrders()
    {
        return array_filter($this->manageOrdersData, function ($order) {
            return $order['quantity'] > 0;
        });
    }

    public function saveOrders()
    {
        foreach ($this->manageOrdersData as $orderData) {
            $order = Order::find($orderData['id']);
            if ($orderData['quantity'] == 0) {
                $order->delete();
            } else {
                $order->quantity = $orderData['quantity'];
                $order->total_price = $orderData['total_price'];
                $order->save();
            }
        }

        $this->setManageOrdersModalClose();

        toastr()->success('Orders updated');
    }

    public function setResetRentalModalOpen($rentalId)
    {
        $this->isResetRentalModalShow = true;

        $this->resetRentalId = $rentalId;

        $rental = Rental::find($this->resetRentalId);

        $this->resetRentalName = $rental->console->name;
    }

    public function setResetRentalModalClose()
    {
        $this->isResetRentalModalShow = false;

        $this->reset('resetRentalId', 'resetRentalName');
    }

    public function resetRental()
    {
        // Find and delete orders
        Order::where('rental_id', $this->resetRentalId)->delete();

        // Find and delete rental
        $rental = Rental::find($this->resetRentalId);
        $consoleId = $rental->console_id;
        $rental->delete();

        // Update console to inactive
        $console = Console::find($consoleId);
        $console->is_active = false;
        $console->save();

        $this->setResetRentalModalClose();

        $this->dispatch('reset-rental');

        toastr()->success('Rental has been reseted');
    }
}
