@extends('layouts.main')

@section('content')
    <div class="flex justify-start z-50 mt-2">
        <div
            class="w-full bg-white dark:bg-[#252525] drop-shadow-sm py-5 px-4 rounded-md border-2 border-gray-200/80 dark:border-[#2d2d2d]">
            <h1 class="text-4xl font-extra-bold text-gray-800 dark:text-gray-50 capitalize">
                Report
            </h1>
            <h1 class="text-base pt-1 font-medium text-gray-800 dark:text-gray-50">
                Rental PS Management
            </h1>
        </div>
    </div>
    <div class="mt-6">

        @livewire('report-tabs')

    </div>
@endsection
