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
            <a href="{{ route('dashboard.index') }}" wire:navigate
                class="group flex items-center text-sm h-12 gap-3.5 font-medium p-2 pl-5 hover:bg-green-500 hover:text-gray-50 dark:hover:text-gray-800 dark:text-gray-50 rounded-md {{ request()->is('dashboard*') ? 'bg-green-500 text-gray-50' : 'text-gray-800 ' }}">
                <i class="ri-home-2-line text-lg"></i>
                <h2 class="whitespace-pre duration-300 capitalize">Dashboard</h2>
            </a>
            <a href=""
                class="group flex items-center text-sm h-12 gap-3.5 font-medium p-2 pl-5 hover:bg-green-500 hover:text-gray-50 dark:hover:text-gray-800 dark:text-gray-50 rounded-md {{ request()->is('transaction*') ? 'bg-green-500 text-gray-50' : 'text-gray-800 ' }}">
                <i class="ri-arrow-left-right-line text-lg"></i>
                <h2 class="whitespace-pre duration-300 capitalize">Transaction</h2>
            </a>
            <a href="{{ route('console.index') }}" wire:navigate
                class="group flex items-center text-sm h-12 gap-3.5 font-medium p-2 pl-5 hover:bg-green-500 hover:text-gray-50 dark:hover:text-gray-800 dark:text-gray-50 rounded-md {{ request()->is('consoles*') ? 'bg-green-500 text-gray-50' : 'text-gray-800 ' }}">
                <i class="ri-gamepad-line text-lg"></i>
                <h2 class="whitespace-pre duration-300 capitalize">Console</h2>
            </a>
            <a href="" wire:navigate
                class="group flex items-center text-sm h-12 gap-3.5 font-medium p-2 pl-5 hover:bg-green-500 hover:text-gray-50 dark:hover:text-gray-800 dark:text-gray-50 rounded-md {{ request()->is('menus*') ? 'bg-green-500 text-gray-50' : 'text-gray-800 ' }}">
                <i class="ri-restaurant-2-line text-lg"></i>
                <h2 class="whitespace-pre duration-300 capitalize">Menu</h2>
            </a>
            <a href="" wire:navigate
                class="group flex items-center text-sm h-12 gap-3.5 font-medium p-2 pl-5 hover:bg-green-500 hover:text-gray-50 dark:hover:text-gray-800 dark:text-gray-50 rounded-md {{ request()->is('reports*') ? 'bg-green-500 text-gray-50' : 'text-gray-800 ' }}">
                <i class="ri-file-text-line text-lg"></i>
                <h2 class="whitespace-pre duration-300 capitalize">Report</h2>
            </a>
        </div>
    </div>
</div>
