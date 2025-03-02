<?php

use App\Livewire\FormAddDueno;
use App\Livewire\FormAddMascota;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('index');
Route::get('/registrar/dueno', FormAddDueno::class)->name('add.dueno');
Route::get('/registrar/mascota', FormAddMascota::class)->name('add.mascota');