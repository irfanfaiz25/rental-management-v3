@extends('layouts.main')

@section('content')
    <div class="mt-2">
        <div class="flex flex-wrap">
            @livewire('transaction-card')

            @livewire('transaction-form')
        </div>
    </div>
@endsection
