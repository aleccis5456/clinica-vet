<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\InventarioController;
use App\Livewire\Consultas;
use App\Livewire\FormAddDueno;
use App\Livewire\FormAddMascota;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Login;
use App\Livewire\GestionRoles;
use App\Livewire\HistorialCompleto;
use App\Livewire\Inventario;
use Illuminate\Support\Facades\Session;


Route::post('/registrar/mascota', [MascotaController::class, 'crearMascota'])->name('mascota.crear');
Route::post('/editar/mascota', [MascotaController::class, 'editSave'])->name('mascota.editsave');
Route::get('/registro', [AuthController::class, 'registerForm'])->name('auth.registerform');
Route::post('/registro/save', [AuthController::class, 'register'])->name('auth.register');
Route::post('/iniciar-sesion', [AuthController::class, 'login'])->name('auth.login');
Route::post('/inventario', [InventarioController::class, 'store'])->name('inventario.store');

Route::get('/', Home::class)->name('index');
Route::middleware(Login::class)->group(function () {    
    Route::get('/registrar/dueno', FormAddDueno::class)->name('add.dueno');
    Route::get('/registrar/mascota', FormAddMascota::class)->name('add.mascota');
    Route::get('/consultas', Consultas::class)->name('consultas');
    Route::get('/Gestion/usuario', GestionRoles::class)->name('gestion.roles');
    Route::get('/Inventario', Inventario::class)->name('inventario');
    Route::get('/Historial-completo/{id}', HistorialCompleto::class)->name('historial.completo');

});


Route::get('borrar-session', function(){
    Session::forget('consumo');
    return back();
});

Route::get('ver-sessiones', function(){
    dd(session('vetGrupos'));
});