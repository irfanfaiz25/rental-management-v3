<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('contents.dashboard');
})->name('dashboard.index');

Route::get('/consoles', function () {
    return view('contents.console');
})->name('console.index');

Route::get('/transactions', function () {
    return view('contents.console');
})->name('transaction.index');

Route::get('/menus', function () {
    return view('contents.menu');
})->name('menu.index');

Route::get('/reports', function () {
    return view('contents.console');
})->name('report.index');
