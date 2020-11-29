<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Livewire\Home::class)->middleware('auth')->name('home');
Route::get('/file-upload', App\Http\Livewire\FileUploader::class)->middleware('auth')->name('file-upload');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', App\Http\Livewire\Login::class)->name('login');
    Route::get('/register', App\Http\Livewire\Register::class)->name('register');
});
