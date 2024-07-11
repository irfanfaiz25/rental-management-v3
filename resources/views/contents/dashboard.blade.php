@extends('layouts.main')

@section('content')
    <div>
        @livewire('dashboard-card')
    </div>
    <div class="mt-3">
        @livewire('dashboard-chart')
    </div>
@endsection
