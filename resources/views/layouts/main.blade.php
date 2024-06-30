<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>

    {{-- logo title --}}
    {{-- <link rel="icon" href="{{ asset('assets/img/logo.png') }}"> --}}

    <!-- Include Tailwind CSS -->
    @vite('resources/css/app.css')

    {{-- icon --}}
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">


    @livewireStyles
</head>

<body x-data="{ darkMode: false }" :class="{ 'dark': darkMode === true }" class="antialiased">
    @livewire('header-layout')
    <div class="relative">
        <div class="flex gap-6 pt-16">

            @livewire('sidebar-toggle')

            <div
                class="flex-1 p-4 text-xl bg-[#FAFAFA] dark:bg-[#1c1c1c] text-gray-900 dark:text-gray-50 font-semibold overflow-auto relative min-h-screen duration-500 -ml-6 lg:ml-64">
                <div class="flex justify-start z-50 mt-2">
                    <div
                        class="w-full bg-white dark:bg-[#252525] drop-shadow-sm py-5 px-4 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d]">
                        <h1 class="text-4xl font-extra-bold text-gray-800 dark:text-gray-50 capitalize">
                            Dash
                        </h1>
                        <h1 class="text-base pt-1 font-medium text-gray-800 dark:text-gray-50">
                            Rental PS Management
                        </h1>
                    </div>
                </div>
                <div class="mt-6 ml-1">
                    child
                </div>
            </div>
        </div>
    </div>


    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    @livewireScripts

</body>

</html>
