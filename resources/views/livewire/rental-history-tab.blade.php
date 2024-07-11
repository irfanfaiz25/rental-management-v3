<div>
    <div class="block md:flex justify-start z-50 mt-3 space-y-1 md:space-y-0 md:space-x-2">
        <div
            class="flex items-center bg-white space-x-2 dark:bg-[#252525] drop-shadow-sm py-3 px-3 w-full rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d]">
            <input wire:model.live.debounce.300ms='search' type="text" id="search"
                class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium"
                placeholder="Search ..." />
            <i class="ri-search-line"></i>
        </div>
        <div
            class="w-full md:w-96 flex justify-center items-center bg-white dark:bg-[#252525] drop-shadow-sm py-3 px-3 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d] space-x-1">
            <div class="flex items-center space-x-2">
                <input wire:model.live.debounce.300ms='dateFilterStart' type="date" id="searchConsole"
                    class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium" />
            </div>
            <p class="text-base font-bold">
                -
            </p>
            <div class="flex items-center space-x-2">
                <input wire:model.live.debounce.300ms='dateFilterEnd' type="date" id="searchConsole"
                    class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium" />
                <i class="ri-filter-line"></i>
            </div>
        </div>
        <div
            class="w-full md:w-32 flex justify-center items-center bg-white dark:bg-[#252525] drop-shadow-sm py-3 px-3 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d] space-x-1">
            <button wire:click='resetRentalFilter'
                class="flex justify-center w-full text-base font-semibold px-5 py-2 bg-red-500 text-gray-50 hover:bg-red-700 rounded-md">
                Reset
                <i class="ri-filter-off-line pl-1"></i>
            </button>
        </div>
    </div>

    <div class="relative overflow-x-auto drop-shadow-lg sm:rounded-lg mt-3">
        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-50">
            <thead class="text-xs font-bold text-gray-700 uppercase bg-gray-100 dark:bg-[#252525] dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Console Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Start Time
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        End Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rentals as $index => $rental)
                    <tr
                        class="odd:bg-white odd:dark:bg-[#343434] even:bg-gray-50 even:dark:bg-[#383838] border-b dark:border-[#414040]">
                        <td class="px-6 py-3">
                            {{ $rentals->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-3 capitalize">
                            {{ $rental->console->name }}
                        </td>
                        <td class="px-6 py-3 capitalize">
                            <div class="flex justify-center">
                                <div class="text-xs px-1 py-1 w-36 rounded-full text-center bg-green-500 text-gray-50">
                                    @date($rental->start_time)
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex justify-center">
                                <div class="text-xs px-1 py-1 w-36 rounded-full text-center bg-red-500 text-gray-50">
                                    @date($rental->end_time)
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3">
                            <div class="w-24">
                                @currency($rental->total_price)
                            </div>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex justify-start items-center space-x-1">
                                <button
                                    class="text-green-500 hover:text-white border border-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-semibold rounded-lg text-xs px-4 py-1 text-center dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                                    Edit
                                </button>
                                <button
                                    class="text-red-500 hover:text-white border border-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-semibold rounded-lg text-xs px-4 py-1 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-800">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $rentals->links('vendor.livewire.tailwind', data: ['scrollTo' => false]) }}
    </div>
</div>
