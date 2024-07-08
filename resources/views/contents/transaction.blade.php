@extends('layouts.main')

@section('content')
    <div class="mt-2 ml-1">
        <div class="flex flex-wrap">
            @livewire('transaction-card')

            @livewire('transaction-form')
        </div>
    </div>
@endsection
