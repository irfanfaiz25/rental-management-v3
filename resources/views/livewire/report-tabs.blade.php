<div>
    <div class="block md:flex justify-center space-y-1 md:space-y-0 md:space-x-4">
        <button wire:click="setTabsPage('incomes')"
            class="flex w-full items-center justify-center px-6 py-4 bg-white dark:bg-[#252525] {{ $tabsPage == 'incomes' ? 'text-green-500' : 'text-gray-800 dark:text-gray-50' }} hover:text-green-500 dark:hover:text-green-500 text-sm font-semibold capitalize rounded-lg shadow-lg">
            <i class="ri-gamepad-fill text-base pr-2"></i>
            Incomes
        </button>
        <button wire:click="setTabsPage('rentalsHistory')"
            class="flex w-full items-center justify-center px-6 py-4 bg-white dark:bg-[#252525] {{ $tabsPage == 'rentalsHistory' ? 'text-green-500' : 'text-gray-800 dark:text-gray-50' }} hover:text-green-500 dark:hover:text-green-500 text-sm font-semibold capitalize rounded-lg shadow-lg">
            <i class="ri-gamepad-fill text-base pr-2"></i>
            Rentals History
        </button>
        <button wire:click="setTabsPage('ordersHistory')"
            class="flex w-full items-center justify-center px-6 py-4 bg-white dark:bg-[#252525] {{ $tabsPage == 'ordersHistory' ? 'text-green-500' : 'text-gray-800 dark:text-gray-50' }} hover:text-green-500 dark:hover:text-green-500 text-sm font-semibold capitalize rounded-lg shadow-lg">
            <i class="ri-restaurant-2-fill text-base pr-2"></i>
            Orders History
        </button>
        <button wire:click="setTabsPage('expenditures')"
            class="flex w-full items-center justify-center px-6 py-4 bg-white dark:bg-[#252525] {{ $tabsPage == 'expenditures' ? 'text-green-500' : 'text-gray-800 dark:text-gray-50' }} hover:text-green-500 dark:hover:text-green-500 text-sm font-semibold capitalize rounded-lg shadow-lg">
            <i class="ri-creative-commons-nc-fill text-base pr-2"></i>
            Expenditure
        </button>
    </div>

    @if ($tabsPage == 'incomes')
        @livewire('income-tab')
    @elseif ($tabsPage == 'rentalsHistory')
        @livewire('rental-history-tab')
    @elseif ($tabsPage == 'ordersHistory')
        @livewire('order-history-tab')
    @else
        <h2 class="text-3xl text-white">
            Expenditures
        </h2>
    @endif

</div>
