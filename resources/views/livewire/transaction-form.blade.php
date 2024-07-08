<div class="w-full md:w-1/3 pl-0 md:pl-4 mt-3 md:mt-0">
    <div class="bg-white dark:bg-[#252525] rounded-lg shadow-md p-5 pt-3 pb-2">
        <h2 class="text-base font-bold mb-3">
            DATA PEMBAYARAN
        </h2>
        <div class="mb-2">
            <label for="consoleName" class="block mb-1 text-sm font-bold">
                Nama Console
            </label>
            <input wire:model='consoleName' type="text" id="consoleName"
                class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('consoleName') border-red-500 @enderror"
                readonly />
            @error('consoleName')
                <p class="mt-2 text-xs text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="mb-2">
            <label for="rentalTime" class="block mb-1 text-sm font-bold">
                Lama Main
            </label>
            <input wire:model='rentalTime' type="text" id="rentalTime"
                class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('rentalTime') border-red-500 @enderror"
                readonly />
            @error('rentalTime')
                <p class="mt-2 text-xs text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="mb-2">
            <label for="totalOrders" class="block mb-1 text-sm font-bold">
                Total Tambahan
            </label>
            <input wire:model='totalOrders' type="text" id="totalOrders"
                class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('totalOrders') border-red-500 @enderror"
                readonly />
            @error('totalOrders')
                <p class="mt-2 text-xs text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="mb-2">
            <label for="totalRental" class="block mb-1 text-sm font-bold">
                Total Rental
            </label>
            <input wire:model='totalRental' type="text" id="totalRental"
                class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('totalRental') border-red-500 @enderror"
                readonly />
            @error('totalRental')
                <p class="mt-2 text-xs text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="mb-2">
            <label for="granTotal" class="block mb-1 text-sm font-bold">
                Total Pembayaran
            </label>
            <input wire:model='granTotal' type="text" id="granTotal"
                class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('granTotal') border-red-500 @enderror"
                readonly />
            @error('granTotal')
                <p class="mt-2 text-xs text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="mb-2">
            <label for="paid" class="block mb-1 text-sm font-bold">
                Nominal yang dibayarkan
            </label>
            <input wire:model.live.debounce.300ms='paid' type="text" id="paid"
                class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('paid') border-red-500 @enderror"
                placeholder="Rp. 0" {{ !$isRequestRentalDetails ? 'readonly' : '' }} />
            @error('paid')
                <p class="mt-2 text-xs text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="mb-5">
            <label for="notes" class="block mb-1 text-sm font-bold">
                Catatan <span class="text-gray-600 dark:text-gray-300">(opsional)</span>
            </label>
            <textarea wire:model.live.debounce.300ms='notes' type="text" id="notes"
                class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium"
                {{ !$isRequestRentalDetails ? 'readonly' : '' }} rows="3">
            </textarea>
        </div>
        <div class="flex space-x-1 mb-3">
            <button wire:click='resetRentalDetails'
                class="w-full py-1.5 text-sm border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-gray-50 rounded-md">
                Reset
            </button>
            <button wire:click='setPayment'
                class="w-full py-1.5 text-sm border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-gray-50 rounded-md">
                Payment
            </button>
        </div>
    </div>
    <div class="bg-white dark:bg-[#252525] rounded-lg shadow-md p-5 pt-3 mt-3">
        <h2 class="text-base font-bold mb-3">PEMBELIAN TUNAI</h2>
        <div class="flex space-x-1 mb-3">
            <button wire:click='setNewOrderModalOpen'
                class="w-full py-1.5 text-sm border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-gray-50 rounded-md">
                New Order
            </button>
        </div>
    </div>

    @if ($isNewOrderModalShow)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div
                class="bg-white dark:bg-[#1c1c1c] dark:text-gray-50 p-6 rounded shadow-lg max-w-4xl w-full relative z-10 max-h-full overflow-y-auto mx-2 lg:mx-0">
                <h2 class="text-center text-2xl font-bold">
                    New Order (Cash)
                </h2>
                <div class="flex flex-wrap mt-2">
                    <div class="w-full md:w-1/2 px-4">
                        <h2 class="text-center">
                            <i class="ri-file-list-2-line"></i> Menu List
                        </h2>
                        <div class="mt-7 space-y-2 h-[380px] overflow-y-auto">

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
                                {{ $menus->links('vendor.livewire.tailwind', data: ['scrollTo' => false]) }}
                            </div>

                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-4 md:border-s-2 mt-10 md:mt-0 border-gray-400">
                        <h2 class="text-center"><i class="ri-shopping-cart-fill"></i> Orders Cart</h2>
                        <div class="mt-7 space-y-2 h-[330px] overflow-y-auto">

                            @if ($orders)
                                @foreach ($orders as $index => $order)
                                    <div
                                        class="flex w-full px-5 py-2 text-sm justify-between items-center bg-[#f2f2f2] dark:bg-[#222222] shadow-md rounded-md">
                                        <p>
                                            {{ $order['name'] }}
                                        </p>
                                        <div class="flex justify-end items-center space-x-1">
                                            <p>
                                                @currency($order['total_price'])
                                            </p>
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

                        <div class="flex justify-end mt-2 space-x-1 pr-5 text-gray-800 dark:text-gray-50">
                            <p class="text-sm font-semibold">
                                Total :
                            </p>
                            <h2 class="text-3xl font-bold">
                                @currency($grandTotal)
                            </h2>
                        </div>
                    </div>

                </div>

                <div class="flex justify-end space-x-1 mt-4 mr-8">
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

</div>
