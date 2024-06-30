<div class="border-t border-gray-200/80 dark:border-[#3c3c3c] flex justify-center">
    <div class="mx-4 my-2">
        <div class="flex z-50 space-x-1">
            <div class="rounded-md cursor-pointer hover:text-gray-500 px-7 py-2 duration-200" @click="darkMode= false"
                :class="darkMode ? 'text-gray-800 dark:text-gray-50' : 'bg-gray-100 text-green-500'">
                <i class="ri-sun-line text-lg"></i>
            </div>
            <div class="rounded-md cursor-pointer hover:text-gray-500 px-7 py-2 duration-200" @click="darkMode= true"
                :class="darkMode ? 'bg-[#303030] text-green-500' : 'text-gray-800'">
                <i class="ri-moon-fill text-lg"></i>
            </div>
        </div>
    </div>
</div>
