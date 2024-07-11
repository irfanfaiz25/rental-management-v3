<div class="w-full md:w-2/3">

    <div class="flex justify-start z-50">
        <div
            class="w-full bg-white dark:bg-[#252525] drop-shadow-sm py-3 px-3 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d]">
            <div class="flex items-center space-x-2">
                <input wire:model.live.debounce.300ms='searchConsole' type="text" id="searchConsole"
                    class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium"
                    placeholder="Search ..." />
                <i class="ri-search-line"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-2 mt-3">

        @foreach ($consoles as $console)
            <div
                class="border-4 border-white bg-gradient-to-b 
            {{ $console->is_active ? 'from-[#345281] to-[#0FF0BB]' : 'from-[#BE3144] to-[#F05941]' }}
                         text-white rounded-lg shadow-md p-1 text-center h-60">
                <div class="flex justify-center mt-1">
                    <i class="ri-tv-line text-3xl"></i>
                </div>
                <h2 class="text-xl font-bold">
                    {{ $console->name }}
                </h2>
                <div class="mt-4 mb-3 flex justify-center p-2 rounded-md mx-2">
                    <p class="text-sm pt-1">
                        {{ $console->is_active ? 'Started' : 'Ready' }}
                    </p>
                    <div class="text-2xl text-white pl-1">
                        @if ($console->currentRental)
                            @hour($console->currentRental->start_time)
                        @endif
                    </div>
                </div>
                <div class="flex justify-center space-x-1">
                    @if ($console->is_active)
                        <button
                            wire:click="setEndModalOpen({{ $console->currentRental ? $console->currentRental->id : '' }})"
                            class="px-4 py-1.5 border-2 border-white hover:bg-white text-white hover:text-gray-800 text-sm rounded-md mt-4">
                            End
                        </button>
                    @else
                        <button wire:click="setStartModalOpen({{ $console->id }})"
                            class="px-4 py-1.5 border-2 border-white hover:bg-white text-white hover:text-gray-800 text-sm rounded-md mt-4">
                            Start
                        </button>
                    @endif

                    @if ($console->is_active)
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="px-3 py-1.5 border-2 border-white hover:bg-white text-white hover:text-gray-800 text-sm rounded-md mt-4">
                                Option <i class="ri-arrow-drop-down-line"></i>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="origin-top-right absolute right-0 mt-2 w-32 rounded-md shadow-lg bg-white dark:bg-[#252525] ring-1 ring-black ring-opacity-5 text-left">
                                <div class="py-1">
                                    <a href="#" @click="open = false"
                                        wire:click.prevent="setEditStartModalOpen({{ $console->currentRental ? $console->currentRental->id : null }})"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-50 hover:text-green-500 dark:hover:text-green-500 hover:bg-gray-100 dark:hover:bg-[#343434]">
                                        Edit
                                    </a>
                                    <a href="#" @click="open = false"
                                        wire:click.prevent="setNewOrderModalOpen({{ $console->currentRental ? $console->currentRental->id : '' }})"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-50 hover:text-green-500 dark:hover:text-green-500 hover:bg-gray-100 dark:hover:bg-[#343434]">
                                        New Order
                                    </a>
                                    <a href="#" @click="open = false"
                                        wire:click.prevent="setManageOrdersModalOpen({{ $console->currentRental ? $console->currentRental->id : '' }})"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-50 hover:text-green-500 dark:hover:text-green-500 hover:bg-gray-100 dark:hover:bg-[#343434]">
                                        Manage Order
                                    </a>
                                    <a href="#" @click="open = false"
                                        wire:click.prevent="setResetRentalModalOpen({{ $console->currentRental ? $console->currentRental->id : '' }})"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-50 hover:text-green-500 dark:hover:text-green-500 hover:bg-gray-100 dark:hover:bg-[#343434]">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        @endforeach

    </div>

    <div class="mt-4">
        {{ $consoles->links('vendor.livewire.tailwind') }}
    </div>


    {{-- all modals here --}}
    @if ($isStartModalShow)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div
                class="bg-white dark:bg-[#1c1c1c] dark:text-gray-50 p-6 rounded shadow-lg max-w-lg w-full relative z-10 max-h-full overflow-y-auto mx-2 lg:mx-0">
                <div class="py-3">
                    <h2 class="text-left text-2xl font-bold text-gray-800 dark:text-gray-50">
                        {{ $isEditStartTime ? 'Edit ' : '' }}Start Rental
                    </h2>
                </div>
                <form wire:submit.prevent='{{ $isEditStartTime ? 'editStartRental' : 'startRental' }}'>
                    <div class="mb-2">
                        <label for="startDate" class="block mb-1 text-sm font-bold">
                            Start Date
                        </label>
                        <input wire:model='startDate' type="date" id="startDate"
                            class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('startDate') border-red-500 @enderror" />
                        @error('startDate')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="startTime" class="block mb-1 text-sm font-bold">
                            Start Time
                        </label>
                        <input wire:model='startTime' type="time" id="startTime"
                            class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('startTime') border-red-500 @enderror" />
                        @error('startTime')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mt-5 flex justify-end space-x-2">
                        <button type="button" wire:click="setStartModalClose"
                            class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg cursor-pointer text-sm w-full sm:w-auto px-4 py-2 text-center dark:bg-red-500 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancel</button>
                        <button type="submit"
                            class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-bold rounded-lg cursor-pointer text-sm w-full sm:w-auto px-5 py-2 text-center dark:bg-green-500 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Save
                        </button>
                    </div>
                </form>
            </div>
            <!-- Background overlay -->
            <div wire:click="setStartModalClose" class="fixed inset-0 bg-black opacity-50 z-0"></div>
        </div>
    @endif

    @if ($isEndModalShow)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div
                class="bg-white dark:bg-[#1c1c1c] dark:text-gray-50 p-6 rounded shadow-lg max-w-lg w-full relative z-10 max-h-full overflow-y-auto mx-2 lg:mx-0">
                <div class="p-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">
                        Are you sure you want to end <strong>{{ $endName }}</strong>?
                    </h2>
                    <div class="mt-6 flex justify-end space-x-1">
                        <button wire:click='setEndModalClose'
                            class="px-5 py-2 bg-gray-100 rounded-md text-gray-800 font-bold text-sm hover:bg-gray-200">
                            Cancel
                        </button>
                        <button wire:click='setRentalDetails'
                            class="px-5 py-2 bg-red-500 rounded-md text-gray-50 font-bold text-sm hover:bg-red-700">
                            End
                        </button>
                    </div>
                </div>
            </div>
            <!-- Background overlay -->
            <div wire:click="setEndModalClose" class="fixed inset-0 bg-black opacity-50 z-0"></div>
        </div>
    @endif

    @if ($isNewOrderModalShow)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div
                class="bg-white dark:bg-[#1c1c1c] dark:text-gray-50 p-6 rounded shadow-lg max-w-4xl w-full relative z-10 max-h-full overflow-y-auto mx-2 lg:mx-0">
                <h2 class="text-center text-2xl font-bold">
                    New Order ({{ $newOrderConsole }})
                </h2>
                <div class="flex flex-wrap mt-2">
                    <div class="w-full md:w-1/2 px-4">
                        <h2 class="text-center">
                            <i class="ri-file-list-2-line"></i> Menu List
                        </h2>
                        <div class="mt-7 space-y-2 h-[400px] overflow-y-auto">

                            <div class="flex mb-5">
                                <div x-data="{ open: false }" class="relative">
                                    <button @click="open = !open"
                                        class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 dark:bg-[#222222] dark:hover:bg-[#292929] dark:text-white dark:border-gray-800"
                                        type="button">Categories <span><i class="ri-arrow-drop-down-line"></i></span>
                                    </button>
                                    <div x-show="open" @click.away="open = false"
                                        class="origin-top-right absolute right-0 mt-2 w-32 rounded-md shadow-lg bg-white dark:bg-[#222222] ring-1 ring-black ring-opacity-5">
                                        <div class="py-1">
                                            <a href="" wire:click.prevent="setMenuFilter(null)"
                                                @click="open = false"
                                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-50 hover:text-green-500 hover:bg-gray-100 dark:hover:bg-[#343434] {{ $menuFilter == null ? 'bg-[#e1e1e1] dark:bg-[#343434]' : '' }}">
                                                All
                                            </a>
                                            <a href="" wire:click.prevent="setMenuFilter('makanan')"
                                                @click="open = false"
                                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-50 hover:text-green-500 hover:bg-gray-100 dark:hover:bg-[#343434] {{ $menuFilter == 'makanan' ? 'bg-[#e1e1e1] dark:bg-[#343434]' : '' }}">
                                                Makanan
                                            </a>
                                            <a href="" wire:click.prevent="setMenuFilter('minuman')"
                                                @click="open = false"
                                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-50 hover:text-green-500 hover:bg-gray-100 dark:hover:bg-[#343434] {{ $menuFilter == 'minuman' ? 'bg-[#e1e1e1] dark:bg-[#343434]' : '' }}">
                                                Minuman
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative w-full">
                                    <input wire:model.live.debounce.300ms='searchMenuName' type="search"
                                        id="search-dropdown"
                                        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 dark:bg-[#222222] dark:border-s-gray-500 dark:border-gray-800 focus:outline-none dark:focus:border-gray-700 dark:placeholder-gray-400 dark:text-gray-50"
                                        placeholder="Search menu ..." required />
                                    <button type="button"
                                        class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-gray-600 bg-gray-100 dark:text-gray-50 dark:bg-neutral-700 border border-gray-300 dark:border-gray-800 rounded-e-lg"
                                        disabled>
                                        <i class="ri-search-line"></i>
                                    </button>
                                </div>
                            </div>

                            @foreach ($menus as $menu)
                                <div wire:click="addToCart({{ json_encode($menu) }})"
                                    class="flex w-full px-5 py-2.5 text-sm justify-between items-center bg-[#f2f2f2] dark:bg-[#222222] dark:hover:border dark:hover:text-green-500 border-green-500 cursor-pointer shadow-md rounded-md">
                                    <p>
                                        {{ $menu->name }}
                                    </p>
                                    <i class="ri-add-circle-fill text-lg cursor-pointer"></i>
                                </div>
                            @endforeach

                            <div class="mt-3">
                                {{ $menus->links('vendor.livewire.tailwind') }}
                            </div>

                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-4 md:border-s-2 mt-10 md:mt-0 border-gray-400">
                        <h2 class="text-center"><i class="ri-shopping-cart-fill"></i> Orders Cart</h2>
                        <div class="mt-7 space-y-2 h-[400px] overflow-y-auto">

                            @if ($orders)
                                @foreach ($orders as $index => $order)
                                    <div
                                        class="flex w-full px-5 py-2 text-sm justify-between items-center bg-[#f2f2f2] dark:bg-[#222222] shadow-md rounded-md">
                                        <p>
                                            {{ $order['name'] }}
                                        </p>
                                        <div class="flex justify-end items-center space-x-1">
                                            <i wire:click='decrementQuantity({{ $index }})'
                                                class="ri-indeterminate-circle-fill text-lg text-gray-600 dark:text-gray-50 hover:text-red-500 dark:hover:text-red-500 cursor-pointer"></i>
                                            <input type="number" min="1"
                                                class="w-10 h-8 rounded-sm bg-[#d8d8d8] dark:bg-[#1c1c1c] text-gray-800 dark:text-gray-50 text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                                wire:change="updateQuantity({{ $index }}, $event.target.value)"
                                                value="{{ $order['quantity'] }}" />
                                            <i wire:click='incrementQuantity({{ $index }})'
                                                class="ri-add-circle-fill text-lg text-gray-600 dark:text-gray-50 hover:text-green-500 dark:hover:text-green-500 cursor-pointer"></i>
                                            <i class="ri-delete-bin-6-fill text-lg text-red-500 hover:text-red-700 cursor-pointer pl-2"
                                                wire:click='deleteCart({{ $index }})'></i>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div
                                    class="flex w-full px-5 py-3 text-sm justify-start items-center bg-[#f2f2f2] dark:bg-[#222222] shadow-md rounded-md space-x-2">
                                    <img src="{{ asset('img/left.png') }}" alt="pointer" class="w-8 h-8">
                                    <p>
                                        No orders yet. Choose order first !
                                    </p>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>

                <div class="flex justify-end space-x-1 mt-4">
                    <button wire:click='setNewOrderModalClose'
                        class="px-5 py-2 bg-red-500 rounded-md text-gray-50 font-bold text-sm hover:bg-red-700">
                        Cancel
                    </button>
                    <button wire:click='storeOrders'
                        class="px-5 py-2 bg-green-500 rounded-md text-gray-50 font-bold text-sm hover:bg-green-700">
                        Save
                    </button>
                </div>

            </div>
            <!-- Background overlay -->
            <div wire:click="setNewOrderModalClose" class="fixed inset-0 bg-black opacity-50 z-0"></div>
        </div>
    @endif

    @if ($isManageOrderModalShow)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div
                class="bg-white dark:bg-[#1c1c1c] dark:text-gray-50 p-6 rounded shadow-lg max-w-lg w-full relative z-10 max-h-full overflow-y-auto mx-2 lg:mx-0">
                <div class="flex flex-wrap">
                    <div class="w-full">
                        <h2 class="text-center"><i class="ri-list-ordered"></i>
                            Manage Rental Orders
                        </h2>
                        <h2 class="text-center mt-2">
                            {{ $manageOrderConsoleName }}
                        </h2>
                        <div class="mt-7 space-y-2">

                            @if ($filteredOrders)
                                @foreach ($filteredOrders as $index => $order)
                                    <div
                                        class="flex w-full px-5 py-2 text-sm justify-between items-center bg-[#f2f2f2] dark:bg-[#222222] shadow-md rounded-md">
                                        <p>
                                            {{ $order['menu']['name'] }}
                                        </p>
                                        <div class="flex justify-end items-center space-x-1">
                                            <p class="pr-2">
                                                @currency($order['total_price'])
                                            </p>
                                            <i wire:click='decrementOrder({{ $index }})'
                                                class="ri-indeterminate-circle-fill text-lg text-gray-600 dark:text-gray-50 hover:text-red-500 dark:hover:text-red-500 cursor-pointer"></i>
                                            <input type="number" min="1"
                                                class="w-10 h-8 rounded-sm bg-[#d8d8d8] dark:bg-[#1c1c1c] text-gray-800 dark:text-gray-50 text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                                wire:change="updateOrder({{ $index }}, $event.target.value)"
                                                value="{{ $order['quantity'] }}" />
                                            <i wire:click='incrementOrder({{ $index }})'
                                                class="ri-add-circle-fill text-lg text-gray-600 dark:text-gray-50 hover:text-green-500 dark:hover:text-green-500 cursor-pointer"></i>
                                            <i class="ri-delete-bin-6-fill text-lg text-red-500 hover:text-red-700 cursor-pointer pl-2"
                                                wire:click='deleteOrder({{ $index }})'></i>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div
                                    class="flex w-full px-5 py-2 text-base justify-center items-center bg-[#f2f2f2] dark:bg-[#222222] shadow-md rounded-md">
                                    <p>No orders yet</p>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>

                <div class="flex justify-end space-x-1 mt-4">
                    <button wire:click='setManageOrdersModalClose'
                        class="px-5 py-2 bg-red-500 rounded-md text-gray-50 font-bold text-sm hover:bg-red-700">
                        Cancel
                    </button>
                    <button wire:click='saveOrders'
                        class="px-5 py-2 bg-green-500 rounded-md text-gray-50 font-bold text-sm hover:bg-green-700">
                        Save
                    </button>
                </div>

            </div>
            <!-- Background overlay -->
            <div wire:click="setManageOrdersModalClose" class="fixed inset-0 bg-black opacity-50 z-0"></div>
        </div>
    @endif

    @if ($isResetRentalModalShow)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div
                class="bg-white dark:bg-[#1c1c1c] dark:text-gray-50 p-6 rounded shadow-lg max-w-lg w-full relative z-10 max-h-full overflow-y-auto mx-2 lg:mx-0">
                <div class="p-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">
                        Are you sure you want to reset {{ $resetRentalName }}?
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Once the data is reseted, all of its resources and data
                        will be permanently deleted.
                    </p>
                    <div class="mt-6 flex justify-end space-x-1">
                        <button wire:click='setResetRentalModalClose'
                            class="px-5 py-2 bg-gray-100 rounded-md text-gray-800 font-bold text-sm hover:bg-gray-200">
                            Cancel
                        </button>
                        <button wire:click='resetRental'
                            class="px-5 py-2 bg-red-500 rounded-md text-gray-50 font-bold text-sm hover:bg-red-700">
                            End
                        </button>
                    </div>
                </div>
            </div>
            <!-- Background overlay -->
            <div wire:click="setResetRentalModalClose" class="fixed inset-0 bg-black opacity-50 z-0"></div>
        </div>
    @endif

</div>
