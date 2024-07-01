<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('contents.dashboard');
})->name('dashboard.index');

Route::get('/consoles', function () {
    return view('contents.console');
})->name('console.index');
