<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('contents.dashboard');
    })->name('dashboard.index');

    Route::get('/consoles', function () {
        return view('contents.console');
    })->name('console.index');

    Route::get('/transactions', function () {
        return view('contents.transaction');
    })->name('transaction.index');

    Route::get('/menus', function () {
        return view('contents.menu');
    })->name('menu.index');

    Route::get('/reports', function () {
        return view('contents.report');
    })->name('report.index');
});

Route::get('/testReport', function () {
    return view('pdf.finance-report');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');