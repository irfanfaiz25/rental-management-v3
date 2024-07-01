<div
    class="fixed w-full z-50 bg-white dark:bg-[#252525] text-gray-800 dark:text-gray-50 flex justify-end lg:justify-between items-center px-4 py-4 shadow-md">
    <div class="hidden lg:flex items-center">
        <img src="/img/Logo.png" alt="logo" class="w-7 h-8 ml-2" />
        <h1 class="text-gray-800 dark:text-gray-50 font-semibold text-xl ml-2 font-sans">
            GGWP Gaming
        </h1>
    </div>
    <div class="relative flex items-center space-x-4">
        <!-- Profile Toggle Button -->
        <button wire:click='profileToggle' class="focus:outline-none">
            <i class="ri-account-circle-line text-3xl"></i>
        </button>

        <!-- Dropdown Menu -->
        @if ($isProfileButtonVisible)
            <div
                class="absolute top-10 right-0 mt-2 w-52 bg-white dark:bg-[#252525] text-gray-800 dark:text-gray-50 border dark:border-[#3c3c3c] rounded shadow-lg z-50">
                <div class="py-2">
                    <div class="px-4 pt-1 pb-2">
                        <div class="flex items-center space-x-2 pl-1 py-1">
                            <i class="ri-account-circle-line text-2xl"></i>
                            <span class="font-semibold">Aji</span>
                        </div>
                    </div>

                    @include('components.theme-toggle')

                    <div class="border-t border-gray-200/80 dark:border-[#3c3c3c]">
                        <div class="mx-1 pt-2">
                            <div
                                class="hover:bg-gray-200 dark:hover:bg-[#373636] px-4 py-2 rounded-md flex items-center space-x-2 text-sm cursor-pointer">
                                <i class="ri-logout-circle-line text-xl"></i>
                                <span>Sign out</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>