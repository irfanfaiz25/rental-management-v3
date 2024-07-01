<div x-data="{ isSidebarVisible: @entangle('isSidebarVisible') }">
    <!-- Toggle Button -->
    <button @click="isSidebarVisible = !isSidebarVisible" class="lg:hidden p-2 fixed top-4 left-4 z-50 dark:text-gray-50">
        <i class="ri-menu-2-line"></i>
    </button>

    <!-- Overlay -->
    <div x-show="isSidebarVisible" @click="isSidebarVisible = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"></div>

    <!-- Sidebar -->
    <div :class="isSidebarVisible ? 'translate-x-0' : '-translate-x-full'"
        class="bg-[#FAFAFA] dark:bg-[#1c1c1c] fixed top-0 left-0 min-h-screen w-72 duration-500 text-gray-100 px-3 z-40 pt-20 lg:pt-10 transform lg:translate-x-0">
        <div class="flex lg:hidden items-center mt-2">
            <img src="/img/Logo.png" alt="logo" class="w-7 h-8 ml-2" />
            <h1 class="text-gray-800 dark:text-gray-50 font-semibold text-xl ml-2 font-sans">
                GGWP Gaming
            </h1>
        </div>
        <div class="mt-10 flex flex-col gap-4 relative text-gray-800 dark:text-gray-50">
            @foreach ($sidebarMenu as $menu)
                <a href="{{ route($menu['route']) }}" wire:navigate
                    class="group flex items-center text-sm h-12 gap-3.5 font-medium p-2 pl-5 hover:bg-[#f2f2f2] dark:hover:bg-[#252525] hover:text-green-500 dark:hover:text-green-500 rounded-md {{ request()->is($menu['request']) ? 'bg-[#f2f2f2] dark:bg-[#252525] text-green-500' : 'text-gray-800 dark:text-gray-50' }}">
                    <i class="{{ $menu['icon'] }} text-lg"></i>
                    <h2 class="whitespace-pre duration-300 capitalize">{{ $menu['name'] }}</h2>
                </a>
            @endforeach
        </div>
    </div>
</div>
