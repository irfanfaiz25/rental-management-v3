<div>
    <div class="block md:flex justify-between items-center mb-3 space-y-2 md:space-x-1 md:space-y-0">
        <div class="block md:flex justify-start items-center space-y-1 md:space-x-1 md:space-y-0">
            <button wire:click="setFilter(null)"
                class="px-6 py-1 border-2 border-green-500 {{ $filterCategory == null ? 'bg-green-500 text-gray-50' : 'text-gray-800' }} hover:bg-green-500 hover:text-gray-50 dark:text-gray-50 rounded-full text-sm font-semibold capitalize">
                all
            </button>
            <button wire:click="setFilter('makanan')"
                class="px-6 py-1 border-2 border-green-500 {{ $filterCategory == 'makanan' ? 'bg-green-500 text-gray-50' : 'text-gray-800' }}  hover:bg-green-500 hover:text-gray-50 dark:text-gray-50 rounded-full text-sm font-semibold capitalize">
                makanan
            </button>
            <button wire:click="setFilter('minuman')"
                class="px-6 py-1 border-2 border-green-500 {{ $filterCategory == 'minuman' ? 'bg-green-500 text-gray-50' : 'text-gray-800' }}  hover:bg-green-500 hover:text-gray-50 dark:text-gray-50 rounded-full text-sm font-semibold capitalize">
                minuman
            </button>
        </div>
        <button wire:click="$set('isModalShow', true)"
            class="px-6 py-2 bg-green-500 hover:bg-green-700 text-gray-50 rounded-md text-sm font-semibold">
            New Menu
        </button>
    </div>
    <div class="relative overflow-x-auto drop-shadow-lg sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-50">
            <thead class="text-xs font-bold text-gray-700 uppercase bg-gray-100 dark:bg-[#252525] dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
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
                @foreach ($menus as $index => $menu)
                    <tr
                        class="odd:bg-white odd:dark:bg-[#343434] even:bg-gray-50 even:dark:bg-[#383838] border-b dark:border-[#414040]">
                        <td class="px-6 py-3">
                            {{ $menus->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-3 capitalize">
                            {{ $menu->name }}
                        </td>
                        <td class="px-6 py-3 capitalize">
                            {{ $menu->category }}
                        </td>
                        <td class="px-6 py-3">
                            @currency($menu->price)
                        </td>
                        <td class="px-6 py-3">
                            @livewire('toggle-is-menu-active', ['menu' => $menu], key($menu->id))
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex justify-start items-center space-x-1">
                                <button wire:click='setModalEdit({{ $menu->id }})'
                                    class="text-green-500 hover:text-white border border-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-semibold rounded-lg text-xs px-4 py-1 text-center dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                                    Edit
                                </button>
                                <button wire:click="showConfirmationDelete({{ $menu->id }},'{{ $menu->name }}')"
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

    <div class="mt-4">
        {{ $menus->links() }}
    </div>

    @if ($isModalShow)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div
                class="bg-white dark:bg-[#1c1c1c] dark:text-gray-50 p-6 rounded shadow-lg max-w-lg w-full relative z-10 max-h-full overflow-y-auto mx-2 lg:mx-0">
                <div class="py-3">
                    <h2 class="text-left text-2xl font-bold text-gray-800 dark:text-gray-50">
                        {{ $isEdit ? 'Edit Data' : 'Add Data' }}
                    </h2>
                </div>
                <form wire:submit.prevent='{{ $isEdit ? 'updateMenu' : 'storeMenu' }}'>
                    <div class="mb-2">
                        <label for="name" class="block mb-1 text-sm font-bold">
                            Menu Name
                        </label>
                        <input wire:model='name' type="text" id="name"
                            class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('name') border-red-500 @enderror" />
                        @error('name')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="category" class="block mb-1 text-sm font-bold">
                            Model
                        </label>
                        <select wire:model='category' type="text" id="category"
                            class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 py-2.5 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('category') border-red-500 @enderror">
                            <option value="">--pilih category--</option>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                        @error('category')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="price" class="block mb-1 text-sm font-bold">
                            Price
                        </label>
                        <input wire:model='price' type="text" id="price"
                            class="bg-gray-50 outline-none border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-[#343434] dark:border-gray-500 dark:text-gray-50 dark:focus:ring-green-500 dark:focus:border-green-500 font-medium @error('price') border-red-500 @enderror" />
                        @error('price')
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

    @if ($isConfirmationModal)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div
                class="bg-white dark:bg-[#1c1c1c] dark:text-gray-50 p-6 rounded shadow-lg max-w-lg w-full relative z-10 max-h-full overflow-y-auto mx-2 lg:mx-0">
                <div class="p-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">
                        Are you sure you want to delete {{ $deleteName }}?
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-50">
                        Once the data is deleted, all of its resources and data
                        will be permanently deleted.
                    </p>
                    <div class="mt-6 flex justify-end space-x-1">
                        <button wire:click='closeConfirmationDelete'
                            class="px-5 py-2 bg-gray-100 rounded-md text-gray-800 font-bold text-sm hover:bg-gray-200">
                            Cancel
                        </button>
                        <button wire:click='deleteMenu'
                            class="px-5 py-2 bg-red-500 rounded-md text-gray-50 font-bold text-sm hover:bg-red-700">
                            Delete Data
                        </button>
                    </div>
                </div>
            </div>
            <!-- Background overlay -->
            <div wire:click="closeConfirmationDelete" class="fixed inset-0 bg-black opacity-50 z-0"></div>
        </div>
    @endif

</div>
