<?php

use App\Http\Controllers\MascotaController;
use App\Livewire\FormAddDueno;
use App\Livewire\FormAddMascota;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::post('/registrar/mascota', [MascotaController::class, 'crearMascota'])->name('mascota.crear');

Route::get('/', Home::class)->name('index');
Route::get('/registrar/dueno', FormAddDueno::class)->name('add.dueno');
Route::get('/registrar/mascota', FormAddMascota::class)->name('add.mascota');
