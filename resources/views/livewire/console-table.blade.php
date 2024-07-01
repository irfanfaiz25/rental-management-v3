<div>
    <div class="flex justify-end items-center mb-3">
        <button wire:click="$set('isAddModalShow', true)"
            class="px-6 py-2 bg-green-500 hover:bg-green-700 text-gray-50 rounded-md text-sm">
            New Console
        </button>
    </div>
    <div class="relative overflow-x-auto drop-shadow-lg sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs font-bold text-gray-700 uppercase bg-gray-100 dark:bg-[#252525] dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Model
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consoles as $index => $console)
                    <tr
                        class="odd:bg-white odd:dark:bg-[#343434] even:bg-gray-50 even:dark:bg-[#383838] border-b dark:border-[#414040]">
                        <td class="px-6 py-3">
                            {{ $consoles->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $console->name }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $console->model }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $console->price }}
                        </td>
                        <td class="px-6 py-3">
                            <span class="flex items-center text-sm font-medium text-gray-800 dark:text-gray-50 me-3">
                                <span
                                    class="flex w-2 h-2 {{ $console->is_active ? 'bg-green-500' : 'bg-red-500' }} rounded-full me-1.5 flex-shrink-0"></span>

                            </span>
                            {{ $console->is_active ? 'Active' : 'Inactive' }}
                        </td>
                        <td class="px-6 py-3">

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($isAddModalShow)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div
                class="bg-white p-6 rounded shadow-lg max-w-lg w-full relative z-10 max-h-full overflow-y-auto mx-2 lg:mx-0">
                <form wire:submit.prevent='storeConsole'>
                    <div>
                        <label for="consoleName" class="block mb-2 text-sm font-medium text-gray-900">
                            Console Name
                        </label>
                        <input wire:model='consoleName' type="text" id="text"
                            class="bg-gray-50 border border-gray-300 
        @error('consoleName')
        border-red-600    
        @enderror text-gray-900 text-sm rounded-lg focus:outline-green-500 focus:ring-green-500 focus:border-green-500 block w-full p-2" />
                        @error('consoleName')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" wire:click="$set('isAddModalShow', false)"
                            class="px-4 py-1.5 bg-gray-300 hover:bg-gray-500 hover:text-white rounded text-sm font-medium">Cancel</button>
                        <button type="submit"
                            class="px-4 py-1.5 bg-green-500 hover:bg-green-700 text-white rounded text-sm font-medium">Tambah</button>
                    </div>
                </form>
            </div>
            <!-- Background overlay -->
            <div wire:click="$set('isAddModalShow', false)" class="fixed inset-0 bg-black opacity-50 z-0"></div>
        </div>
    @endif

</div>
