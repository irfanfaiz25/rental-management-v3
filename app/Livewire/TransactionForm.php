<?php

namespace App\Livewire;

use App\Models\Console;
use App\Models\Income;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Rental;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class TransactionForm extends Component
{
    use WithPagination;

    public $isRequestRentalDetails = false;
    public $rentalId;
    public $consoleName;
    public $rentalTime;
    public $endTime;
    public $totalOrders;
    public $totalRental;
    public $granTotal;
    public $paid;
    public $paidInteger;
    public $notes;
    public $changes;
    public $isNewOrderModalShow = false;
    public $newOrderConsole;
    public $orders = [];
    public $grandTotal = 0;
    public $menuFilter = null;
    public $searchMenuName = null;
    public $orderNotes;


    public function render()
    {
        $menus = Menu::where('category', 'like', '%' . $this->menuFilter . '%')
            ->where('name', 'like', '%' . $this->searchMenuName . '%')
            ->where('is_active', true)
            ->paginate(5, pageName: 'new-cash-order');
        return view('livewire.transaction-form', [
            'menus' => $menus
        ]);
    }

    #[On('rental-details')]
    public function getRentalDetails($consoleId, $rentalId, $endTime)
    {
        $this->isRequestRentalDetails = true;
        $this->rentalId = $rentalId;
        $this->endTime = $endTime;

        $console = Console::find($consoleId);
        $rental = $console->currentRental()->first();

        $endTime = Carbon::now();
        $startTime = Carbon::parse($rental->start_time);

        $totalOrders = intval(Order::where('rental_id', $rentalId)->sum('total_price'));
        $convertedTotalOrders = $this->rupiahFormat($totalOrders);

        $rentalTime = $startTime->diffInMinutes($endTime);
        $convertedRentalTime = $this->minutesToHours($rentalTime);
        $totalPrice = intval($rentalTime * ($console->price / 60));
        $roundedTotalPrice = round($totalPrice / 1000) * 1000;
        $convertedTotalPrice = $this->rupiahFormat($roundedTotalPrice);

        $convertedGranTotal = $this->rupiahFormat($totalOrders + $roundedTotalPrice);

        $this->consoleName = $console->name;
        $this->rentalTime = $convertedRentalTime;
        $this->totalRental = $convertedTotalPrice;
        $this->totalOrders = $convertedTotalOrders;
        $this->granTotal = $convertedGranTotal;
    }

    #[On('reset-rental')]
    public function resetRentalDetails()
    {
        $this->isRequestRentalDetails = false;

        $this->reset('rentalId', 'consoleName', 'rentalTime', 'totalOrders', 'totalRental', 'granTotal', 'paid', 'notes', 'changes');
    }

    function minutesToHours($minutes)
    {
        if ($minutes < 60) {
            return $minutes . ' menit';
        } else {
            $hours = floor($minutes / 60);
            $minuteRemainder = $minutes % 60;
            $hourStr = $hours . ' jam';
            $minuteStr = ($minuteRemainder > 0) ? ' ' . $minuteRemainder . ' menit' : '';

            return $hourStr . $minuteStr;
        }
    }

    public function rupiahFormat($value)
    {
        return 'Rp. ' . number_format($value, 0, ',', '.');
    }

    public function updatedPaid($value)
    {
        $value = $this->convertInteger($value);

        // Convert the value to a float
        $floatValue = (float) $value;

        // Format the number with thousand separators
        $formattedValue = 'Rp. ' . number_format($floatValue, 0, ',', '.');

        // Update the number property with the formatted value
        $this->paid = $formattedValue;
        $this->paidInteger = $value;
    }

    public function convertInteger($value)
    {
        // Remove non-numeric characters except for commas and periods
        $value = preg_replace('/[^0-9,.]/', '', $value);

        // Replace commas with empty string and periods with commas
        $value = str_replace(',', '', $value);
        $value = str_replace('.', '', $value);

        return $value;
    }

    public function setPayment()
    {
        $this->validate([
            'paid' => 'required'
        ], [
            'required' => 'Nominal yang dibayarkan harus di isi'
        ]);

        $granTotal = $this->convertInteger($this->granTotal);
        $paid = $this->paidInteger;

        $changes = $paid - $granTotal;

        $convertedTotalRental = $this->convertInteger($this->totalRental);
        $convertedTotalOrders = $this->convertInteger($this->totalOrders);

        if ($changes < 0) {
            $this->reset('paid');

            toastr()->warning('Nominal yang dibayarkan kurang');
        } else {
            $rental = Rental::find($this->rentalId);
            $consoleId = $rental->console_id;
            $rental->end_time = $this->endTime;
            $rental->total_price = $convertedTotalRental;
            $rental->status = 'completed';
            $rental->save();

            $console = Console::find($consoleId);
            $console->is_active = false;
            $console->save();

            Income::create([
                'source' => 'rental',
                'amount' => $convertedTotalRental,
                'description' => $this->notes
            ]);

            Income::create([
                'source' => 'other',
                'amount' => $convertedTotalOrders,
                'notes' => $this->notes
            ]);

            $this->resetRentalDetails();

            $this->dispatch('rental-done');

            toastr()->success('Total Kembalian: ' . $changes);
        }
    }

    public function updatingSearchMenuName()
    {
        $this->resetPage('new-cash-order');
    }

    public function setNewOrderModalOpen()
    {
        $this->isNewOrderModalShow = true;
    }

    public function setNewOrderModalClose()
    {
        $this->isNewOrderModalShow = false;
        $this->reset('orders', 'menuFilter', 'searchMenuName', 'grandTotal', 'orderNotes');
        $this->resetPage('new-cash-order');
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
        $menu['total_price'] = $menu['quantity'] * $menu['price'];
        array_unshift($this->orders, $menu);

        $this->calculateGrandTotal();

        $this->reset('searchMenuName');
    }

    public function updateQuantity($index, $quantity)
    {
        if ($quantity < 1) {
            unset($this->orders[$index]);
        } else {
            $this->orders[$index]['quantity'] = $quantity;
            $this->orders[$index]['total_price'] = $this->orders[$index]['quantity'] * $this->orders[$index]['price'];
            $this->calculateGrandTotal();
        }
    }

    public function incrementQuantity($index)
    {
        $this->orders[$index]['quantity']++;
        $this->orders[$index]['total_price'] = $this->orders[$index]['quantity'] * $this->orders[$index]['price'];
        $this->calculateGrandTotal();
    }

    public function decrementQuantity($index)
    {
        if ($this->orders[$index]['quantity'] > 1) {
            $this->orders[$index]['quantity']--;
            $this->orders[$index]['total_price'] = $this->orders[$index]['quantity'] * $this->orders[$index]['price'];
            $this->calculateGrandTotal();
        } else {
            unset($this->orders[$index]);
        }
    }

    public function getFilteredOrders()
    {
        return array_filter($this->orders, function ($order) {
            return $order['quantity'] > 0;
        });
    }

    public function calculateGrandTotal()
    {
        $this->grandTotal = array_reduce($this->getFilteredOrders(), function ($carry, $order) {
            return $carry + $order['total_price'];
        }, 0);
    }

    public function deleteCart($index)
    {
        unset($this->orders[$index]);
        $this->calculateGrandTotal();
    }

    public function storeOrders()
    {
        foreach ($this->orders as $order) {
            Order::create([
                'rental_id' => 0,
                'menu_id' => $order['id'],
                'quantity' => $order['quantity'],
                'total_price' => $order['quantity'] * $order['price']
            ]);
        }

        Income::create([
            'source' => 'other',
            'amount' => $this->grandTotal,
            'notes' => $this->orderNotes
        ]);

        $this->setNewOrderModalClose();

        toastr()->success('New order added');
    }
}
