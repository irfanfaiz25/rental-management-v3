<div>
    <label class="inline-flex items-center mt-1 cursor-pointer">
        <input type="checkbox" wire:model.live='isMenuActive' class="sr-only peer">
        <div
            class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-green-500">
        </div>
        <span class="ms-3 text-sm font-medium text-gray-800 dark:text-gray-50">
            {{ $isMenuActive ? 'Active' : 'Inactive' }}
        </span>
    </label>
</div>
