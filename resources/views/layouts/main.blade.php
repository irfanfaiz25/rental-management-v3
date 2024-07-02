<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: true }" :class="{ 'dark': darkMode === true }" class="antialiased">

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

<body class="bg-[#FAFAFA] dark:bg-[#1c1c1c]">

    @livewire('header-layout')

    <div class="relative">
        <div class="flex gap-6 pt-16">

            @livewire('sidebar-toggle')

            <div
                class="flex-1 p-4 text-xl bg-[#FAFAFA] dark:bg-[#1c1c1c] text-gray-900 dark:text-gray-50 font-semibold overflow-auto relative min-h-screen duration-500 -ml-5 lg:ml-72">

                @yield('content')

            </div>
        </div>
    </div>


    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    @livewireScripts

</body>

</html>
