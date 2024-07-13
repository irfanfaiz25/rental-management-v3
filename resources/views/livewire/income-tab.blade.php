<div>
    <div class="block md:flex justify-start mt-3 space-y-1 md:space-y-0 md:space-x-2">
        <div class="flex justify-start py-3 px-3 w-full">
            <div class="block md:flex justify-start items-center space-y-1 md:space-x-1 md:space-y-0">
                <button wire:click="setIncomeFilter('today')"
                    class="px-6 py-1 border-2 border-green-500 {{ $incomeFilter == 'today' ? 'bg-green-500 text-gray-50' : 'text-gray-800' }}  hover:bg-green-500 hover:text-gray-50 dark:text-gray-50 rounded-full text-sm font-semibold capitalize">
                    Today
                </button>
                <button wire:click="setIncomeFilter('yesterday')"
                    class="px-4 py-1 border-2 border-green-500 {{ $incomeFilter == 'yesterday' ? 'bg-green-500 text-gray-50' : 'text-gray-800' }}  hover:bg-green-500 hover:text-gray-50 dark:text-gray-50 rounded-full text-sm font-semibold capitalize">
                    Yesterday
                </button>
                @role('super admin')
                    <button wire:click="setIncomeFilter('week')"
                        class="px-4 py-1 w-32 border-2 border-green-500 {{ $incomeFilter == 'week' ? 'bg-green-500 text-gray-50' : 'text-gray-800' }}  hover:bg-green-500 hover:text-gray-50 dark:text-gray-50 rounded-full text-sm font-semibold capitalize">
                        This Week
                    </button>
                @endrole
            </div>
        </div>
        @role('super admin')
            <div
                class="w-full md:w-96 flex justify-center items-center bg-white dark:bg-[#252525] drop-shadow-sm py-3 px-3 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d] space-x-1">
                <div class="flex items-center space-x-2">
                    <input wire:model.live.debounce.300ms='dateFilterStart' type="date" id="searchConsole"
                        class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium" />
                    <p class="text-base font-bold">
                        -
                    </p>
                    <div class="flex items-center space-x-2">
                        <input wire:model.live.debounce.300ms='dateFilterEnd' type="date" id="searchConsole"
                            class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium" />
                        <i class="ri-filter-line"></i>
                    </div>
                </div>
            </div>
            <div
                class="w-full md:w-32 flex justify-center items-center bg-white dark:bg-[#252525] drop-shadow-sm py-3 px-3 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d] space-x-1">
                <button wire:click='resetFilter'
                    class="flex justify-center w-full text-base font-semibold px-5 py-2 bg-red-500 text-gray-50 hover:bg-red-700 rounded-md">
                    Reset
                    <i class="ri-filter-off-line pl-1"></i>
                </button>
            </div>
        @endrole
    </div>

    <div class="block md:flex justify-start mt-3 space-y-2 md:space-y-0 md:space-x-3">
        <div
            class="w-full h-44 bg-white dark:bg-[#252525] drop-shadow-sm py-7 px-5 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d]">
            <div class="flex justify-between">
                <h1 class="text-xl font-extra-bold text-gray-800 dark:text-gray-50 capitalize">
                    Total Income
                </h1>
                <i class="ri-hand-coin-line text-5xl text-yellow-500"></i>
            </div>
            <h1 class="sm:text-3xl lg:text-4xl font-bold pt-5 text-right">
                @currency($totalIncome)
            </h1>
        </div>
        <div
            class="w-full h-44 bg-white dark:bg-[#252525] drop-shadow-sm py-7 px-5 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d]">
            <div class="flex justify-between">
                <h1 class="text-xl font-extra-bold text-gray-800 dark:text-gray-50 capitalize">
                    Rental Income
                </h1>
                <i class="ri-gamepad-line text-5xl text-teal-500"></i>
            </div>
            <h1 class="sm:text-3xl lg:text-4xl font-bold pt-5 text-right">
                @currency($rentalsIncome)
            </h1>
        </div>
        <div
            class="w-full h-44 bg-white dark:bg-[#252525] drop-shadow-sm py-7 px-5 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d]">
            <div class="flex justify-between">
                <h1 class="text-xl font-extra-bold text-gray-800 dark:text-gray-50 capitalize">
                    Others Income
                </h1>
                <i class="ri-restaurant-2-line text-5xl text-blue-500"></i>
            </div>
            <h1 class="sm:text-3xl lg:text-4xl font-bold pt-5 text-right">
                @currency($othersIncome)
            </h1>
        </div>
    </div>
    <div class="block md:flex justify-start mt-3 space-y-2 md:space-y-0 md:space-x-3">
        <div
            class="w-1/2 h-44 bg-white dark:bg-[#252525] drop-shadow-sm py-7 px-5 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d]">
            <div class="flex justify-between">
                <h1 class="text-xl font-extra-bold text-gray-800 dark:text-gray-50 capitalize">
                    Today's Profit
                </h1>
                <i class="ri-coins-line text-5xl text-green-500"></i>
            </div>
            <h1 class="sm:text-3xl lg:text-4xl font-bold pt-5 text-right">
                @currency($totalProfit)
            </h1>
        </div>
        <div
            class="w-1/2 h-44 bg-white dark:bg-[#252525] drop-shadow-sm py-4 px-5 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d]">
            <div class="flex justify-between">
                <h1 class="text-xl font-extra-bold text-gray-800 dark:text-gray-50 capitalize">
                    Set Report
                </h1>
                <i class="ri-file-edit-line text-5xl text-gray-50"></i>
            </div>
            <div class="flex items-center w-full space-x-2">
                <input wire:model.live.debounce.300ms='dateFilterStartPdf' type="date" id="searchConsole"
                    class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-40 p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium" />
                <p class="text-base font-bold">
                    -
                </p>
                <div class="flex items-center space-x-2">
                    <input wire:model.live.debounce.300ms='dateFilterEndPdf' type="date" id="searchConsole"
                        class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-40 p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium" />
                </div>
            </div>
            <div class="mt-3 flex justify-end">
                <button wire:click='downloadReport'
                    class="flex justify-center text-base font-semibold px-5 py-1.5 bg-red-500 text-gray-50 hover:bg-red-700 rounded-md">
                    Download <i class="ri-download-2-line pl-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>
