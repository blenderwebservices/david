<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '^(?!admin|login).*$');
