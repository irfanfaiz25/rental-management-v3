<div>
    <div class="block md:flex justify-start mt-3 space-y-1 md:space-y-0 md:space-x-1">
        {{-- <div class="flex justify-start py-3 px-3 w-full md:w-1/3">
            <div class="block md:flex justify-start items-center space-y-1 md:space-x-1 md:space-y-0">
                <button wire:click="setExpenditureFilter('today')"
                    class="px-6 py-1 border-2 border-green-500 {{ $expenditureFilter == 'today' ? 'bg-green-500 text-gray-50' : 'text-gray-800' }}  hover:bg-green-500 hover:text-gray-50 dark:text-gray-50 rounded-full text-sm font-semibold capitalize">
                    Today
                </button>
                <button wire:click="setExpenditureFilter('week')"
                    class="px-4 py-1 border-2 border-green-500 {{ $expenditureFilter == 'week' ? 'bg-green-500 text-gray-50' : 'text-gray-800' }}  hover:bg-green-500 hover:text-gray-50 dark:text-gray-50 rounded-full text-sm font-semibold capitalize">
                    Week
                </button>
                <button wire:click="setExpenditureFilter('month')"
                    class="px-4 py-1 border-2 border-green-500 {{ $expenditureFilter == 'month' ? 'bg-green-500 text-gray-50' : 'text-gray-800' }}  hover:bg-green-500 hover:text-gray-50 dark:text-gray-50 rounded-full text-sm font-semibold capitalize">
                    Month
                </button>
            </div>
        </div> --}}
        <div
            class="w-full block lg:flex space-y-1 lg:space-y-0 justify-between items-center bg-white dark:bg-[#252525] drop-shadow-sm py-3 px-3 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d] space-x-1">
            <div class="block md:flex justify-start items-center space-y-1 md:space-x-1 md:space-y-0">
                <button wire:click="setExpenditureFilter('today')"
                    class="px-6 py-1 border-2 border-green-500 {{ $expenditureFilter == 'today' ? 'bg-green-500 text-gray-50' : 'text-gray-800' }}  hover:bg-green-500 hover:text-gray-50 dark:text-gray-50 rounded-full text-sm font-semibold capitalize">
                    Today
                </button>
                <button wire:click="setExpenditureFilter('week')"
                    class="px-4 py-1 border-2 border-green-500 {{ $expenditureFilter == 'week' ? 'bg-green-500 text-gray-50' : 'text-gray-800' }}  hover:bg-green-500 hover:text-gray-50 dark:text-gray-50 rounded-full text-sm font-semibold capitalize">
                    This Week
                </button>
                <button wire:click="setExpenditureFilter('month')"
                    class="px-4 py-1 border-2 border-green-500 {{ $expenditureFilter == 'month' ? 'bg-green-500 text-gray-50' : 'text-gray-800' }}  hover:bg-green-500 hover:text-gray-50 dark:text-gray-50 rounded-full text-sm font-semibold capitalize">
                    This Month
                </button>
            </div>
            <div class="flex items-center space-x-0">
                <div class="flex items-center space-x-2 w-full">
                    <input wire:model.live.debounce.300ms='dateFilterStart' type="date" id="searchConsole"
                        class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500" />
                </div>
                <p class="text-base font-bold">
                    -
                </p>
                <div class="flex items-center space-x-2 w-full">
                    <input wire:model.live.debounce.300ms='dateFilterEnd' type="date" id="searchConsole"
                        class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium" />
                    <i class="ri-filter-line"></i>
                </div>
            </div>
        </div>
        <div
            class="w-full md:w-96 flex justify-center items-center bg-white dark:bg-[#252525] drop-shadow-sm py-3 px-3 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d] space-x-1">
            <button wire:click='resetFilter'
                class="flex justify-center w-full text-base font-semibold px-5 py-2 bg-red-500 text-gray-50 hover:bg-red-700 rounded-md">
                Reset
                <i class="ri-filter-off-line pl-1"></i>
            </button>
            <button wire:click='setModalOpen'
                class="flex justify-center w-full text-base font-semibold px-5 py-2 bg-green-500 text-gray-50 hover:bg-green-700 rounded-md">
                New
                <i class="ri-add-line pl-1"></i>
            </button>
        </div>
    </div>

    <div class="block md:flex justify-center mt-3 space-y-2 md:space-y-0 md:space-x-3">
        <div
            class="w-full md:w-96 h-44 bg-white dark:bg-[#252525] drop-shadow-sm py-7 px-5 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d]">
            <div class="flex justify-between">
                <h1 class="text-xl font-extra-bold text-gray-800 dark:text-gray-50 capitalize">
                    Total Expenditure
                </h1>
                <i class="ri-arrow-up-down-line text-5xl text-red-600"></i>
            </div>
            <h1 class="text-4xl font-bold pt-5 text-right">
                @currency($expenditureTotal)
            </h1>
        </div>
    </div>

    <div class="relative overflow-x-auto drop-shadow-lg sm:rounded-lg mt-3">
        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-50">
            <thead class="text-xs font-bold text-gray-700 uppercase bg-gray-100 dark:bg-[#252525] dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Expend Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Amount
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Notes
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expenditures as $index => $expenditure)
                    <tr
                        class="odd:bg-white odd:dark:bg-[#343434] even:bg-gray-50 even:dark:bg-[#383838] border-b dark:border-[#414040]">
                        <td class="px-6 py-3">
                            {{ $expenditures->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-3 capitalize">
                            <div class="flex justify-center">
                                <div class="text-xs px-1 py-1 w-28 rounded-full text-center bg-green-500 text-gray-50">
                                    @justDate($expenditure->expend_date)
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3 capitalize">
                            {{ $expenditure->name }}
                        </td>
                        <td class="px-6 py-3">
                            <div class="w-24">
                                @currency($expenditure->amount)
                            </div>
                        </td>
                        <td class="px-6 py-3 capitalize">
                            {{ $expenditure->notes }}
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex justify-center items-center space-x-1">
                                <button wire:click="setModalEditOpen({{ $expenditure->id }})"
                                    class="text-green-500 hover:text-white border border-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-semibold rounded-lg text-xs px-4 py-1 text-center dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                                    Edit
                                </button>
                                <button wire:click="setConfirmationModalOpen({{ $expenditure->id }})"
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
        {{ $expenditures->links('vendor.livewire.tailwind', data: ['scrollTo' => false]) }}
    </div>

    @if ($isModalShow)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div
                class="bg-white dark:bg-[#1c1c1c] dark:text-gray-50 p-6 rounded shadow-lg max-w-lg w-full relative z-10 max-h-full overflow-y-auto mx-2 lg:mx-0">
                <div class="py-3">
                    <h2 class="text-left text-2xl font-bold text-gray-800 dark:text-gray-50">
                        Add Expenditure
                    </h2>
                </div>
                <form wire:submit.prevent='{{ $isEdit ? 'updateExpenditure' : 'storeExpenditure' }}'>
                    <div class="mb-2">
                        <label for="date" class="block mb-1 text-sm font-bold">
                            Date
                        </label>
                        <input wire:model='date' type="date" id="date"
                            class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('date') border-red-500 @enderror" />
                        @error('date')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="block mb-1 text-sm font-bold">
                            Name
                        </label>
                        <input wire:model='name' type="text" id="name"
                            class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 py-2.5 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="amount" class="block mb-1 text-sm font-bold">
                            Amount
                        </label>
                        <input wire:model='amount' type="text" id="amount"
                            class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('amount') border-red-500 @enderror" />
                        @error('amount')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="notes" class="block mb-1 text-sm font-bold">
                            Notes
                        </label>
                        <textarea wire:model='notes' type="text" id="notes" rows="3"
                            class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('notes') border-red-500 @enderror">
                        </textarea>
                        @error('notes')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mt-5 flex justify-end space-x-2">
                        <button type="button" wire:click="setModalClose"
                            class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg cursor-pointer text-sm w-full sm:w-auto px-4 py-2 text-center dark:bg-red-500 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancel</button>
                        <button type="submit"
                            class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-bold rounded-lg cursor-pointer text-sm w-full sm:w-auto px-5 py-2 text-center dark:bg-green-500 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Save
                        </button>
                    </div>
                </form>
            </div>
            <!-- Background overlay -->
            <div wire:click="setModalClose" class="fixed inset-0 bg-black opacity-50 z-0"></div>
        </div>
    @endif

    @if ($isConfirmationModalShow)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div
                class="bg-white dark:bg-[#1c1c1c] dark:text-gray-50 p-6 rounded shadow-lg max-w-lg w-full relative z-10 max-h-full overflow-y-auto mx-2 lg:mx-0">
                <div class="p-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">
                        Are you sure you want to delete <strong>{{ $deleteName }}</strong>?
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Once the data is deleted, all of its resources and data
                        will be permanently deleted.
                    </p>
                    <div class="mt-6 flex justify-end space-x-1">
                        <button wire:click='setConfirmationModalClose'
                            class="px-5 py-2 bg-gray-100 rounded-md text-gray-800 font-bold text-sm hover:bg-gray-200">
                            Cancel
                        </button>
                        <button wire:click='deleteExpenditure'
                            class="px-5 py-2 bg-red-500 rounded-md text-gray-50 font-bold text-sm hover:bg-red-700">
                            Delete Data
                        </button>
                    </div>
                </div>
            </div>
            <!-- Background overlay -->
            <div wire:click="setConfirmationModalClose" class="fixed inset-0 bg-black opacity-50 z-0"></div>
        </div>
    @endif

</div>
